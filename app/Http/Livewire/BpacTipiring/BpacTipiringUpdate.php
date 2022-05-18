<?php

namespace App\Http\Livewire\BpacTipiring;

use App\BpacTipiring;
use App\Constant;
use App\Http\Repositories\BpacTipiringRepository;
use App\Http\Repositories\PengadilanRepository;
use App\Http\Repositories\UserRepository;
use App\KategoriBagian;
use App\Penyidik;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithFileUploads;

class BpacTipiringUpdate extends Component
{
    use WithFileUploads;

    public $uid = null,
    $breadcrumb,
    $data,
    $tanggal_pelimpahan,
    $tanggal_register,
    $dataPenyidik,
    $penyidik,
    $penyidik_id,
    $pengadilan_id,
    $berkas,
    $listPengadilan,
    $file,
    $lastUploadedFile,
    $array_tersangka = [],
    $array_tersangka_deleted = [];

    // tersangka
    public $tersangka,
    $tempat_lahir,
    $tgl_lahir,
    $jk,
    $kebangsaan,
    $alamat,
    $agama,
    $pekerjaan,
    $pendidikan,
        $pasal,
        $nik;

    // kategori dan kategori bagian
    public $dataSatuanKerja, $nrp, $no_hp, $satuan_kerja, $user;
    public $fitur;

    public function mount($id = null, $fitur = 'edit')
    {
        $this->fitur = $fitur;

        try {
            $this->breadcrumb = "Tambah BACP Tipiring";
            $this->user = thisUser();
            $this->dataPenyidik = (new UserRepository)->dataPenyidik($this->user->id);
            $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);
            $this->penyidik = $this->dataPenyidik ? $this->dataPenyidik->name : 'Kosong';
            $this->penyidik_id = $this->dataPenyidik ? $this->dataPenyidik->id : null;
            
            $this->nrp = $this->dataPenyidik ? $this->dataPenyidik->nrp : 'Kosong';
            $this->no_hp = thisUser()->phone != null ? thisUser()->phone : 'Kosong';

            if ($this->dataSatuanKerja) {
                $this->satuan_kerja = $this->dataSatuanKerja->satker ? $this->dataSatuanKerja->satker->name : '';
            }

            $this->listPengadilan = (new PengadilanRepository)->listPengadilan();
            if ($id) {
                $idBpacTipiring = Crypt::decrypt($id);
                $this->data = (new BpacTipiringRepository)->getBpacTipiringById($idBpacTipiring);
                if ($this->data) {
                    if ($this->fitur == 'edit') {
                        $this->breadcrumb = "Edit BACP Tipiring";
                    } else {
                        $this->breadcrumb = "Detail BACP Tipiring";
                    }
                    $this->uid = $this->data->id;
                    $this->tanggal_pelimpahan = date('d-m-Y', strtotime($this->data->tanggal_pelimpahan));
                    $this->tanggal_register = date('d-m-Y', strtotime($this->data->tanggal_register));

                    $data_tersangka = (new BpacTipiringRepository)->dataTersangka($idBpacTipiring);
                    foreach ($data_tersangka as $dt) {
                        array_push($this->array_tersangka, [
                            'id' => $dt->id,
                            'name' => $dt->name,
                            'tempat_lahir' => $dt->tempat_lahir,
                            'tgl_lahir' => $dt->tgl_lahir,
                            'jk' => $dt->jk,
                            'kebangsaan' => $dt->kebangsaan,
                            'alamat' => $dt->alamat,
                            'agama' => $dt->agama,
                            'pekerjaan' => $dt->pekerjaan,
                            'pendidikan' => $dt->pendidikan,
                            'pasal' => $dt->pasal,
                            'id_bpac_tipiring' => $this->data->id,
                            'created_by' => $dt->created_by,
                            'updated_by' => $this->user->id,
                            'nik' => $dt->nik
                        ]);
                    }
                }
            } else {
                $this->tanggal_register = date('d-m-Y');
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addData()
    {
        $this->validate(['tanggal_pelimpahan' => 'required|date',
            'tanggal_register' => 'required|date',
            'penyidik_id' => 'required|exists:penyidiks,id',
            'file' => $this->uid != null ? 'nullable|max:25600|mimes:pdf' : 'required|max:25600|mimes:pdf',
        ],
            [
                'file.mimes' => 'format yang digunakan: pdf',
                'file.max' => 'max ukuran file 25mb',
            ]);

        $request = new \stdClass;
        $request->id = $this->uid;
        $request->tanggal_pelimpahan = $this->tanggal_pelimpahan;
        $request->tanggal_register = $this->tanggal_register;
        $request->penyidik_id = $this->penyidik_id;
        $request->pengadilan_id = $this->pengadilan_id;
        $request->file = $this->file;
        $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
        $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;
        
        $bpac_tipiring = (new BpacTipiringRepository)->storeBpacTipiring($request, Constant::PENGAJU);

        if ($bpac_tipiring) {
            // save data file
            (new BpacTipiringRepository)->storeFileBpacTipiring($request, Constant::PENGAJU, $bpac_tipiring);
            // save data tersangka
            (new BpacTipiringRepository)->storeTersangka($this->array_tersangka, $this->array_tersangka_deleted, $bpac_tipiring);

            // notif for kejaksaan
            $text = 'Telah Mengirim Surat Pengaju BACP Tipiring';
            $reqNotifOne = [
                'user_id' => Auth::user()->id,
                'notif_for' => $request->pengadilan_id,
                'desc' => $text,
                'data_id' => $bpac_tipiring->id,
                'notif_fitur' => 'Upload Surat Pengaju BACP Tipiring',
                'notif_type' => Constant::NOTIF_BACP
            ];

            // kirim notif ke user tektokan
            notificationOne($reqNotifOne);

            // kirim notif untuk admin kejaksaan
            $reqNotifMany = [
                'user_id'    => Auth::user()->id,
                'desc'       => $text,
                'data_id'    => $bpac_tipiring->id,
                'notif_type' => Constant::NOTIF_BACP
            ];
            notificationMany($reqNotifMany, 'admin-kejaksaan', 'Upload Surat Pengaju BACP Tipiring');
        }

        if ($this->data) {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/bacp-tipiring',
            ];
            $this->emit('sweetAlert', $param);
        } else {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/bacp-tipiring',
            ];
            $this->emit('sweetAlert', $param);
        }

        $modal = '#scrollingmodal';
        $this->emit('closeModal', $modal);
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

    public function addTersangka()
    {
        array_push($this->array_tersangka, [
            'id' => null,
            'name' => $this->tersangka,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' => $this->tgl_lahir,
            'jk' => $this->jk,
            'kebangsaan' => $this->kebangsaan,
            'alamat' => $this->alamat,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'pendidikan' => $this->pendidikan,
            'pasal' => $this->pasal,
            'created_by' => $this->user->id,
            'updated_by' => $this->data ? $this->user->id : null,
            'nik' => $this->nik,
        ]);

        $this->tersangka = '';
        $this->tempat_lahir = '';
        $this->tgl_lahir = '';
        $this->jk = '';
        $this->kebangsaan = '';
        $this->alamat = '';
        $this->agama = '';
        $this->pekerjaan = '';
        $this->pendidikan = '';
        $this->pasal = '';
        $this->nik = '';

        $modal = '#scrollingmodal';
        $this->emit('closeModal', $modal);
    }

    public function removeTersangka($key)
    {
        $deleteDataCollect = $this->array_tersangka[$key];
        if (isset($deleteDataCollect)) {
            if ($deleteDataCollect['id'] != null) {
                $this->array_tersangka_deleted[] = $deleteDataCollect['id'];
            }
        }
        unset($this->array_tersangka[$key]);
        $this->array_tersangka = array_values($this->array_tersangka);
        $deleteDataCollect = '';
    }

    public function render()
    {
        if ($this->fitur == 'edit') {
            return view('livewire.bpac-tipiring.bpac-tipiring-update');
        } else {
            return view('livewire.bpac-tipiring.bpac-tipiring-detail');
        }
    }
}
