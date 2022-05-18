<?php

namespace App\Http\Livewire\Admin\Lapas;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\LapasRepository;
use App\Http\Repositories\Admin\PangkatRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class LapasModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteLapas',
    ];

    public function deleteLapas($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new LapasRepository)->getRumahTahananById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }
    
    public function render()
    {
        $datas = (new LapasRepository)->listRumahTahanan()
            ->where('name', 'like', "%$this->query%")
            ->paginate($this->perPage);

        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        $paginate_content = (new PangkatRepository)->paginateContent($datas);

        return view('livewire.admin.lapas.lapas-modal', compact('paginate_content', 'datas'));
    }
}
