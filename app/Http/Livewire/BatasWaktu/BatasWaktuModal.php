<?php

namespace App\Http\Livewire\BatasWaktu;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PerkaraService;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\DataMasterRepository;

class BatasWaktuModal extends Component
{
    use WithPagination;

    public $role, $user, $jaksas, $statuses;
    public $perPage = 25;
    public $arrayPerkaraId = [];
    public $query = '';
    public $query_daterange, $status;

    public function mount()
    {
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan, admin-master
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->jaksas = (new PerkaraService())->getJaksa();
        $this->statuses = (new DataMasterRepository())->masterStatus();
        if ($this->role == 'kejaksaan') {
            $dataJaksa = (new KejaksaanRepository())->userJaksaByUserId($this->user->id);
            if ($dataJaksa) {
                $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignPerkara($dataJaksa->id);
            }
        }
    }

    public function render()
    {
        $request = [
            'query' => $this->query,
            'query_daterange' => $this->query_daterange,
            'status' => Constant::ON_PROGRESS
        ];
        $dataPrapenuntutans = (new PerkaraService())->index($request, $this->role, $this->user->id, $this->arrayPerkaraId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);

        return view('livewire.batas-waktu.batas-waktu-modal', compact('dataPrapenuntutans', 'paginate_content'));
    }
}
