<?php

namespace App\Http\Livewire\Kejaksaan\BeritaAcara;

use App\BeritaAcara;
use App\Http\Repositories\BeritaAcaraRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\UserRepository;
use App\Penyidik;
use App\Services\PerkaraService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BeritaAcaraModal extends Component
{
    public $uid = null, $name_formil, $name_materil, $perkara_id, $formil, $materil, $kesimpulan, $tanggal, $surat_perintah, $alamat;
    public $formils = [], $array_formils_deleted = [];
    public $materils = [], $array_materils_deleted = [];
    public $dataPranutById, $query = '', $page, $perPage = 10;

    // kategori dan kategori bagian
    public $dataSatuanKerja, $nrp, $no_hp, $satuan_kerja, $user, $dataPenyidik, $penyidik, $penyidik_id;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";

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

        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addFormils()
    {
        array_push($this->formils, [
            'id' => null,
            'name' => $this->name_formil,
        ]);

        $this->name_formil = '';
        $modal = '#modalFormil';
        $this->emit('closeModal', $modal);
    }

    public function removeFormils($key)
    {
        $deleteDataCollect = $this->formils[$key];
        if (isset($deleteDataCollect)) {
            if ($deleteDataCollect['id'] != null) {
                $this->array_formils_deleted[] = $deleteDataCollect['id'];
            }
        }
        unset($this->formils[$key]);
        $this->formils = array_values($this->formils);
        $deleteDataCollect = '';
    }

    public function addMaterils()
    {
        array_push($this->materils, [
            'id' => null,
            'name' => $this->name_materil,
        ]);

        $this->name_materil = '';
        $modal = '#modalMateril';
        $this->emit('closeModal', $modal);
    }

    public function removeMaterils($key)
    {
        $deleteDataCollect = $this->materils[$key];
        if (isset($deleteDataCollect)) {
            if ($deleteDataCollect['id'] != null) {
                $this->array_materils_deleted[] = $deleteDataCollect['id'];
            }
        }
        unset($this->materils[$key]);
        $this->materils = array_values($this->materils);
        $deleteDataCollect = '';
    }

    public function addData()
    {
        $this->validate([
            'kesimpulan' => 'required',
            'alamat' => 'required',
            'surat_perintah' => 'required',
            'tanggal' => 'required',
        ],[
            'kesimpulan.required' => 'Kesimpulan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'surat_perintah.required' => 'Surat Perintah wajib diisi',
            'tanggal.required' => 'Tanggal Surat Perintah wajib diisi'
        ]);

        DB::beginTransaction();
        try {
            $request = new \stdClass;
            $request->id = $this->uid;
            $request->name_formil = $this->name_formil;
            $request->name_materil = $this->name_materil;
            $request->perkara_id = $this->perkara_id;
            $request->kesimpulan = $this->kesimpulan;
            $request->kategori_bagian_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->id : null;
            $request->kategori_id = $this->dataSatuanKerja ? $this->dataSatuanKerja->satker->kategori_id : null;
            $request->alamat = $this->alamat;
            $request->surat_perintah = $this->surat_perintah;   
            $request->tanggal = date('Y-m-d', strtotime($this->tanggal));
            /**
             * store Berita Acara
             */
            $berita_acara = (new BeritaAcaraRepository)->storeBeritaAcara($request);
            /**
             * store data formils
             */
            (new BeritaAcaraRepository)->storeFormils($this->formils, $this->array_formils_deleted, $berita_acara);

            /**
             * store data materils
             */
            (new BeritaAcaraRepository)->storeMaterils($this->materils, $this->array_materils_deleted, $berita_acara);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/berita-acara',
            ];
            $this->emit('sweetAlert', $param);

            $this->perkara_id = '';
            $this->formils = '';
            $this->materils = '';
            $this->kesimpulan = '';
            $this->name_formil = '';
            $this->name_materil = '';
            $this->alamat = '';
            $this->surat_perintah = '';
            $this->tanggal = '';
            DB::commit();
            return redirect()->to('/berita-acara')->with(['success' => 'Menambahkan Berita Acara Sukses']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

    }

    public function selectData($perkaraId)
    {
        $this->dataPranutById = (new PerkaraService)->perkaraById($perkaraId);
        $this->perkara_id = $perkaraId;
    }

    public function render()
    {
        $dataPrapenuntutans = (new BeritaAcaraRepository)->index($this->query)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $paginate_content_modal_berkas = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);

        return view('livewire.kejaksaan.berita-acara.berita-acara-modal', compact('dataPrapenuntutans', 'paginate_content_modal_berkas'));
    }
}
