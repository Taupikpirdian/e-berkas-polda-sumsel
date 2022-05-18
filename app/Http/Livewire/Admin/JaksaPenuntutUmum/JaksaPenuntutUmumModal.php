<?php

namespace App\Http\Livewire\Admin\JaksaPenuntutUmum;

use App\User;
use App\Http\Repositories\Admin\InstansiRepository;
use App\Http\Repositories\Admin\JaksaPenuntutUmumRepository;
use App\JaksaPenuntutUmum;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class JaksaPenuntutUmumModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteJaksaPenuntutUmum',
    ];

    public function deleteJaksaPenuntutUmum($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new JaksaPenuntutUmumRepository)->getJaksaPenuntutUmumById($id);
            $id_user = $data->user_id;
            $deleted = $data->delete();

            if($deleted) {
                $user = User::find($id_user);
                $user->assign_jaksa_id = null;
                $user->save();
            }

        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $search = $this->query;
        $jaksaPenuntutUmum = (new JaksaPenuntutUmumRepository)->listJaksaPenuntutUmum()
            ->with(['pangkat', 'user'])
            ->whereHas('pangkat', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhere('name', 'like', "%$this->query%")
            ->orWhere('nip', 'like', "%$this->query%")
            ->orWhere('no_tlp', 'like', "%$this->query%")
            ->orWhere('status', 'like', "%$this->query%")
            ->paginate($this->perPage);
        $this->page > $jaksaPenuntutUmum->lastPage() ? $this->page = $jaksaPenuntutUmum->lastPage() : true;
        $paginate_content = (new InstansiRepository)->paginateContent($jaksaPenuntutUmum);

        return view('livewire.admin.jaksa-penuntut-umum.jaksa-penuntut-umum-modal', compact('jaksaPenuntutUmum', 'paginate_content'));
    }
}
