<?php

namespace App\Http\Livewire\Kejaksaan\Perpanjangan;

use App\Http\Repositories\DataPenahananRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\PerpanjanganPenahananRepository;
use App\Http\Repositories\TersangkaPenahananRepository;
use App\Http\Repositories\TersangkaRepository;
use App\Http\Repositories\UserRepository;
use App\Pejabat;
use App\RumahTahanan;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class PerpanjanganModal extends Component
{
    use WithFileUploads;

    public $tersangka_perkara, 
    $nama_tersangka, 
    $nomor_t4, 
    $tanggal_t4, 
    $nomor_permintaan, 
    $tanggal_permintaan_perpanjangan, 
    $uraian_kejadian, $lama_perpanjangan, 
    $tanggal_perpanjangan, 
    $tanda_tangan,
    $rumah_tahanan,
    $tanda_tangans,
    $id_encrypt,
    $file,
    $perkara_id,
    $dataSatuanKerja,
    $file_perpanjangan_penahanan,
    $perpanjangan_penahanan,

    $rumah_tahanans;

    public function mount($id)
    {
        try {
            $this->id_encrypt = Crypt::decrypt($id);
            $this->breadcrumb = "";
            $this->tersangka_perkara = (new TersangkaPenahananRepository)->getListDataPenahananId($this->id_encrypt)->first();
            $this->perkara_id = (new DataPenahananRepository)->listDataPenahananById($this->id_encrypt);
            $this->user = thisUser();
            $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);
            $this->nama_tersangka = $this->tersangka_perkara->name;
            $this->tanda_tangans = Pejabat::select('name', 'id')->get();
            $this->rumah_tahanans = RumahTahanan::select('name', 'id')->get();

            // list perpanjangan penahanan 
            $data_perpanjangan_penahanan = (new PerpanjanganPenahananRepository)->getPerpanjanganPenahananById($this->id_encrypt);
            if($data_perpanjangan_penahanan) {
                $data_file_data_perpanjangan_penahanan = (new PerpanjanganPenahananRepository)->filePerpanjanganPenahanan($data_perpanjangan_penahanan->id);
                $this->perpanjangan_penahanan = $data_perpanjangan_penahanan;
                $this->file_perpanjangan_penahanan = $data_file_data_perpanjangan_penahanan;
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function update()
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

        DB::beginTransaction();
        try {
            $request = new \stdClass;
            $request->file = $this->file;
            (new PerpanjanganPenahananRepository)->createFilePerpanjanganPenahanan($request, $this->perpanjangan_penahanan);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/perpanjangan-penahanan'
            ];
            $this->file = '';
            
            $this->emit('sweetAlert', $param);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function addData()
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


        $this->validate([
            'nomor_t4' => 'required',
            'tanggal_t4' => 'required',
            'nomor_permintaan' => 'required',
            'tanggal_permintaan_perpanjangan' => 'required',
            'uraian_kejadian' => 'required',
            'lama_perpanjangan' => 'required',
            'tanggal_perpanjangan' => 'required',
            'rumah_tahanan' => 'required',
            'tanda_tangan' => 'required',
        ],
        [
            'required' => 'Data ini tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try {
            $request = new \stdClass;
            
            $request->nomor_t4 = $this->nomor_t4;
            $request->perkara_id = $this->perkara_id;
            $request->tanggal_t4 = date("Y-m-d", strtotime($this->tanggal_t4));
            $request->nomor_permintaan = $this->nomor_permintaan;
            $request->tanggal_permintaan_perpanjangan = date("Y-m-d", strtotime($this->tanggal_permintaan_perpanjangan));
            $request->uraian_kejadian = $this->uraian_kejadian;
            $request->file = $this->file;
            $request->lama_perpanjangan = $this->lama_perpanjangan;
            $request->tanggal_perpanjangan = date("Y-m-d", strtotime($this->tanggal_perpanjangan));
            $request->rumah_tahanan = $this->rumah_tahanan;
            $request->tanda_tangan = $this->tanda_tangan;
            $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
            $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;

            // create perpanjangan penahanan
            $data = (new PerpanjanganPenahananRepository)->createPerpanjanganPenahanan($request, $this->id_encrypt);

            if($data) {
                (new PerpanjanganPenahananRepository)->createFilePerpanjanganPenahanan($request, $data);
            }

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/perpanjangan-penahanan'
            ];
            
            $this->emit('sweetAlert', $param);

            $this->id_tersangka = '';
            $this->file = '';
            $this->nomor_t4 = '';
            $this->tanggal_t4 = '';
            $this->nomor_permintaan = '';
            $this->tanggal_permintaan_perpanjangan = '';
            $this->uraian_kejadian = '';
            $this->lama_perpanjangan = '';
            $this->tanggal_perpanjangan = '';
            $this->rumah_tahanan = '';
            $this->tanda_tangan = '';
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.kejaksaan.perpanjangan.perpanjangan-modal');
    }
}
