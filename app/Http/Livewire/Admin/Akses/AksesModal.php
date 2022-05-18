<?php

namespace App\Http\Livewire\Admin\Akses;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\AksesRepository;
use App\Http\Repositories\Admin\PangkatRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class AksesModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteAkses',
    ];

    public function deleteAkses($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new AksesRepository)->getAksesById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $datas = (new AksesRepository)->listPangkat()
            ->where('users.name', 'like', "%$this->query%")
            ->paginate($this->perPage);

        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        $paginate_content = (new PangkatRepository)->paginateContent($datas);

        return view('livewire.admin.akses.akses-modal', compact('paginate_content', 'datas'));
    }
}
