<?php

namespace App\Http\Livewire\DataPranutLimpah;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\Auth;
use App\Services\PerkaraServiceLimpah;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\PengadilanRepository;

class DataPranutLimpahModal extends Component
{
    use WithPagination;
    
    public $role, $user, $pengadilans, $statuses;
    public $perPage = 25;
    public $arrayPerkaraId = [];
    public $query = '';
    public $query_daterange, $status;

    public function mount()
    {
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->pengadilans = (new PengadilanRepository)->listPengadilan();
        $this->statuses = (new DataMasterRepository())->masterStatus(true, [Constant::LENGKAP, Constant::LIMPAH]);
        if ($this->role == 'kejaksaan') {
            $dataJaksa = (new KejaksaanRepository())->userJaksaByUserId($this->user->id);
            if ($dataJaksa) {
                $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignPerkara($dataJaksa->id);
            }
        }
    }

    protected $listeners = [
        'delete',
        'authPin',
        'authPinModalBerkas',
        'authPinForwardPengadilan'
    ];

    public function authPinForwardPengadilan($id, $pin, $fitur)
    {
        $user_id = Auth::user()->id;
        $authPin = (new AuthRepository)->checkPin($user_id, $pin);
        // if false, show sweat alert
        if ($authPin == true) {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'PIN yang anda masukan benar!',
                'url_redirect' => "/data-prapenuntutan-limpah/forward/" . helperEncrypt($id) ."/". $fitur,
            ];
            $this->emit('sweetAlertWithRedirect', $param);
        } else {
            $param = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'PIN yang anda masukan salah!',
                'url_redirect' => '/data-prapenuntutan-limpah',
            ];
            $this->emit('sweetAlert', $param);
        }
    }

    public function authPin($id, $pin)
    {
        $user_id = Auth::user()->id;
        $authPin = (new AuthRepository)->checkPin($user_id, $pin);
        // if false, show sweat alert
        if ($authPin == true) {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'PIN yang anda masukan benar!',
                'url_redirect' => "/data-prapenuntutan/" . helperEncrypt($id),
            ];
            $this->emit('sweetAlertWithRedirect', $param);
        } else {
            $param = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'PIN yang anda masukan salah!',
                'url_redirect' => '/data-prapenuntutan-limpah',
            ];
            $this->emit('sweetAlert', $param);
        }
    }

    public function authPinModalBerkas($id, $pin, $idModal)
    {
        $user_id = Auth::user()->id;
        $authPin = (new AuthRepository)->checkPin($user_id, $pin);

        // if false, show sweat alert
        if ($authPin == true) {
            $this->emit('showModalBerkas', $idModal);
        } else {
            $param = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'PIN yang anda masukan salah!',
                'url_redirect' => '/data-prapenuntutan-limpah',
            ];
            $this->emit('sweetAlert', $param);
        }
    }

    public function render()
    {
        $request = [
            'query' => $this->query,
            'query_daterange' => $this->query_daterange,
            'status' => $this->status
        ];
        $dataPrapenuntutans = (new PerkaraServiceLimpah())->index($request, $this->role, $this->user->id, $this->arrayPerkaraId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);

        return view('livewire.data-pranut-limpah.data-pranut-limpah-modal', compact('dataPrapenuntutans', 'paginate_content'));
    }
}
