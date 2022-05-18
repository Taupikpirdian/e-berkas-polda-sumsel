<?php

namespace App\Http\Livewire\DataPenahanan;

use App\Akses;
use App\Constant;
use App\Http\Repositories\Admin\LapasRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\DataPenahananRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\PengadilanRepository;
use App\Http\Repositories\PolresRepository;
use App\Http\Repositories\TersangkaRepository;
use App\Http\Repositories\UserRepository;
use App\JenisPenahanan;
use App\Lookup;
use App\RumahTahanan;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataPenahananUpdateModal extends Component
{
    use WithFileUploads;

    public $switch_pihak = false;
    public $query = '';
    public $perPage = 10;
    public $page;
    public $is_selected = false;
    public $label;
    public $fitur;
    public $arrayPerkaraId;
    public $role;
    public $chooseIdPerkara, $chooseIdTersangka;
    public $name, $file, $alamat, $tempat_lahir, $tgl_lahir, $jk, $agama, $kebangsaan, $pekerjaan, $catatan, $suratperintah_penahanan, $suratperpanjangan_kejaksaan, $listkejaksaan_id, $kejaksaan_id;
    public $jenis_penahanan, $jenispenahanan_id, $typepenahanan_id, $tglsurat_pengajuan, $nosurat_pengajuan, $waktuhabis_penahanan, $tindakpidana_tersangka, $pengadilan_id;

    public function mount($fitur)
    {
        $this->fitur = $fitur;
        if ($this->fitur == Constant::PENGADILAN_FEATURE) {
            $this->label = 'Permohonan Perpanjangan Penahanan';
        } elseif ($fitur == Constant::KEJAKSAAN_FEATURE) {
            $this->label = 'Permohonan Perpanjangan Penahanan';
        }

        $this->user = thisUser();
        $this->role = thisRole();
        $this->pengadilan = (new PengadilanRepository)->listPengadilan();
        $this->dataPenyidik = (new UserRepository)->dataPenyidik($this->user->id);
        $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);
        $this->rumah_tahanans = RumahTahanan::select('name', 'id')->get();
        $this->jenispenahanan = JenisPenahanan::select('name', 'id')->get();
        $this->type_penahanan = Lookup::select('name', 'id')->where('type', Constant::JENIS_PENAHANAN)->get();

        if ($this->role == 'kejaksaan') {
            $dataJaksa = (new KejaksaanRepository())->userJaksaByUserId($this->user->id);
            if ($dataJaksa) {
                $this->arrayPerkaraId = (new PerkaraService())->getPerkaraIdFromAssignPerkara($dataJaksa->id);
            }
        }
    }

    public function selectData($perkara_id)
    {
        // get list tersangka
        $this->perkara_id = null;
        $this->is_selected = true;
        $this->dataTersangkas = (new TersangkaRepository)->listTersangkaByPerkaraId($perkara_id);
        $this->perkara_id = $perkara_id;

        $this->chooseIdPerkara = $perkara_id;
        $this->emit('chooseLp', $this->chooseIdPerkara);
    }

    protected $listeners = [
        'store',
    ];

    public function selectTersangka($id)
    {
        // clear data
        $this->tersangka_id = null;
        $this->name = '';
        $this->alamat = '';
        $this->tempat_lahir = '';
        $this->tgl_lahir = '';
        $this->jk = '';
        $this->agama = '';
        $this->kebangsaan = '';
        $this->pekerjaan = '';

        $this->is_tersangka = true;
        $tersangka = (new TersangkaRepository())->getTersangkaById($id)->first();

        $this->name = $tersangka->name;
        $this->alamat = $tersangka->alamat;
        $this->tempat_lahir = $tersangka->tempat_lahir;
        $this->tgl_lahir = $tersangka->tgl_lahir;
        $this->jk = $tersangka->jk;
        $this->agama = $tersangka->agama;
        $this->kebangsaan = $tersangka->kebangsaan;
        $this->pekerjaan = $tersangka->pekerjaan;
        $this->tersangka_id = $id;

        // call js
        $this->chooseIdTersangka = $id;
        $this->emit('chooseSuspect', $this->chooseIdTersangka);
    }

    public function validateData()
    {
        /**
         * if file object, then validate mime and size data
         */
        if (is_object($this->file)) {
            $this->validate(
                [
                    'file' => 'mimes:pdf|max:2000',
                ],
                [
                    'file.mimes' => 'format yang digunakan: pdf',
                    'file.max' => 'max ukuran file 2mb',
                ]
            );
        }

        $this->validate(
            [
                'name' => 'required',
                'file' => 'required',
                'tindakpidana_tersangka' => 'required',
                'waktuhabis_penahanan' => 'required',
                'nosurat_pengajuan' => 'required',
                'tglsurat_pengajuan' => 'required',
                'typepenahanan_id' => 'required',
                'jenispenahanan_id' => 'required',
                'jenis_penahanan' => 'required',
                'suratperintah_penahanan' => 'required',
            ],
            [
                'required' => 'Data ini tidak boleh kosong',
            ]
        );

        if (Auth::user()->hasRole('kejaksaan')) {
            $this->validate(
                [
                    'suratperpanjangan_kejaksaan' => 'required',
                ],
                [
                    'required' => 'Data ini tidak boleh kosong',
                ]
            );
        }

        if ($this->fitur == Constant::PENGADILAN_FEATURE) {
            $this->validate(
                [
                    'pengadilan_id' => 'required',
                ],
                [
                    'required' => 'Data ini tidak boleh kosong',
                ]
            );
        }

        // store data
        $this->emit('confirmSubmit');
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            /**
             * store data perkara
             */
            $request = new \stdClass;
            $request->name = $this->name;
            $request->alamat = $this->alamat;
            $request->tempat_lahir = $this->tempat_lahir;
            $request->tgl_lahir = $this->tgl_lahir;
            $request->jk = $this->jk;
            $request->agama = $this->agama;
            $request->kebangsaan = $this->kebangsaan;
            $request->pekerjaan = $this->pekerjaan;
            $request->file = $this->file;
            $request->catatan = $this->catatan;
            $request->pengadilan_id = $this->pengadilan_id;
            $request->tindakpidana_tersangka = $this->tindakpidana_tersangka;
            $request->jenis_penahanan = $this->jenis_penahanan;
            $request->waktuhabis_penahanan = $this->waktuhabis_penahanan;
            $request->nosurat_pengajuan = $this->nosurat_pengajuan;
            $request->tglsurat_pengajuan = $this->tglsurat_pengajuan;
            $request->typepenahanan_id = $this->typepenahanan_id;
            $request->jenispenahanan_id = $this->jenispenahanan_id;
            $request->suratperintah_penahanan = $this->suratperintah_penahanan;
            $request->suratperpanjangan_kejaksaan = $this->suratperpanjangan_kejaksaan;
            $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
            $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;

             /**
             * store data penahanan
             */
            $dataPenahanan = (new DataPenahananRepository)->storeDataPenahanan($request, $this->fitur, $this->perkara_id);

            if ($dataPenahanan) {
                /**
                 * store data tersangka
                 */
                (new DataPenahananRepository)->storeTersangkaDataPenahanan($request, $dataPenahanan);
                /**
                 * store data files
                 */
                (new DataPenahananRepository)->storeFileDataPenahanan($request, $dataPenahanan);
                /**
                 * store assign data permohonan perpanjangan penahanan
                 */
                (new DataPenahananRepository)->assignDataPenahanan($request, $dataPenahanan, $this->fitur, $this->perkara_id);
                

                // notif for pengadilan terkait
                $aksesPengadilans = Akses::where('kategori_bagian_id', $this->pengadilan_id)->get();
                foreach ($aksesPengadilans as $ap) {
                    $text = 'Telah upload pengajuan Izin Sita';
                    $req = [
                        'user_id' => $this->pengadilan_id,
                        'notif_for' => $this->pengadilan_id,
                        'desc' => $text,
                        'data_id' => $dataPenahanan->id,
                        'notif_fitur' => 'Upload Titipan Penahanan',
                        'notif_type' => Constant::NOTIF_PENAHANAN
                    ];

                    notificationOne($req);
                }
                DB::commit();
                return redirect()->to('/data-penahanan?fitur=' . $this->fitur)->with(['success' => 'Data Berhasil Di buat']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        $dataPrapenuntutans = (new LapasRepository)->listDataPranut($this->query, $this->arrayPerkaraId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content_modal_berkas = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);
        $this->emit('refreshJs');
        $this->emit('chooseLp', $this->chooseIdPerkara);
        $this->emit('chooseSuspect', $this->chooseIdTersangka);

        return view('livewire.data-penahanan.data-penahanan-update-modal', compact('dataPrapenuntutans', 'paginate_content_modal_berkas'));
    }
}
