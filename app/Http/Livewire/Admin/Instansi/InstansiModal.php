<?php

namespace App\Http\Livewire\Admin\Instansi;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\InstansiRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class InstansiModal extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $query = '';

    protected $listeners = [
        'deleteInstansi',
    ];

    public function deleteInstansi($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new InstansiRepository)->getInstansiById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listInstansi = (new InstansiRepository)->listInstansi($this->query)->paginate($this->perPage);
        $this->page > $listInstansi->lastPage() ? $this->page = $listInstansi->lastPage() : true;
        $paginate_content = (new InstansiRepository)->paginateContent($listInstansi);

        return view('livewire.admin.instansi.instansi-modal', compact('listInstansi', 'paginate_content'));
    }
}
