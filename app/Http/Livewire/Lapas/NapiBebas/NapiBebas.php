<?php

namespace App\Http\Livewire\Lapas\NapiBebas;

use Livewire\Component;

use Livewire\WithPagination;
use App\Http\Repositories\Admin\LapasRepository;
use App\Http\Repositories\ComponentRepository;

class NapiBebas extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    public function render()
    {
        $listNapiBebas = (new LapasRepository)->listNapiBebas($this->query)->paginate($this->perPage);
        $this->page > $listNapiBebas->lastPage() ? $this->page = $listNapiBebas->lastPage() : true;
        $paginate_content = (new ComponentRepository)->paginateContent($listNapiBebas);

        return view('livewire.lapas.napi-bebas.napi-bebas', compact('listNapiBebas', 'paginate_content'));
    }
}
