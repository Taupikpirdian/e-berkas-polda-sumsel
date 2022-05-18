<?php

namespace App\Http\Livewire\DataPranutLimpah;

use App\Perkara;
use App\FilePerkara;
use App\Http\Repositories\DataMasterRepository;
use Livewire\Component;
use Livewire\WithPagination;

class DataPranutLimpahForward extends Component
{
    use WithPagination;

    public $role, $user;
    public $perPage = 50;
    public $uid;
    public $fitur;

    public function mount($id = null, $fitur)
    {
        /**
         * role:
         * kejaksaan, pengadilan, admin-kejaksaan
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->uid = $id != null ? helperDecrypt($id) : null;
        $this->fitur = $fitur;
    }

    public function render()
    {
        $perkara_id = $this->uid;
        $fitur = $this->fitur;
        $perkara_status = Perkara::select('status')->find($perkara_id);

        // data berkas
        $filePerkara = FilePerkara::with([
            'masterFile',
            'uploadedBy',
        ])->where('perkara_id', $this->uid)
        ->when($fitur == 'detail', function ($q) {
            $q->where('is_forward', true);
        })
        ->paginate($this->perPage, ['*'], 'fileperkara');
        $this->page > $filePerkara->lastPage() ? $this->page = $filePerkara->lastPage() : true;
        $paginate_content_fileperkara = (new DataMasterRepository)->contentPaginate($filePerkara);

        return view('livewire.data-pranut-limpah.data-pranut-limpah-forward', compact(
            'filePerkara',
            'paginate_content_fileperkara',
            'perkara_id',
            'fitur',
            'perkara_status'
        ));
    }
}
