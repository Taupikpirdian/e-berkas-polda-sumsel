<?php

namespace App\Http\Livewire\Lapas\Tahanan;

use Livewire\Component;
use App\Tahanan;
use Livewire\WithPagination;
use App\Http\Repositories\Admin\LapasRepository;

class TahananModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    public function render()
    {
        $listTahanan = (new LapasRepository)->listTahanan($this->query)->paginate($this->perPage);
        $this->page > $listTahanan->lastPage() ? $this->page = $listTahanan->lastPage() : true;
        $paginate_content = (new LapasRepository)->paginateContent($listTahanan);

        return view('livewire.lapas.tahanan.tahanan-modal', compact('listTahanan', 'paginate_content'));
    }
}
