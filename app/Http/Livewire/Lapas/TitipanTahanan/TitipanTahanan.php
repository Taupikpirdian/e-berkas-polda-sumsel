<?php

namespace App\Http\Livewire\Lapas\TitipanTahanan;

use App\Http\Repositories\Admin\LapasRepository;
use App\Http\Repositories\ComponentRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Encryption\DecryptException;

class TitipanTahanan extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteTitipanPenahanan',
    ];

    public function deleteTitipanPenahanan($params)
    {
        try {
            $id = helperDecrypt($params);
            $data = (new LapasRepository)->getTitipanPenahananById($id);
            $dataFile = (new LapasRepository)->getFileTitipanTahananById($id);
            $dataTersangka = (new LapasRepository)->getTitipanPenahananById($id);
            foreach($dataFile as $data) {
                $data->delete();
            }

            foreach($dataTersangka as $data) {
                $data->delete();
            }
            $data->delete();

        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listTitipanTahanan = (new LapasRepository)->listTitipanPenahanan($this->query)->paginate($this->perPage);
        $this->page > $listTitipanTahanan->lastPage() ? $this->page = $listTitipanTahanan->lastPage() : true;
        $paginate_content = (new ComponentRepository)->paginateContent($listTitipanTahanan);
        return view('livewire.lapas.titipan-tahanan.titipan-tahanan', compact('listTitipanTahanan', 'paginate_content'));
    }
}
