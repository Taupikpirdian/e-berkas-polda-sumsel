<?php

namespace App\Http\Livewire\Datatable;

use App\Http\Repositories\Admin\PangkatRepository;
use App\Perkara;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\UserRepository;

class DataPranut extends Component
{
    use WithPagination;

    public $role, $user, $jaksas, $statuses, $kategoriBagianId, $operators;
    public $perPage = 25;
    public $perPagePenyidik = 25;
    public $arrayPerkaraId = [];
    public $query = '';
    public $query_spdp = '';
    public $query_tersangka = '';
    public $query_jpu = '';
    public $query_penyidik = '';
    public $queryPenyidik = '';
    public $pagePenyidik = 1;
    public $query_daterange, $status, $filter = '';

    public function mount($filter)
    {
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan, admin-master
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->kategoriBagianId = thisAksesFirst() ? thisAksesFirst()->kategori_bagian_id : null;
        $this->jaksas = (new PerkaraService())->listUserJaksa($this->kategoriBagianId);
        $this->operators = (new PerkaraService())->listUserOperator($this->kategoriBagianId);

        $this->statuses = (new DataMasterRepository())->masterStatus();
        if ($this->role == 'kejaksaan') {
            $dataJaksa = (new KejaksaanRepository())->userJaksaByUserId($this->user->id);
            if ($dataJaksa) {
                $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignPerkara($dataJaksa->id);
            }
        }

        if (
            $this->role == 'operator-01' ||
            $this->role == 'operator-02' ||
            $this->role == 'operator-03' ||
            $this->role == 'operator-04' ||
            $this->role == 'operator-kasi-pidum' ||
            $this->role == 'operator-kasi-pidsus'
        ) {
            $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignOperator($this->user->id);
        }
        $this->filter = $filter;
    }

    protected $listeners = [
        'delete',
        'authPin',
        'authPinModalBerkas',
    ];

    public function delete($id)
    {
        $data = Perkara::where('id', $id)->first();
        if ($data) {
            $data->delete();
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
                'url_redirect' => '/data-prapenuntutan',
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
                'url_redirect' => '/data-prapenuntutan',
            ];
            $this->emit('sweetAlert', $param);
        }
    }

    public function resetFilter()
    {
        $this->query = '';
        $this->query_spdp = '';
        $this->query_tersangka = '';
        $this->query_jpu = '';
        $this->query_penyidik = '';
        $this->query_daterange = '';
        $this->status = '';
    }

    public function render()
    {
        $request = [
            'query' => $this->query,
            'query_spdp' => $this->query_spdp,
            'query_tersangka' => $this->query_tersangka,
            'query_jpu' => $this->query_jpu,
            'query_penyidik' => $this->query_penyidik,
            'query_daterange' => $this->query_daterange,
            'status' => $this->status
        ];
        $dataPrapenuntutans = (new PerkaraService())->index($request, $this->role, $this->user->id, $this->arrayPerkaraId, $this->filter, $this->kategoriBagianId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);

        $users = (new UserRepository())->index($this->queryPenyidik, $this->role, $this->kategoriBagianId, $this->user)->paginate($this->perPagePenyidik);
        $this->pagePenyidik > $users->lastPage() ? $this->pagePenyidik = $users->lastPage() : true;
        $paginate_content_penyidik = (new PangkatRepository)->paginateContent($users);

        $this->emit('callAgainJs', null);
        return view('livewire.datatable.data-pranut', compact('dataPrapenuntutans', 'paginate_content', 'users', 'paginate_content_penyidik'));
    }
}
