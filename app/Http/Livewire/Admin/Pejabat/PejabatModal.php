<?php

namespace App\Http\Livewire\Admin\Pejabat;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\PejabatRepository;
use App\Http\Repositories\Admin\InstansiRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class PejabatModal extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $query = '';

    protected $listeners = [
        'deletePejabat',
    ];

    public function deletePejabat($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new PejabatRepository)->getPejabatById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listPejabat = (new PejabatRepository)->listPejabat($this->query)->paginate($this->perPage);
        $this->page > $listPejabat->lastPage() ? $this->page = $listPejabat->lastPage() : true;
        $paginate_content = (new InstansiRepository)->paginateContent($listPejabat);
        
        return view('livewire.admin.pejabat.pejabat-modal', compact('listPejabat', 'paginate_content'));
    }
}
