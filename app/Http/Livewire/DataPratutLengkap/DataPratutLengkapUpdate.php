<?php

namespace App\Http\Livewire\DataPratutLengkap;

use App\Constant;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\PerkaraService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\SpdpRepository;
use App\Http\Repositories\KejaksaanRepository;

class DataPratutLengkapUpdate extends Component
{
    use WithFileUploads;

    public $uid, $perkara;

    public $file_ktp_kk,
        $file_bakap,
        $file_spkap,
        $file_bahan,
        $file_sphan,
        $file_pengantar;

    public function mount($id = null)
    {
        $this->user = thisUser();

        if ($id != null) {
            $this->uid = Crypt::decrypt($id);
            $this->perkara = (new PerkaraService)->perkaraById($this->uid);
            if ($this->perkara) {
                // (file)
                $this->file_ktp_kk = (new PerkaraService)->filePerkaraById($this->uid, Constant::KTP_KK);
                $this->file_bakap = (new PerkaraService)->filePerkaraById($this->uid, Constant::BAKAP);
                $this->file_spkap = (new PerkaraService)->filePerkaraById($this->uid, Constant::SPKAP);
                $this->file_bahan = (new PerkaraService)->filePerkaraById($this->uid, Constant::BAHAN);
                $this->file_sphan = (new PerkaraService)->filePerkaraById($this->uid, Constant::SPHAN);
                $this->file_pengantar = (new PerkaraService)->filePerkaraById($this->uid, Constant::PENGANTAR_TAHAP_II);
            }
        }
    }

    protected $listeners = [
        'store',
        'clearFormFile',
    ];

    public function clearFormFile($param)
    {
        if ($param == 'file_ktp_kk') {
            $this->file_ktp_kk = null;
        }
        if ($param == 'file_bakap') {
            $this->file_bakap = null;
        }
        if ($param == 'file_spkap') {
            $this->file_spkap = null;
        }
        if ($param == 'file_bahan') {
            $this->file_bahan = null;
        }
        if ($param == 'file_sphan') {
            $this->file_sphan = null;
        }
        if ($param == 'file_pengantar') {
            $this->file_pengantar = null;
        }
    }

    public function validateData()
    {
        /**
         * if file object, then validate mime and size data
         */
        if (is_object($this->file_ktp_kk)) {
            $this->validate(
                [
                    'file_ktp_kk' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_ktp_kk.mimes' => 'format yang digunakan: pdf',
                    'file_ktp_kk.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_bakap)) {
            $this->validate(
                [
                    'file_bakap' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_bakap.mimes' => 'format yang digunakan: pdf',
                    'file_bakap.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_spkap)) {
            $this->validate(
                [
                    'file_spkap' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_spkap.mimes' => 'format yang digunakan: pdf',
                    'file_spkap.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_bahan)) {
            $this->validate(
                [
                    'file_bahan' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_bahan.mimes' => 'format yang digunakan: pdf',
                    'file_bahan.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_sphan)) {
            $this->validate(
                [
                    'file_sphan' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_sphan.mimes' => 'format yang digunakan: pdf',
                    'file_sphan.max' => 'max ukuran file 2mb',
                ]
            );
        }
        if (is_object($this->file_pengantar)) {
            $this->validate(
                [
                    'file_pengantar' => 'mimes:pdf|max:2000',
                ],
                [
                    'file_pengantar.mimes' => 'format yang digunakan: pdf',
                    'file_pengantar.max' => 'max ukuran file 2mb',
                ]
            );
        }

        $this->validate(
            [
                'file_ktp_kk' => 'required',
                'file_bakap' => 'required',
                'file_spkap' => 'required',
                'file_bahan' => 'required',
                'file_sphan' => 'required',
                'file_pengantar' => 'required',
            ],
            [
                'file_ktp_kk.required' => 'Data ini tidak boleh kosong',
                'file_bakap.required' => 'Data ini tidak boleh kosong',
                'file_spkap.required' => 'Data ini tidak boleh kosong',
                'file_bahan.required' => 'Data ini tidak boleh kosong',
                'file_sphan.required' => 'Data ini tidak boleh kosong',
                'file_pengantar.required' => 'Data ini tidak boleh kosong',
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
            $request->id = $this->uid;
            $request->file_ktp_kk = $this->file_ktp_kk;
            $request->file_bakap = $this->file_bakap;
            $request->file_spkap = $this->file_spkap;
            $request->file_bahan = $this->file_bahan;
            $request->file_sphan = $this->file_sphan;
            $request->file_pengantar = $this->file_pengantar;

            $dataPranut = (new SpdpRepository)->getPerkaraById($request->id);

            if ($dataPranut) {
                /**
                 * store data files
                 */
                (new SpdpRepository)->storeFileTahapII($request, $dataPranut);
                /**
                 * notif for kejaksaan
                 */
                $text = 'Telah upload Tahap II untuk no lp ' . $dataPranut->no_lp;
                $arrayJaksaAssignee = (new KejaksaanRepository)->jaksaAssingPerkaraByPerkaraId($dataPranut->id);
                foreach ($arrayJaksaAssignee as $assignJaksa) {
                    if ($assignJaksa->masterJaksa) {
                        $req = [
                            'user_id' => $this->user->id,
                            'notif_for' => $assignJaksa->masterJaksa->user_id,
                            'desc' => $text,
                            'data_id' => $dataPranut->id,
                            'notif_fitur' => 'Upload Tahap II',
                            'notif_type' => Constant::NOTIF_PRANUT
                        ];
                        notificationOne($req);
                    }
                }
            }

            $dataPranut->status = Constant::LENGKAP;
            $dataPranut->updated_by = $this->user->id;
            $dataPranut->updated_at = date('Y-m-d H:i:s');
            $dataPranut->save();

            DB::commit();
            return redirect()->to('/data-prapenuntutan-lengkap')->with(['success' => 'Berhasil upload file Tahap II']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.data-pratut-lengkap.data-pratut-lengkap-update');
    }
}
