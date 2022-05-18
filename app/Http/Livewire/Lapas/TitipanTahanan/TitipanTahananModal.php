<?php

namespace App\Http\Livewire\Lapas\TitipanTahanan;

use App\Akses;
use App\Http\Repositories\Admin\LapasRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\TersangkaRepository;
use App\Http\Repositories\UserRepository;
use App\RumahTahanan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class TitipanTahananModal extends Component
{
    use WithFileUploads;

    public $switch_pihak = false;
    public $query = '';
    public $perPage = 10;
    public $page;
    public $is_selected = false;
    public $label = '';
    public $fitur = '';
    public $name, $file, $alamat, $tempat_lahir, $tgl_lahir, $jk, $agama, $kebangsaan, $pekerjaan, $rumah_tahanan, $catatan, $lapas_id;

    public function mount()
    {
        $this->user = thisUser();
        $this->dataPenyidik = (new UserRepository)->dataPenyidik($this->user->id);
        $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);
        $this->rumah_tahanans = RumahTahanan::select('name', 'id')->get();
        $this->lapas = (new LapasRepository)->listLapas();
    }

    public function selectData($perkara_id)
    {
        // get list tersangka
        $this->perkara_id = null;
        $this->is_selected = true;
        $this->dataTersangkas = (new TersangkaRepository)->listTersangkaByPerkaraId($perkara_id);
        $this->perkara_id = $perkara_id;
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
                'alamat' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'agama' => 'required',
                'kebangsaan' => 'required',
                'pekerjaan' => 'required',
                'file' => 'required',
                'catatan' => 'required',
                'rumah_tahanan' => 'required',
            ],
            [
                'required' => 'Data ini tidak boleh kosong',
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
            $request->rumah_tahanan = $this->rumah_tahanan;
            $request->lapas_id = $this->lapas_id;
            $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
            $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;

            $dataTitipanTahanan = (new LapasRepository)->storeTitipanTahanan($request);

            if ($dataTitipanTahanan) {


                $dataTersangka = (new LapasRepository)->storeDataTersangkaTitipanTahanan($request, $dataTitipanTahanan);
                /**
                 * store data files
                 */
                (new LapasRepository)->storeFileTitipanTahanan($request, $dataTitipanTahanan);
                /**
                 * store data titipan tahanan
                 */

                // notif for pengadilan terkait
                $aksesPengadilans = Akses::where('kategori_bagian_id', $this->lapas_id)->get();
                foreach ($aksesPengadilans as $ap) {
                    $text = 'Telah upload pengajuan Izin Sita';
                    $req = [
                        'user_id' => $this->lapas_id,
                        'notif_for' => $this->lapas_id,
                        'desc' => $text,
                        'data_id' => $dataTitipanTahanan->id,
                        'notif_fitur' => 'Upload Titipan Penahanan',
                        'notif_type' => Constant::NOTIF_PENAHANAN
                    ];

                    notificationOne($req);
                }
                DB::commit();
                return redirect()->to('/titipan-tahanan')->with(['success' => 'Data Berhasil Di buat']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        $dataPrapenuntutans = (new LapasRepository)->listDataPranut($this->query)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content_modal_berkas = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);
        $this->emit('refreshJs');

        return view('livewire.lapas.titipan-tahanan.titipan-tahanan-modal', compact('dataPrapenuntutans', 'paginate_content_modal_berkas'));
    }
}
