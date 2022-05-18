<?php

namespace App\Http\Livewire\Kejaksaan\Perpanjangan;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\PenyidikRepository;
use App\Http\Repositories\DataMasterRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\PerpanjanganPenahananRepository;

class Perpanjangan extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $query = '';

    public function mount()
    {
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        
        if($this->role == 'kepolisian'){
            // list perkara by penyidik id
            $penyidik = (new PenyidikRepository)->penyidikByUserId($this->user->id);
            if($penyidik){
                $this->arrPerkara = (new PenyidikRepository)->perkaraByPenyidikId($penyidik->id);
            }
        }
    }

    protected $listeners = [
        'deletePerpanjanganPenahanan',
    ];

    public function deletePerpanjanganPenahanan($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new PerpanjanganPenahananRepository)->getPerpanjanganPenahananById($id);
            $file = (new PerpanjanganPenahananRepository)->filePerpanjanganPenahanan($data->id);
            $data->delete();
            foreach($file as $data) {
                $data->delete();
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $perpanjanganPenahanan = (new PerpanjanganPenahananRepository)->listPerpanjanganPenahanan($this->query)->paginate($this->perPage);
        
        $this->page > $perpanjanganPenahanan->lastPage() ? $this->page = $perpanjanganPenahanan->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($perpanjanganPenahanan);

        return view('livewire.kejaksaan.perpanjangan.perpanjangan', compact('perpanjanganPenahanan', 'paginate_content'));
    }
}
