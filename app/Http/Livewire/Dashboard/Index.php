<?php

namespace App\Http\Livewire\Dashboard;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\PenyidikRepository;
use App\Http\Repositories\DashboardRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\DataMasterRepository;

class Index extends Component
{
    use WithPagination;

    public $role, $user, $countDataPranut = 0, $countDataPranutOpen = 0, $countDataPranutWithoutBerkas = 0;
    public $countDataPerkara = 0,
        $countDataIzinGeledah = 0,
        $countDataIzinSita = 0,
        $countDataBerkas = 0,
        $listCard,
        $countDataP21 = 0,
        $countDataBpacTipiring = 0,
        $countDataDiversi = 0,
        $countDataRumahTahanan = 0,
        $countDataBerkasTahapII = 0,
        $countDataTahanan = 0;

    public $perPage = 10;
    public $page = 1;
    public $pageNotification = 1;
    public $pagePenangananKepolisian = 1;
    public $query = '';
    public $dataPranutById;
    public $arrayPerkaraId = [];
    public $activeJaksa = false;
    public $is_complete_penyidik = false;
    public $is_akses_penyidik = false;

    // chart
    public $chart_line_bulan = array();
    public $chart_line_total = array();
    public $chart_pie_bulan = array();
    public $chart_pie_total = array();

    public function mount()
    {
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan, admin-master
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login

        // admin-kejaksaan
        if ($this->role == 'admin-kejaksaan' || $this->role == 'admin-master' || $this->role == 'admin' || $this->role == 'admin-kepolisian') {
            // data dashboard
            $this->listCard = array(
                array(
                    'title' => 'Perkara',
                    'data' => (new DashboardRepository)->countDataPerkara(),
                    'data_last_month' => (new DashboardRepository)->countDataPerkara($this->user, $this->role, true),
                    'icon' => 'fa-inbox',
                    'color-icon' => 'primary',
                    'filter' => ''
                ),
                array(
                    'title' => 'SPDP',
                    'data' => (new DashboardRepository)->countDataForCard('spdp'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('spdp', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'spdp'
                ),
                array(
                    'title' => 'P16',
                    'data' => (new DashboardRepository)->countDataForCard('p16'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p16', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p16'
                ),
                array(
                    'title' => 'P17',
                    'data' => (new DashboardRepository)->countDataForCard('p17'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p17', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p17'
                ),
                array(
                    'title' => 'P18',
                    'data' => (new DashboardRepository)->countDataForCard('p18'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p18', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p18'
                ),
                array(
                    'title' => 'P20',
                    'data' => (new DashboardRepository)->countDataForCard('p20'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p20', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p20'
                ),
                array(
                    'title' => 'P21',
                    'data' => (new DashboardRepository)->countDataForCard('p21'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p21', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p21'
                ),
                array(
                    'title' => 'P21 A',
                    'data' => (new DashboardRepository)->countDataForCard('p21a'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('p21a', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'p21a'
                ),
                array(
                    'title' => 'Berkas',
                    'data' => (new DashboardRepository)->countDataForCard('Resume Berkas Perkara'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('Resume Berkas Perkara', true),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'berkas'
                ),
                array(
                    'title' => 'SPDP Kembali',
                    'data' => (new DashboardRepository)->countDataForCard('spdp kembali', false, 'spdp kembali'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('spdp kembali', true, 'spdp kembali'),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'spdp-kembali'
                ),
                array(
                    'title' => 'Proses Penelitian',
                    'data' => (new DashboardRepository)->countDataForCard('proses penelitian', false, 'proses penelitian'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('proses penelitian', true, 'proses penelitian'),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'proses-penelitian'
                ),
                array(
                    'title' => 'Tahap II',
                    'data' => (new DashboardRepository)->countDataForCard('tahap2', false, 'tahap2'),
                    'data_last_month' => (new DashboardRepository)->countDataForCard('tahap2', true, 'tahap2'),
                    'icon' => 'fa-file-text-o',
                    'color-icon' => 'info',
                    'filter' => 'tahap-2'
                ),
            );

            $this->chart_line_bulan = getListBulanChart((new DashboardRepository)->dataChartDashboardAdmin(12));
            $this->chart_line_total = getListChart((new DashboardRepository)->dataChartDashboardAdmin(12), 'total');
            $this->chart_pie_bulan = getListBulanChart((new DashboardRepository)->dataChartDashboardAdmin(11));
            $this->chart_pie_total = getListChart((new DashboardRepository)->dataChartDashboardAdmin(11), 'total');
        }

        if ($this->role == 'kepolisian') {
            $this->countDataPranut = (new DashboardRepository)->countDataPranut($this->role, $this->user->id);
            $this->countDataPranutOpen = (new DashboardRepository)->countDataPranutOpen($this->role, $this->user->id);
            $this->countDataBerkas = (new DashboardRepository)->countDataBerkas($this->role, $this->user->id);
            $this->countDataBpacTipiring = (new DashboardRepository)->countDataBpacTipiring($this->role, $this->user->id);
            $this->countDataDiversi = (new DashboardRepository)->countDataDiversi($this->role, $this->user->id);
            $this->countDataRumahTahanan = (new DashboardRepository)->countDataRumahTahanan();
            $this->countDataTahanan = (new DashboardRepository)->countDataTahanan();
            $this->countDataBerkasTahapII = (new DashboardRepository)->countDataBerkasTahapII($this->role, $this->user->id);
            // check profile kepolisian
            $profilePenyidik = (new PenyidikRepository)->penyidikByUserId($this->user->id);
            if ($profilePenyidik) {
                $this->is_complete_penyidik = true;
            }

            /**
             * check mapping data, user ini sudah dimapping atau belum
             */
            $this->is_akses_penyidik = (new PenyidikRepository)->aksesByUserId($this->user->id);
        }

        if ($this->role == 'kejaksaan') {
            $this->countDataPranut = (new DashboardRepository)->countDataPranut($this->role, $this->user->id);
            $this->countDataPranutWithoutBerkas = (new DashboardRepository)->countDataSpdpKembali($this->role, $this->user->id);
            $this->countDataBerkas = (new DashboardRepository)->countDataBerkas($this->role, $this->user->id);
            $this->countDataP21 = (new DashboardRepository)->countDataP21($this->role, $this->user->id);
            $this->countDataRumahTahanan = (new DashboardRepository)->countDataRumahTahanan();
            $this->countDataTahanan = (new DashboardRepository)->countDataTahanan();
            $this->countDataBerkasTahapII = (new DashboardRepository)->countDataBerkasTahapII($this->role, $this->user->id);

            $dataJaksa = (new KejaksaanRepository())->userJaksaByUserId($this->user->id);
            if ($dataJaksa) {
                $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignPerkara($dataJaksa->id);
            }

            // check jaksa have user or no
            $jaksaHaveUser = (new KejaksaanRepository)->userJaksaByUserId($this->user->id);
            if ($jaksaHaveUser != null) {
                $this->activeJaksa = true;
            }
        }

        if ($this->role == 'pengadilan') {
            $this->countDataRumahTahanan = (new DashboardRepository)->countDataRumahTahanan();
            $this->countDataTahanan = (new DashboardRepository)->countDataTahanan();
        }

        if ($this->role == 'lapas' || $this->role == 'admin-lapas') {
            $this->listCard = array(
                array('title' => 'Izin Penahanan', 'data' => (new DashboardRepository)->countDataIzinPenahan(), 'data_last_month' => (new DashboardRepository)->countDataIzinPenahan(true), 'icon' => 'fa-inbox', 'color-icon' => 'primary'),
                array('title' => 'Jadwal Sidang', 'data' => (new DashboardRepository)->countDataForCard(''), 'data_last_month' => (new DashboardRepository)->countDataForCard('', true), 'icon' => 'fa-file-text-o', 'color-icon' => 'info'),
                array('title' => 'Petikan Putusan', 'data' => (new DashboardRepository)->countDataForCard(''), 'data_last_month' => (new DashboardRepository)->countDataForCard('', true), 'icon' => 'fa-file-text-o', 'color-icon' => 'info'),
            );
        }

        if (
            $this->role == 'operator-01' ||
            $this->role == 'operator-02' ||
            $this->role == 'operator-03' ||
            $this->role == 'operator-04' ||
            $this->role == 'operator-kasi-pidum' ||
            $this->role == 'operator-kasi-pidsus'
        ) {
            $this->countDataPranut = (new DashboardRepository)->countDataPranut($this->role, $this->user->id);
            $this->countDataPranutWithoutBerkas = (new DashboardRepository)->countDataSpdpKembali($this->role, $this->user->id);
            $this->countDataBerkas = (new DashboardRepository)->countDataBerkas($this->role, $this->user->id);
            $this->countDataP21 = (new DashboardRepository)->countDataP21($this->role, $this->user->id);
            $this->countDataRumahTahanan = (new DashboardRepository)->countDataRumahTahanan();
            $this->countDataTahanan = (new DashboardRepository)->countDataTahanan();
            $this->countDataBerkasTahapII = (new DashboardRepository)->countDataBerkasTahapII($this->role, $this->user->id);
        }
    }

    protected $listeners = [
        'authPin',
    ];

    public function selectData($perkaraId)
    {
        $this->dataPranutById = (new PerkaraService())->perkaraById($perkaraId);
    }

    public function authPin($pin, $id)
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

    public function render()
    {
        $request = [
            'query' => $this->query,
            'status' => Constant::ON_PROGRESS,
        ];

        // dashboard admin-kejaksaan
        $dataPenangananOlehJaksa = (new DashboardRepository)->getDataPenanganganPerkaraOlehJaksa()->paginate($this->perPage, ['*'], 'penangananOlehJaksa'); // before
        $this->page > $dataPenangananOlehJaksa->lastPage() ? $this->page = $dataPenangananOlehJaksa->lastPage() : true;
        $paginate_content = (new DataMasterRepository)->contentPaginate($dataPenangananOlehJaksa);

        // dashboard admin-kepolisian
        $dataPenangananOlehKepolisian = (new DashboardRepository)->getDataPerkaraByPenangananKepolisian()->paginate($this->perPage, ['*'], 'penangananOlehKepolisian');
        $this->pagePenangananKepolisian > $dataPenangananOlehKepolisian->lastPage() ? $this->pagePenangananKepolisian = $dataPenangananOlehKepolisian->lastPage() : true;
        $paginate_content_kepolisian = (new DataMasterRepository)->contentPaginate($dataPenangananOlehKepolisian);

        $dataNotification = (new DashboardRepository)->getDataNotificationActivity()->paginate($this->perPage, ['*'], 'notification'); // before
        $this->pageNotification > $dataNotification->lastPage() ? $this->pageNotification = $dataNotification->lastPage() : true;
        $paginate_content_notification = (new DataMasterRepository)->contentPaginate($dataNotification);

        // modal berkas
        $dataPrapenuntutans = (new PerkaraService())->index($request, $this->role, $this->user->id, $this->arrayPerkaraId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content_modal_berkas = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);

        return view('livewire.dashboard.index', compact('paginate_content', 'dataPenangananOlehJaksa', 'dataPrapenuntutans', 'paginate_content_modal_berkas', 'dataNotification', 'paginate_content_notification', 'dataPenangananOlehKepolisian', 'paginate_content_kepolisian'));
    }
}
