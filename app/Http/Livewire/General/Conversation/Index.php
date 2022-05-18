<?php

namespace App\Http\Livewire\General\Conversation;

use App\User;
use App\Thread;
use App\Constant;
use App\Participant;
use App\Conversation;
use App\DiskusiDetail;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\DiskusiPerkara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $role, $user, $contacts, $user_id, $user_name_selected, $text, $conversations, $files;
    public $query = '';
    public $perPage = 10;
    public $is_chat = true;

    public function mount($dataParam = null)
    {
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        
        if($dataParam != null){
            $userIdJaksa = Crypt::decrypt($dataParam);
            $this->user_id = $userIdJaksa;
            $user = User::where('id', $userIdJaksa)->first('name');
            $this->user_name_selected = $user ? $user->name : '';
        }
    }

    public function refreshData()
    {
        // for refresh data
    }

    public function countData($status)
    {
        $count_data = DiskusiDetail::
        where('user_id', '!=', Auth::user()->id)
          ->whereHas('tiketDetail', function ($q) {
            $q->where('is_read', Constant::IS_NOT_READ);
        })->count();

        return $count_data;
    }

    public function flagActive($status)
    {
        $this->is_chat = $status == 'ChatList' ? true : false;
    }

    public function selectUser($user_id)
    {
        $this->user_id = $user_id;
        $user = User::where('id', $user_id)->first('name');

        $this->user_name_selected = $user ? $user->name : '';
    }

    public function submitMessage()
    {
        /**
         * check data participan
         * cari thread_id dengan param user pengirim
         * cari thread_id dengan param user penerima
         * sandingkan kedua array tersebut
         * jika tidak ada data yang sama, create thread baru
         */

        $user_auth = Auth::user()->id;
        // compare array
        $compare_array = $this->compareArray($this->user->id, $this->user_id);

        DB::beginTransaction();
        try {
            if($compare_array == false){
                // create thread
                $thread = Thread::create([
                    'room'       => '',
                ]);
    
                // create participant
                $participans = [$user_auth, $this->user_id];
                foreach($participans as $participan){
                    $participan = Participant::create([
                        'thread_id'     => $thread->id,
                        'user_id'       => $participan,
                    ]); 
                }
            }else{
                // select data thread
                $thread = new \Illuminate\Database\Eloquent\Collection;
                $thread->id = $compare_array[0];
            }

            if($thread){
                if($this->text){
                  // save message
                  Conversation::create([
                      'thread_id'     => $thread->id,
                      'user_id'       => $user_auth,
                      'message'       => $this->text,
                      'type_message'  => Constant::IS_TEXT,
                  ]); 
                }

                if($this->files){
                    // save files
                    foreach($this->files as $file){
                        // save to directory
                        // file ext
                        $ext = $file->getClientOriginalExtension();
                        $oriName = $file->getClientOriginalName();
                        // file name
                        $name = date('YmdHis').'-'.$oriName;
                        // folder
                        $folder = 'files/thread/'.$thread->id;
                        // path
                        $path = $folder.'/'.$name;
                        
                        Storage::disk('public')->putFileAs($folder, $file, $name);
                        // save db file spdp
                        
                        Conversation::create([
                            'thread_id'     => $thread->id,
                            'user_id'       => $user_auth,
                            'message'       => $path,
                            'type_message'  => Constant::IS_FILE,
                            'original_name' => $oriName,
                        ]); 
                    }
                }
            }

            DB::commit();

            $this->files = '';
            $this->text = '';
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }

        $this->text = '';

    }

    function compareArray($user_auth, $user_id)
    {
        // data thread user pengirim
        $check_thread_sender = Participant::where('user_id', $user_auth)->pluck('thread_id')->toArray();
        // data thread user penerima
        $check_thread_received = Participant::where('user_id', $user_id)->pluck('thread_id')->toArray();
        // bandingkan kedua array
        if($check_thread_sender && $check_thread_received){
            $compare_array = array_intersect($check_thread_sender, $check_thread_received);
            $compare_array = array_values($compare_array);
        }else{
            $compare_array = false;
        }

        return $compare_array;
    }

    function conversationList()
    {
        // list percakapan
        if($this->user_id){
            $compare_array = $this->compareArray($this->user->id, $this->user_id);
            $thread_id = isset($compare_array[0]) ? $compare_array[0] : null;
            $this->conversations  = Conversation::where('thread_id', $thread_id)->orderBy('created_at', 'asc')->get();
            // update data jadi read
            Conversation::where('thread_id', $thread_id)->where('user_id', '!=', $this->user->id)->update(['is_read' =>  1]);
        }
    }

    function chatList($check_thread_sender, $search)
    {
        $recent_chats = Thread::select([
            'threads.id',
            'participants.thread_id',
            'participants.user_id',
            'users.id as user_id',
            'users.name',
        ])->with([
            'conversation',
            'conversationNotRead',
        ])->join('participants', 'threads.id', '=', 'participants.thread_id')
          ->join('users', 'participants.user_id', '=', 'users.id')
          ->whereIn('threads.id', $check_thread_sender)
          ->where('participants.user_id', '!=', $this->user->id)
          ->where(function ($query) use ($search) {
            $query->where('users.name', 'like', "%$search%");
        })->get();

        return $recent_chats;
    }

    public function render()
    {
        $search = $this->query;
        // select thread yang dimiliki user
        $check_thread_sender = Participant::where('user_id', $this->user->id)->pluck('thread_id')->toArray();
        // list percakapan
        $this->conversationList();
        // list chat
        $recent_chats = $this->chatList($check_thread_sender, $search);

        // list user
        if($this->role == 'kejaksaan'){
            $this->contacts = User::orderBy('name', 'asc')->role('kepolisian')->where('name', 'like', "%$this->query%")->get();
        }elseif($this->role == 'kepolisian'){
            $this->contacts = User::orderBy('name', 'asc')->role('kejaksaan')->where('name', 'like', "%$this->query%")->get();
        }

        /**
         * list data perkara progress
         */
        if($this->role == 'kepolisian'){
            $datas = (new DiskusiPerkara())->kepolisian($this->user->id, $this->query, $this->perPage);
        }elseif($this->role == 'kejaksaan'){
            $datas = (new DiskusiPerkara())->kejaksaan($this->user->id, $this->query, $this->perPage);
        }elseif($this->role == 'pengadilan'){
            $datas = (new DiskusiPerkara())->pengadilan($this->query, $this->perPage);
        }

        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;

        return view('livewire.general.conversation.index', compact('datas', 'recent_chats'));
    }
}
