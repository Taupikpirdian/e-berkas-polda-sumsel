<?php

namespace App\Http\Livewire\Admin\Pangkat;

use App\Http\Repositories\Admin\PangkatRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class PangkatModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deletePangkat',
    ];

    public function deletePangkat($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new PangkatRepository)->getPangkatById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listPangkat = (new PangkatRepository)->listPangkat()
            ->where('name', 'like', "%$this->query%")
            ->paginate($this->perPage);
        $this->page > $listPangkat->lastPage() ? $this->page = $listPangkat->lastPage() : true;
        $paginate_content = (new PangkatRepository)->paginateContent($listPangkat);

        return view('livewire.admin.pangkat.pangkat-modal', compact('listPangkat', 'paginate_content'));
    }
}
