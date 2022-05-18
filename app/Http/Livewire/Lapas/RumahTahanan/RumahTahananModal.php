<?php

namespace App\Http\Livewire\Lapas\RumahTahanan;

use App\RumahTahanan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Repositories\Admin\LapasRepository;

class RumahTahananModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    public function render()
    {
        $listRumahTahanan = (new LapasRepository)->listRumahTahanan($this->query)->paginate($this->perPage);
        $this->page > $listRumahTahanan->lastPage() ? $this->page = $listRumahTahanan->lastPage() : true;
        $paginate_content = (new LapasRepository)->paginateContent($listRumahTahanan);

        return view('livewire.lapas.rumah-tahanan.rumah-tahanan-modal', compact('paginate_content', 'listRumahTahanan'));
    }
}
