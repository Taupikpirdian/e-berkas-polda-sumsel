<?php

namespace App\Http\Livewire\Kepolisian\BarangBuktiNarkotika;

use App\Akses;
use App\Constant;
use App\Http\Repositories\BarangBuktiNarkotikaRepository;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\SpdpRepository;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BarangBuktiNarkotikaModalUpdate extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $query;
    public $perPage = 10;
    public $page = 1;
    public $perkara_id, $datafileperkara, $kejaksaan_id;
    public $is_selected = false;
    public $jaksa, $nomor_surat_permohonan, $file_permohonan, $berkas_sp_sita, $berkas_ba_sita, $berkas_ba_cc, $berkas_resume;
    public $tipe_lembaga;
    
    public function mount($id = null)
    {
        $this->tipe_lembaga = thisKategoriBagian()->tipelembaga_id;
        if($this->tipe_lembaga == Constant::TYPE_LEMBAGA_DIREKTORAT_POLDA || $this->tipe_lembaga == Constant::TYPE_LEMBAGA_POLDA) {
            $this->jaksa = (new KejaksaanRepository)->listJaksa();
        } else {
            $this->jaksa = (new KejaksaanRepository)->listJaksaByWilayah();
        }
    }

    public function selectData($perkara_id)
    {
        // get perkara_id
        $this->perkara_id = $perkara_id;
        $this->is_selected = true;
        $this->datafileperkara = (new SpdpRepository)->filePerkaraById($perkara_id);
    }

    protected $listeners = [
        'store',
    ];

    public function validateData()
    {
        /**
         * if file object, then validate mime and size data
         */
        if ($this->file_permohonan && $this->berkas_sp_sita && $this->berkas_ba_sita && $this->berkas_ba_cc && $this->berkas_resume) {
            $this->validate(
                [
                    'file_permohonan' => 'mimes:pdf|max:2000',
                    'berkas_sp_sita' => 'mimes:pdf|max:2000',
                    'berkas_ba_sita' => 'mimes:pdf|max:2000',
                    'berkas_ba_cc' => 'mimes:pdf|max:2000',
                    'berkas_resume' => 'mimes:pdf|max:2000',
                ],
                [
                    'mimes' => 'format yang digunakan: pdf',
                    'max' => 'max ukuran file 2mb',
                ]
            );
        }

        $this->validate(
            [
                'kejaksaan_id' => 'required',
                'nomor_surat_permohonan' => 'required',
                'file_permohonan' => 'required',
                'berkas_sp_sita' => 'required',
                'berkas_ba_sita' => 'required',
                'berkas_ba_cc' => 'required',
                'berkas_resume' => 'required',
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
            $request->perkara_id = $this->perkara_id;
            $request->kejaksaan_id = $this->kejaksaan_id;
            $request->nomor_surat_permohonan = $this->nomor_surat_permohonan;
            $request->file_permohonan = $this->file_permohonan; 
            $request->berkas_sp_sita = $this->berkas_sp_sita;
            $request->berkas_ba_sita = $this->berkas_ba_sita;
            $request->berkas_ba_cc = $this->berkas_ba_cc;
            $request->berkas_resume = $this->berkas_resume;
             /**
             * store data barang bukti
             */
            $dataBarangBukti = (new BarangBuktiNarkotikaRepository)->storeDataBarangBuktiNarkotika($request);

            if ($dataBarangBukti) {
                /**
                 * store data files
                 */
                (new BarangBuktiNarkotikaRepository)->storeFileBarangBuktiNarkotika($request, $dataBarangBukti);
                
                // notif for pengadilan terkait
                $aksesKejaksaan = Akses::where('kategori_bagian_id', $this->kejaksaan_id)->get();
                foreach ($aksesKejaksaan as $ap) {
                    $text = 'Telah upload pengajuan Izin Sita';
                    $req = [
                        'user_id' => $this->kejaksaan_id,
                        'notif_for' => $this->kejaksaan_id,
                        'desc' => $text,
                        'data_id' => $dataBarangBukti->id,
                        'notif_fitur' => 'Upload ',
                        'notif_type' => Constant::BARANG_BUKTI_NARKOTIKA
                    ];

                    notificationOne($req);
                }
                DB::commit();
                return redirect()->to('/barang-bukti-narkotika')->with(['success' => 'Data Berhasil Di buat']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        $dataPrapenuntutans = (new BarangBuktiNarkotikaRepository)->listDataPranut($this->query)->paginate($this->perPage);
        $this->page > $dataPrapenuntutans->lastPage() ? $this->page = $dataPrapenuntutans->lastPage() : true;
        $pagination = (new DataMasterRepository)->contentPaginate($dataPrapenuntutans);
        $list_jaksas = $this->jaksa;
        $this->emit('refreshJs');

        return view('livewire.kepolisian.barang-bukti-narkotika.barang-bukti-narkotika-modal-update', compact('dataPrapenuntutans', 'pagination', 'list_jaksas'));
    }
}
