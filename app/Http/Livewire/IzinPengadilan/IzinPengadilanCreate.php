<?php

namespace App\Http\Livewire\IzinPengadilan;

use App\Akses;
use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\DB;
use App\Services\IzinPengadilanService;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\TersangkaRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\PengadilanRepository;
use App\Http\Repositories\IzinPengadilanRepository;

class IzinPengadilanCreate extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $is_selected = false;
    public $is_tersangka = false;
    public $jns_pihak;
    public $query = '';
    public $arrayPerkaraId = [];
    public $perPage = 10;
    public $switch_pihak = false;
    public $fitur;
    public $pengadilans;
    public $dataTersangkas;

    public $perkara_id = null;
    public $tersangka_id = null;
    public $penggeledahan_terhadap_id = null;
    public $satker = '';
    public $penyidik = '';
    public $jpu = '';
    public $label = '';
    public $jenisPenetapans, $penggeledahanTerhadaps;

    public $pengadilan_id, $name, $alamat, $tempat_lahir, $tgl_lahir, $jk, $agama, $kebangsaan, $pekerjaan;
    public $file;
    public $jns_penetapan_id, $tgl_surat_permohonan, $tgl_surat_perintah, $tgl_lapor, $tgl_ba,
        $no_surat_permohonan, $no_surat_perintah, $no_lapor, $no_ba, $lokasi, $barang_sita;

    public $chooseIdPerkara, $chooseIdTersangka;

    public function mount($fitur)
    {
        $this->fitur = $fitur;
        if ($fitur == "izin-sita") {
            $this->label = "Izin Sita";
        } else {
            $this->label = "Izin Geledah";
            $this->penggeledahanTerhadaps = (new IzinPengadilanService())->penggeledahanTerhadap();
        }
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan, admin-master
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->pengadilans = (new PengadilanRepository())->listPengadilan();
        $this->jenisPenetapans = (new IzinPengadilanService())->jenisPenetapanByType($fitur);

        if ($this->role == 'kepolisian') {
            $this->satker = kategoriBagian()['name'];
            $this->penyidik = penyidik();
        }

        if ($this->role == 'kejaksaan') {
            $this->satker = kategoriBagian()['name'];
            $this->jpu = jpu();
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
    }

    protected $listeners = [
        'store',
    ];

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
                'jns_penetapan_id' => 'required',
                'tgl_surat_permohonan' => 'required',
                'tgl_surat_perintah' => 'required',
                'tgl_lapor' => 'required',
                'tgl_ba' => 'required',
                'no_surat_permohonan' => 'required',
                'no_surat_perintah' => 'required',
                'no_lapor' => 'required',
                'no_ba' => 'required',
                'lokasi' => 'required',
                'pengadilan_id' => 'required',
            ],
            [
                'name.required' => 'Data ini tidak boleh kosong',
                'file.required' => 'Data ini tidak boleh kosong',
                'jns_penetapan_id.required' => 'Data ini tidak boleh kosong',
                'tgl_surat_permohonan.required' => 'Data ini tidak boleh kosong',
                'tgl_surat_perintah.required' => 'Data ini tidak boleh kosong',
                'tgl_lapor.required' => 'Data ini tidak boleh kosong',
                'tgl_ba.required' => 'Data ini tidak boleh kosong',
                'no_surat_permohonan.required' => 'Data ini tidak boleh kosong',
                'no_surat_perintah.required' => 'Data ini tidak boleh kosong',
                'no_lapor.required' => 'Data ini tidak boleh kosong',
                'no_ba.required' => 'Data ini tidak boleh kosong',
                'lokasi.required' => 'Data ini tidak boleh kosong',
                'pengadilan_id.required' => 'Data ini tidak boleh kosong',
            ]
        );

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
            $request->perkara_id = $this->perkara_id;
            $request->name = $this->name;
            $request->alamat = $this->alamat;
            $request->tempat_lahir = $this->tempat_lahir;
            $request->tgl_lahir = $this->tgl_lahir;
            $request->jk = $this->jk;
            $request->agama = $this->agama;
            $request->kebangsaan = $this->kebangsaan;
            $request->pekerjaan = $this->pekerjaan;
            $request->file = $this->file;
            $request->jns_penetapan_id = $this->jns_penetapan_id;
            $request->tgl_surat_permohonan = $this->tgl_surat_permohonan;
            $request->tgl_surat_perintah = $this->tgl_surat_perintah;
            $request->tgl_lapor = $this->tgl_lapor;
            $request->tgl_ba = $this->tgl_ba;
            $request->no_surat_permohonan = $this->no_surat_permohonan;
            $request->no_surat_perintah = $this->no_surat_perintah;
            $request->no_lapor = $this->no_lapor;
            $request->no_ba = $this->no_ba;
            $request->lokasi = $this->no_ba;
            $request->penggeledahan_terhadap_id = $this->penggeledahan_terhadap_id;
            $request->pengadilan_id = $this->pengadilan_id;
            $request->jns_pihak = $this->jns_pihak;
            $request->barang_sita = $this->barang_sita;

            $izinPengadilan = (new IzinPengadilanRepository)->store($request, $this->user->id, $this->fitur);

            if ($izinPengadilan) {
                /**
                 * store data files
                 */
                (new IzinPengadilanRepository)->storeFile($request, $izinPengadilan);
                /**
                 * store data tersangka
                 */
                (new IzinPengadilanRepository)->storePihak($request, $izinPengadilan);

                // notif for pengadilan terkait
                $aksesPengadilans = Akses::where('kategori_bagian_id', $this->pengadilan_id)->get();
                foreach ($aksesPengadilans as $ap) {
                    $text = 'Telah upload pengajuan Izin Sita';
                    $req = [
                        'user_id' => $this->user->id,
                        'notif_for' => $ap->user_id, // user id pengadilan terkait
                        'desc' => $text,
                        'data_id' => $izinPengadilan->id,
                        'notif_fitur' => 'Upload Izin Sita',
                        'notif_type' => Constant::NOTIF_IZIN_SITA
                    ];

                    notificationOne($req);
                }
                DB::commit();
                return redirect()->to('/izin-pengadilan?fitur=' . $this->fitur)->with(['success' => 'Pengajuan Berhasil']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function selectData($perkara_id)
    {
        // get list tersangka
        $this->perkara_id = null;
        $this->is_selected = true;
        $this->dataTersangkas = (new TersangkaRepository())->listTersangkaByPerkaraId($perkara_id);
        $this->perkara_id = $perkara_id;
        // call js
        $this->chooseIdPerkara = $perkara_id;
        $this->emit('chooseLp', $this->chooseIdPerkara);
    }

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

    public function render()
    {
        $request = [
            'query' => $this->query
        ];

        // modal berkas
        $dataPrapenuntutans = (new PerkaraService())->index($request, $this->role, $this->user->id, $this->arrayPerkaraId)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content_modal_berkas = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);
        // call js
        $this->emit('refreshJs');
        $this->emit('chooseLp', $this->chooseIdPerkara);
        $this->emit('chooseSuspect', $this->chooseIdTersangka);

        return view('livewire.izin-pengadilan.izin-pengadilan-create', compact('dataPrapenuntutans', 'paginate_content_modal_berkas'));
    }
}
