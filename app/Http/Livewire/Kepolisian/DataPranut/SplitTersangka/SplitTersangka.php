<?php

namespace App\Http\Livewire\Kepolisian\DataPranut\SplitTersangka;

use App\Constant;
use App\Http\Repositories\ComponentRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\SpdpRepository;
use App\Http\Repositories\TersangkaRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SplitTersangka extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $switch_tersangka = false;
    public $query = '';
    public $page = 1;
    public $file;
    public $file_spdp = [];
    public $sprint_sidik = [];
    public $file_lp = [];
    public $file_berkas_perkara = [];
    public $perPage = 10;
    public $id_encrypt;
    public $checkbox = [];
    public $user;

    public function mount($id)
    {
        try {
            $this->id_encrypt = Crypt::decrypt($id);
            $this->breadcrumb = "";
            $this->user = thisUser();
            
            $array_chekbox = (new TersangkaRepository)->listSplitTersangka($this->id_encrypt)->get();
            if($array_chekbox) {
                foreach($array_chekbox as $data){
                    $this->checkbox[$data->id] = ($data->is_proses == 1) ? true : false;
                }                
            }
            
        } catch (DecryptException $e) {
            return $e;
        }
    }

    protected $listeners = [
        'store',
    ];

    public function store()
    {   
        DB::beginTransaction();
        try {
            /**
             * store data perkara
             */
            $request = new \stdClass;
            $request->file = $this->file;
            $request->checkbox = $this->checkbox;
            $request->file_spdp = $this->file_spdp;
            $request->sprint_sidik = $this->sprint_sidik;
            $request->file_lp = $this->file_lp;
            $request->file_berkas_perkara = $this->file_berkas_perkara;
            
            if($this->switch_tersangka == false) {
                // store file 
                (new SpdpRepository)->splitFileTersangka($request, $this->id_encrypt);
                // update tahap I
                (new SpdpRepository)->updateTahapSatu($this->id_encrypt);
            } else {
                // update split tersangka 
                (new SpdpRepository)->updateSpliteTersangka($this->id_encrypt, $request->checkbox);

                // update file split tersangka
                (new SpdpRepository)->splitFileTersangkaArray($request, $this->id_encrypt);

                // update tahap 1 
                (new SpdpRepository)->updateTahapSatu($this->id_encrypt);
            }
            


            /**
             * notif for kejaksaan
             */
            $text = 'Berhasil Split Data Tersangka';
            $arrayJaksaAssignee = (new KejaksaanRepository)->jaksaAssingPerkaraByPerkaraId($this->id_encrypt);
            foreach ($arrayJaksaAssignee as $assignJaksa) {
                if ($assignJaksa->masterJaksa) {
                    $req = [
                        'user_id' => $this->user->id,
                        'notif_for' => $assignJaksa->masterJaksa->user_id,
                        'desc' => $text,
                        'data_id' => $this->id_encrypt,
                        'notif_fitur' => 'Upload Tahap II',
                        'notif_type' => Constant::NOTIF_SPLIT
                    ];
                    notificationOne($req);
                }
            }
            DB::commit();
            return redirect()->to('/data-prapenuntutan')->with(['success' => 'Tersangka Berhasil Di Split']);
        } catch (DecryptException $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function validateData()
    {
        // /**
        //  * if file object, then validate mime and size data
        //  */
        // if($this->switch_tersangka == false) {
        //     if ($this->file) {
        //         $this->validate(
        //             [
        //                 'file' => 'mimes:pdf|max:2000',
        //             ],
        //             [
        //                 'file.mimes' => 'format yang digunakan: pdf',
        //                 'file.max' => 'max ukuran file 2mb',
        //             ]
        //         );
        //     }
        // } else {
        //     if ($this->file_spdp && $this->sprint_sidik && $this->file_lp && $this->file_lainnya) {
        //         $this->validate(
        //             [
        //                 'file_spdp.*' => 'mimes:pdf|max:2000',
        //                 'sprint_sidik.*' => 'mimes:pdf|max:2000',
        //                 'file_spdp.*' => 'mimes:pdf|max:2000',
        //                 'file_lainnya.*' => 'mimes:pdf|max:2000',
        //             ],
        //             [
        //                 'mimes' => 'format yang digunakan: pdf',
        //                 'max' => 'max ukuran file 2mb',
        //             ]
        //         );
        //     }
        // }

        // if($this->switch_tersangka == false) {
        //     $this->validate(
        //         [
        //             'file' => 'required',
        //         ],
        //         [
        //             'required' => 'Data ini tidak boleh kosong',
        //         ]
        //     );
        // } else {
        //     $this->validate(
        //         [
        //             'file_spdp.*' => 'required',
        //             'sprint_sidik.*' => 'required',
        //             'file_lp.*' => 'required',
        //             'file_lainnya.*' => 'required',
        //         ],
        //         [
        //             'required' => 'Data ini tidak boleh kosong',
        //         ]
        //     );
        // }

        // store data
        $this->emit('confirmSubmit');
    }

    public function render()
    {
        $data_tersangka = (new TersangkaRepository)->listSplitTersangka($this->id_encrypt)->get();
        $this->emit('refreshJs');

        return view('livewire.kepolisian.data-pranut.split-tersangka.split-tersangka', compact('data_tersangka'));
    }
}
