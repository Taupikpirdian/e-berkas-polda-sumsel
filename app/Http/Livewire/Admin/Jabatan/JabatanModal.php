<?php

namespace App\Http\Livewire\Admin\Jabatan;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\JabatanRepository;
use App\Http\Repositories\Admin\InstansiRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class JabatanModal extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $query = '';

    protected $listeners = [
        'deleteJabatan',
    ];

    public function deleteJabatan($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new JabatanRepository)->getJabatanById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listJabatan = (new JabatanRepository)->listJabatan($this->query)->paginate($this->perPage);
        $this->page > $listJabatan->lastPage() ? $this->page = $listJabatan->lastPage() : true;
        $paginate_content = (new InstansiRepository)->paginateContent($listJabatan);

        return view('livewire.admin.jabatan.jabatan-modal', compact('listJabatan', 'paginate_content'));
    }
}
