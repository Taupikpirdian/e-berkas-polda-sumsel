<?php

namespace App\Http\Livewire\Diversi;

use App\Constant;
use App\Http\Repositories\DiversiRepository;
use App\Http\Repositories\PengadilanRepository;
use App\Http\Repositories\UserRepository;
use App\KategoriBagian;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithFileUploads;

class DiversiModalUpdate extends Component
{
    use WithFileUploads;

    public $uid = null,
    $breadcrumb,
    $data,
    $tanggal_register,
    $nomor_register,
    $nama_terdakwa,
    $pengaju,
    $berkas,
    $pengadilan_id,
    $pengadilan_data,
        $lastUploadedFile,
        $pasal;
    public $nama_tersangka, $file, $alamat, $tempat_lahir, $tgl_lahir, $jk, $agama, $kebangsaan, $pekerjaan, $pendidikan, $rumah_tahanan, $catatan, $lapas_id;
    
    // kategori dan kategori bagian
    public $dataPenyidik, $dataSatuanKerja, $penyidik, $nrp, $no_hp, $satuan_kerja, $user;

    public function mount($id = null)
    {
        try {
            $this->user = thisUser();
            $this->dataPenyidik = (new UserRepository)->dataPenyidik($this->user->id);
            $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);

            $this->penyidik = $this->dataPenyidik ? $this->dataPenyidik->name : 'Kosong';
            $this->nrp = $this->dataPenyidik ? $this->dataPenyidik->nrp : 'Kosong';
            $this->no_hp = thisUser()->phone != null ? thisUser()->phone : 'Kosong';

            if ($this->dataSatuanKerja) {
                $this->satuan_kerja = $this->dataSatuanKerja->satker ? $this->dataSatuanKerja->satker->name : '';
            }

            $this->breadcrumb = "Tambah Diversi";
            $this->pengadilan_data = (new PengadilanRepository)->listPengadilan();
            if ($id) {
                $idDiversi = Crypt::decrypt($id);
                $this->data = (new DiversiRepository)->getDiversiById($idDiversi);
                if ($this->data) {
                    $this->breadcrumb = "Edit Diversi";
                    $this->uid = $this->data->id;
                    $this->tanggal_register = date('d-m-Y', strtotime($this->data->tanggal_register));
                    $this->nomor_register = $this->data->nomor_register;
                    $this->nama_terdakwa = $this->data->nama_terdakwa;
                    $this->pengaju = $this->data->pengaju;
                    $this->pasal = $this->data->pasal;
                }
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addData()
    {
        $this->validate([
            'nomor_register' => 'required',
            'nama_tersangka' => 'required',
            'pengadilan_id' => 'required',
            'file' => $this->uid != null ? 'nullable|max:25600|mimes:pdf' : 'required|max:25600|mimes:pdf',
        ],
            [
                'file.mimes' => 'format yang digunakan: pdf',
                'file.max' => 'max ukuran file 25mb',
            ]);

        $request = new \stdClass;
        $request->id = $this->uid;
        $request->nama_tersangka = $this->nama_tersangka;
        $request->alamat = $this->alamat;
        $request->tempat_lahir = $this->tempat_lahir;
        $request->tgl_lahir = $this->tgl_lahir;
        $request->jk = $this->jk;
        $request->agama = $this->agama;
        $request->kebangsaan = $this->kebangsaan;
        $request->pekerjaan = $this->pekerjaan;
        $request->pendidikan = $this->pendidikan;
        $request->pengadilan_id = $this->pengadilan_id;
        $request->nomor_register = $this->nomor_register;
        $request->file = $this->file;
        $request->pasal = $this->pasal;
        $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
        $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;

        $diversi = (new DiversiRepository)->storeDiversi($request);

        if ($diversi) {
            // tersangka
            (new DiversiRepository)->storeTersangkaDiversi($request, $diversi);

            // file diversi
            (new DiversiRepository)->storeFileDiversi($request, $diversi);
        }

        if ($this->data) {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/diversi',
            ];
            $this->emit('sweetAlert', $param);
        } else {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/diversi',
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->nama_tersangka = '';
        $this->alamat = '';
        $this->tempat_lahir = '';
        $this->tgl_lahir = '';
        $this->jk = '';
        $this->agama = '';
        $this->kebangsaan = '';
        $this->pekerjaan = '';
        $this->pendidikan = '';

    }

    protected $listeners = [
        'addData',
        'clearFormFile',
    ];

    public function clearFormFile($param)
    {
        if ($param == 'file') {
            $this->file = null;
        }
    }

    public function render()
    {
        return view('livewire.diversi.diversi-modal-update');
    }
}
