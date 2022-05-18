<?php

namespace App\Http\Livewire\Kejaksaan\BeritaAcara;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\BeritaAcaraRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\ExportRepository;
use App\Http\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use App\BeritaAcara as BA;
use PDF;

class BeritaAcara extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $query = '';

    protected $listeners = [
        'deleteBeritaAcara',
        'exportPDFBeritaAcara'
    ];

    public function deleteBeritaAcara($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new BeritaAcaraRepository)->getBeritaAcaraById($id);
            (new BeritaAcaraRepository)->deleteFormilById($id);
            (new BeritaAcaraRepository)->deleteMaterilById($id);
            // delete data berita acara
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function exportPDFBeritaAcara($id, $pin)
    {
        try {
            $id_berita_acara = Crypt::decrypt($id);
            
            $user_id = Auth::user()->id;
            $authPin = (new AuthRepository)->checkPin($user_id, $pin);
            // if false, show sweat alert
            if($authPin == true){
                return (new ExportRepository)->beritaAcaraPDF($id_berita_acara);
            }else{
                $param = [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'PIN yang anda masukan salah!',
                    'url_redirect' => '/berita-acara',
                ];
                $this->emit('sweetAlert', $param);
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $beritaAcara = (new BeritaAcaraRepository)->listBeritaAcara($this->query)->paginate($this->perPage);
        $this->page > $beritaAcara->lastPage() ? $this->page = $beritaAcara->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($beritaAcara);

        return view('livewire.kejaksaan.berita-acara.berita-acara', compact('beritaAcara', 'paginate_content'));
    }
}
