<?php

namespace App\Http\Livewire\Kepolisian\DataPranut;

use App\Constant;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\SpdpRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\DataMasterRepository;

class Store extends Component
{
    use WithFileUploads;

    public $is_edit = false;
    public $uid, $perkara;
    public $listJnsPidana, $dataPenyidik, $user, $dataSatuanKerja;
    public $no_lp, $date_no_lp, $jns_pidana_id, $kronologi, $satuan_kerja, $penyidik, $nrp, $no_hp;
    public $nik, $nama_tersangka, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $kebangsaan, $alamat, $agama, $pekerjaan, $pendidikan, $pasal;
    public $array_pelaku = [];
    public $array_pelaku_deleted = [];

    public $no_berkas_spdp, $file_spdp,
        $no_berkas_sidik, $sprint_sidik,
        $no_file_lp, $file_lp,
        $no_file_lainnya, $file_lainnya;

    public $kategoriBagianRelasiId;

    public function mount($id = null)
    {
        $this->user = thisUser();
        $this->listJnsPidana = (new DataMasterRepository)->masterJenisPidana();
        $this->dataPenyidik = (new UserRepository)->dataPenyidik($this->user->id);
        $this->dataSatuanKerja = (new UserRepository)->dataSatuanKerja($this->user->id);

        $this->penyidik = $this->dataPenyidik ? $this->dataPenyidik->name : 'Kosong';
        $this->nrp = $this->dataPenyidik ? $this->dataPenyidik->nrp : 'Kosong';
        $this->no_hp = thisUser()->phone != NULL ? thisUser()->phone : 'Kosong';

        if ($this->dataSatuanKerja) {
            $this->satuan_kerja = $this->dataSatuanKerja->satker ? $this->dataSatuanKerja->satker->name : '';
        }

        $this->kategoriBagianRelasiId = wilayahHukumRelasi();

        if ($id != null) {
            $this->is_edit = true;
            $this->uid = Crypt::decrypt($id);
            $this->perkara = (new PerkaraService)->perkaraById($this->uid);
            if ($this->perkara) {
                // form 1
                $this->no_lp = $this->perkara->no_lp;
                $this->date_no_lp = date("d-m-Y", strtotime($this->perkara->date_no_lp));
                $this->jns_pidana_id = $this->perkara->jns_pidana_id;
                $this->kronologi = $this->perkara->kronologi;

                // form 2 (tersangka)
                $dataTersangkas = (new PerkaraService)->dataTersangka($this->uid);
                foreach ($dataTersangkas as $dt) {
                    array_push($this->array_pelaku, [
                        'id' => $dt->id,
                        'nik' => $dt->nik,
                        'nama_tersangka' => $dt->name,
                        'tempat_lahir' => $dt->tempat_lahir,
                        'tanggal_lahir' => $dt->tgl_lahir,
                        'jenis_kelamin' => $dt->jk,
                        'kebangsaan' => $dt->kebangsaan,
                        'alamat' => $dt->alamat,
                        'agama' => $dt->agama,
                        'pekerjaan' => $dt->pekerjaan,
                        'pendidikan' => $dt->pendidikan,
                        'pasal' => $dt->pasal,
                    ]);
                }

                // form 3 (file)
                $this->no_berkas_spdp = (new PerkaraService)->noBerkasById($this->uid, Constant::SPDP);
                $this->file_spdp = (new PerkaraService)->filePerkaraById($this->uid, Constant::SPDP);
                $this->no_berkas_sidik = (new PerkaraService)->noBerkasById($this->uid, Constant::SPRINT_SIDIK);
                $this->sprint_sidik = (new PerkaraService)->filePerkaraById($this->uid, Constant::SPRINT_SIDIK);
                $this->no_file_lp = (new PerkaraService)->noBerkasById($this->uid, Constant::FILE_LP);
                $this->file_lp = (new PerkaraService)->filePerkaraById($this->uid, Constant::FILE_LP);
                $this->no_file_lainnya = (new PerkaraService)->noBerkasById($this->uid, Constant::FILE_LAINNYA);
                $this->file_lainnya = (new PerkaraService)->filePerkaraById($this->uid, Constant::FILE_LAINNYA);
            }
        }
    }

    protected $listeners = [
        'store',
        'clearFormFile',
    ];

    public function addPelaku()
    {
        array_push($this->array_pelaku, [
            'id' => null,
            'nik' => $this->nik,
            'nama_tersangka' => $this->nama_tersangka,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kebangsaan' => $this->kebangsaan,
            'alamat' => $this->alamat,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'pendidikan' => $this->pendidikan,
            'pasal' => $this->pasal,
        ]);

        $this->nik = '';
        $this->nama_tersangka = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->jenis_kelamin = '';
        $this->kebangsaan = '';
        $this->alamat = '';
        $this->agama = '';
        $this->pekerjaan = '';
        $this->pendidikan = '';
        $this->pasal = '';

        $modal = '#scrollingmodal';
        $this->emit('closeModal', $modal);
    }

    public function removePelaku($key)
    {
        $deleteDataCollect = $this->array_pelaku[$key];
        if (isset($deleteDataCollect)) {
            if ($deleteDataCollect['id'] != null) {
                $this->array_pelaku_deleted[] = $deleteDataCollect['id'];
            }
        }
        unset($this->array_pelaku[$key]);
        $this->array_pelaku = array_values($this->array_pelaku);
        $deleteDataCollect = '';
    }

    public function clearFormFile($param)
    {
        if ($param == 'file_spdp') {
            $this->file_spdp = null;
        }
        if ($param == 'sprint_sidik') {
            $this->sprint_sidik = null;
        }
        if ($param == 'file_lp') {
            $this->file_lp = null;
        }
        if ($param == 'file_lainnya') {
            $this->file_lainnya = null;
        }
    }

    public function validateData()
    {
        /**
         * if file object, then validate mime and size data
         */
        if (is_object($this->file_spdp)) {
            $this->validate(
                [
                    'file_spdp' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_spdp.mimes' => 'format yang digunakan: pdf',
                    'file_spdp.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->sprint_sidik)) {
            $this->validate(
                [
                    'sprint_sidik' => 'mimes:pdf|max:2000',
                ],
                [
                    'sprint_sidik.mimes' => 'format yang digunakan: pdf',
                    'sprint_sidik.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_lp)) {
            $this->validate(
                [
                    'file_lp' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_lp.mimes' => 'format yang digunakan: pdf',
                    'file_lp.max' => 'max ukuran file 2mb',
                ]
            );
        }

        $this->validate(
            [
                'no_lp' => 'required|unique:perkaras,no_lp,' . $this->uid,
                'date_no_lp' => 'required',
                'jns_pidana_id' => 'required',
                'kronologi' => 'required',
                'no_berkas_spdp' => 'required',
                'file_spdp' => 'required',
                'no_berkas_sidik' => 'required',
                'sprint_sidik' => 'required',
                'file_lp' => 'required',
            ],
            [
                'no_lp.required' => 'Data ini tidak boleh kosong',
                'no_lp.unique' => 'No LP sudah digunakan',
                'date_no_lp.required' => 'Data ini tidak boleh kosong',
                'jns_pidana_id.required' => 'Data ini tidak boleh kosong',
                'kronologi.required' => 'Data ini tidak boleh kosong',
                'no_berkas_spdp.required' => 'Data ini tidak boleh kosong',
                'file_spdp.required' => 'Data ini tidak boleh kosong',
                'no_berkas_sidik.required' => 'Data ini tidak boleh kosong',
                'sprint_sidik.required' => 'Data ini tidak boleh kosong',
                'file_lp.required' => 'Data ini tidak boleh kosong',
            ]
        );

        // check pin after validate data
        $modal = '#exampleModal';
        $this->emit('showModal', $modal);

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
            $request->id = $this->uid;
            $request->no_lp = $this->no_lp;
            $request->date_no_lp = $this->date_no_lp;
            $request->jns_pidana_id = $this->jns_pidana_id;
            $request->kronologi = $this->kronologi;
            $request->no_berkas_spdp = $this->no_berkas_spdp;
            $request->file_spdp = $this->file_spdp;
            $request->no_berkas_sidik = $this->no_berkas_sidik;
            $request->sprint_sidik = $this->sprint_sidik;
            $request->file_lp = $this->file_lp;
            $request->no_file_lainnya = $this->no_file_lainnya;
            $request->file_lainnya = $this->file_lainnya;

            $dataPranut = (new SpdpRepository)->storePerkara($request, $this->user->id);

            if ($dataPranut) {
                /**
                 * store data files
                 */
                (new SpdpRepository)->storeFile($request, $dataPranut);
                /**
                 * store data tersangka
                 */
                (new SpdpRepository)->storeTersangka($this->array_pelaku, $this->array_pelaku_deleted, $dataPranut);
                /**
                 * assign penyidik
                 */
                (new SpdpRepository)->storePenyidikPerkara($this->user->id, $dataPranut);
                /**
                 * assign admin kejaksaan
                 */
                (new SpdpRepository)->storeAdminKejaksaanPerkara($this->kategoriBagianRelasiId, $dataPranut);

                // notif for admin-kejaksaan
                $text = 'Telah upload SPDP untuk no lp ' . $dataPranut->no_lp;
                $req = [
                    'user_id' => $this->user->id,
                    'desc' => $text,
                    'data_id' => $dataPranut->id,
                    'notif_type' => Constant::NOTIF_PRANUT
                ];
                notificationMany($req, 'admin-kejaksaan', 'Upload SPDP');
            }

            DB::commit();
            return redirect()->to('/data-prapenuntutan')->with(['success' => 'Berhasil mengajukan SPDP']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.kepolisian.data-pranut.store');
    }
}
