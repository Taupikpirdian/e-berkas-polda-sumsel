<?php

namespace App\Http\Livewire\DataPenahanan;

use App\Constant;
use App\Http\Repositories\ComponentRepository;
use App\Http\Repositories\DataPenahananRepository;
use Livewire\Component;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\WithPagination;

class DataPenahananModal extends Component
{
    use WithPagination;
    public $queryPenahananAnak = '';
    public $queryPenahananDewasa = '';
    public $perPage = 10;
    public $pageDataAnak = 1;
    public $page = 1;

    protected $listeners = [
        'deleteDataPenahanan',
    ];

    public function mount($fitur)
    {
        $this->fitur = $fitur;
        if ($this->fitur == Constant::PENGADILAN_FEATURE) {
            $this->label = 'Permohonan Perpanjangan Penahanan';
        } elseif ($fitur == Constant::KEJAKSAAN_FEATURE) {
            $this->label = 'Permohonan Perpanjangan Penahanan';
        } else {
            $this->label = '';
        }
    }

    public function deleteDataPenahanan($params)
    {
        try {
            $id = helperDecrypt($params);
            $data = (new DataPenahananRepository)->listDataPenahananById($id);
            $data_tersangka = (new DataPenahananRepository)->getListTersangkaId($id);
            $data_file = (new DataPenahananRepository)->getFileDataPenahananById($id);
            $data_assign = (new DataPenahananRepository)->assignDataPenahananById($id);
            
            $data->delete();
            // file 
            foreach($data_file as $data) {
                $data->delete();
            }
            // tersangka 
            foreach($data_tersangka as $data) {
                $data->delete();
            }
            // assign data penahaan
            foreach($data_assign as $data) {
                $data->delete();
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        // penahanan anak 
        $listDataPenahananAnak = (new DataPenahananRepository)->listDataPenahananAnak($this->queryPenahananAnak, $this->fitur)->paginate($this->perPage);
        $this->pageDataAnak > $listDataPenahananAnak->lastPage() ? $this->pageDataAnak = $listDataPenahananAnak->lastPage() : true;
        $paginate_penahanan_dewasa = (new ComponentRepository)->paginateContent($listDataPenahananAnak);

        // penahanan dewasa
        $listDataPenahananDewasa = (new DataPenahananRepository)->listDataPenahananDewasa($this->queryPenahananDewasa, $this->fitur)->paginate($this->perPage);
        $this->page > $listDataPenahananDewasa->lastPage() ? $this->page = $listDataPenahananDewasa->lastPage() : true;
        $paginate_penahanan_anak = (new ComponentRepository)->paginateContent($listDataPenahananDewasa);

        return view('livewire.data-penahanan.data-penahanan-modal', compact('paginate_penahanan_dewasa', 'listDataPenahananAnak', 'listDataPenahananDewasa', 'paginate_penahanan_anak'));
    }
}
