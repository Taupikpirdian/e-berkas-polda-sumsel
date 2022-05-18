<?php

namespace App\Http\Repositories;

use App\Akses;
use App\AssignPerkaraToAdmin;
use App\Perkara;
use App\Constant;
use App\FilePerkara;
use App\KategoriBagian;
use App\PenyidikPerkara;
use App\TersangkaPerkara;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\DataMasterRepository;

class SpdpRepository
{
    public function storePerkara($request, $user_id)
    {
        $akses = Akses::where('user_id', $user_id)->first();
        $kategoriBagian = KategoriBagian::where('id', $akses->kategori_bagian_id)->first();
        // cek data
        $data = Perkara::where('id', $request->id)->first();
        if ($data) {
            $data->user_id = $user_id;
            $data->no_lp = $request->no_lp;
            $data->jns_pidana_id = $request->jns_pidana_id;
            $data->kronologi = $request->kronologi;
            $data->date_no_lp = date("Y-m-d", strtotime($request->date_no_lp));
            $data->kategori_id = $kategoriBagian->kategori_id;
            $data->kategori_bagian_id = $akses->kategori_bagian_id;
            $data->updated_by = $user_id;
            $data->updated_at = date("Y-m-d H:i:s");
            $data->save();
        } else {
            $data = Perkara::create([
                'user_id' => $user_id,
                'no_lp' => $request->no_lp,
                'jns_pidana_id' => $request->jns_pidana_id,
                'kronologi' => $request->kronologi,
                'date_no_lp' => date("Y-m-d", strtotime($request->date_no_lp)),
                'kategori_id' => $kategoriBagian->kategori_id,
                'kategori_bagian_id' => $akses->kategori_bagian_id,
                'status' => Constant::OPEN,
                'created_by' => $user_id,
                'updated_by' => $user_id,
            ]);
        }

        return $data;
    }

    public function storeFile($request, $dataPranut)
    {
        $arrayFile = array(
            array(
                "is_array" => is_array($request->file_spdp),
                "code" => Constant::SPDP,
                "file" => $request->file_spdp,
                "no_berkas" => $request->no_berkas_spdp
            ),
            array(
                "is_array" => is_array($request->sprint_sidik),
                "code" => Constant::SPRINT_SIDIK,
                "file" => $request->sprint_sidik,
                "no_berkas" => $request->no_berkas_sidik
            ),
            array(
                "is_array" => is_array($request->file_lp),
                "code" => Constant::FILE_LP,
                "file" => $request->file_lp,
                "no_berkas" => $request->no_lp
            ),
            array(
                "is_array" => is_array($request->file_lainnya),
                "code" => Constant::FILE_LAINNYA,
                "file" => $request->file_lainnya,
                "no_berkas" => $request->no_file_lainnya
            ),
        );

        $folder = 'files' . DIRECTORY_SEPARATOR . $dataPranut->id;
        foreach ($arrayFile as $file) {
            if ($file['file']) {
                // update no berkas
                $checkFile = FilePerkara::where('code_id', $file['code'])->where('perkara_id', $dataPranut->id)->latest()->first();
                if ($checkFile) {
                    $checkFile->no_berkas = $file['no_berkas'];
                    $checkFile->save();
                }

                if ($file['is_array'] == false) {
                    $rand = $this->generateRandomString();
                    $ext = $file['file']->getClientOriginalExtension();
                    $name = $file['code'] . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                    // store to storage
                    Storage::disk('public')->putFileAs($folder, $file['file'], $name);

                    FilePerkara::create([
                        'no_berkas' => $file['no_berkas'],
                        'tgl_berkas' => date("Y-m-d"), // apa perlu input tanggalnya?
                        'code_id' => $file['code'],
                        'perkara_id' => $dataPranut->id,
                        'original_name' => $file['file']->getClientOriginalName(),
                        'name' => $name,
                        'type_file' => $ext,
                        'path' => $folder . DIRECTORY_SEPARATOR . $name,
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }
        }

        return true;
    }

    public function storeTersangka($array_pelaku, $array_pelaku_deleted, $dataPranut)
    {
        $getTersangkaById = $this->getTersangkaById($array_pelaku_deleted);
        /**
         * delete data tersangka on db
         */
        foreach ($getTersangkaById as $gt) {
            $gt->delete();
        }

        foreach ($array_pelaku as $data) {
            TersangkaPerkara::updateOrCreate(
                [
                    'id' => $data['id'],
                ],
                [
                    'perkara_id' => $dataPranut->id,
                    'nik' => $data['nik'],
                    'name' => $data['nama_tersangka'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tgl_lahir' => date("Y-m-d", strtotime($data['tanggal_lahir'])),
                    'jk' => $data['jenis_kelamin'],
                    'kebangsaan' => $data['kebangsaan'],
                    'alamat' => $data['alamat'],
                    'agama' => $data['agama'],
                    'pekerjaan' => $data['pekerjaan'],
                    'pendidikan' => $data['pendidikan'],
                    'pasal' => $data['pasal'],
                ]
            );
        }
    }

    public function storePenyidikPerkara($user_id, $dataPranut)
    {
        $dataPenyidikById = (new DataMasterRepository)->dataPenyidikById($user_id);
        if ($dataPenyidikById) {
            PenyidikPerkara::updateOrCreate(
                [
                    'penyidik_id' => $dataPenyidikById->id,
                    'perkara_id' => $dataPranut->id,
                ],
                [
                    'no_urut' => '1',
                ]
            );
        }
    }

    public function storeAdminKejaksaanPerkara($kategoriBagianId, $dataPranut)
    {
        AssignPerkaraToAdmin::create(
            [
                'kategori_bagian_id' => $kategoriBagianId,
                'perkara_id' => $dataPranut->id,
            ]
        );
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getTersangkaById($array_id)
    {
        return TersangkaPerkara::whereIn('id', $array_id)->get();
    }

    public function getPerkaraById($id)
    {
        return Perkara::where('id', $id)->first();
    }

    public function storeFileTahapII($request, $dataPranut)
    {
        $arrayFile = array(
            array(
                "is_array" => is_array($request->file_ktp_kk),
                "code" => Constant::KTP_KK,
                "file" => $request->file_ktp_kk
            ),
            array(
                "is_array" => is_array($request->file_bakap),
                "code" => Constant::BAKAP,
                "file" => $request->file_bakap
            ),
            array(
                "is_array" => is_array($request->file_spkap),
                "code" => Constant::SPKAP,
                "file" => $request->file_spkap
            ),
            array(
                "is_array" => is_array($request->file_bahan),
                "code" => Constant::BAHAN,
                "file" => $request->file_bahan
            ),
            array(
                "is_array" => is_array($request->file_sphan),
                "code" => Constant::SPHAN,
                "file" => $request->file_sphan
            ),
            array(
                "is_array" => is_array($request->file_pengantar),
                "code" => Constant::PENGANTAR_TAHAP_II,
                "file" => $request->file_pengantar
            ),
        );

        $folder = 'files' . DIRECTORY_SEPARATOR . $dataPranut->id;
        foreach ($arrayFile as $file) {
            if ($file['file']) {
                if ($file['is_array'] == false) {
                    $rand = $this->generateRandomString();
                    $ext = $file['file']->getClientOriginalExtension();
                    $name = $file['code'] . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                    // store to storage
                    Storage::disk('public')->putFileAs($folder, $file['file'], $name);

                    FilePerkara::create([
                        'no_berkas' => '',
                        'tgl_berkas' => date("Y-m-d"),
                        'code_id' => $file['code'],
                        'perkara_id' => $dataPranut->id,
                        'original_name' => $file['file']->getClientOriginalName(),
                        'name' => $name,
                        'type_file' => $ext,
                        'path' => $folder . DIRECTORY_SEPARATOR . $name,
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }
        }

        return true;
    }

    public function updateSpliteTersangka($id, $tersangka_id)
    {
        // update splite data 
        $perkara = Perkara::find($id);
        if ($perkara) {
            $perkara->is_split = 1;
            $perkara->save();
        }

        if ($tersangka_id) {
            foreach ($tersangka_id as $key => $data) {
                TersangkaPerkara::where('id', $key)->update(array('is_proses' => (int) $data));
            }
        }
    }

    public function updateTahapSatu($id)
    {
        $data = Perkara::find($id);

        if ($data) {
            $data->status = Constant::TAHAP_I;
            $data->save();
        }
    }

    public function splitFileTersangka($request, $perkara_id)
    {
        if ($request->file) {
            $folder = 'files' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'files' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            return FilePerkara::create([
                'perkara_id' => $perkara_id,
                'code_id' => Constant::RESUME_BERKAS_PERKARA,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);
        }
    }

    public function splitFileTersangkaArray($request, $perkara_id)
    {
        if ($request->file_spdp || $request->sprint_sidik || $request->file_lp || $request->file_berkas_perkara) {
            $arrayFile = array(
                array(
                    "is_array" => is_array($request->file_spdp),
                    "code" => Constant::SPDP,
                    "file" => $request->file_spdp,
                ),
                array(
                    "is_array" => is_array($request->sprint_sidik),
                    "code" => Constant::SPRINT_SIDIK,
                    "file" => $request->sprint_sidik,
                ),
                array(
                    "is_array" => is_array($request->file_lp),
                    "code" => Constant::FILE_LP,
                    "file" => $request->file_lp,
                ),
                array(
                    "is_array" => is_array($request->file_berkas_perkara),
                    "code" => Constant::RESUME_BERKAS_PERKARA,
                    "file" => $request->file_berkas_perkara,
                ),
            );
            $folder = 'files' . DIRECTORY_SEPARATOR . $perkara_id;
            foreach ($arrayFile as $file) {
                if ($file['file']) {
                    foreach ($file['file'] as $key => $data) {
                        $rand = $this->generateRandomString();
                        $ext = $data->getClientOriginalExtension();
                        $name = $file['code'] . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                        // store to storage
                        Storage::disk('public')->putFileAs($folder, $data, $name);
                        FilePerkara::create([
                            'tgl_berkas' => date("Y-m-d"),
                            'code_id' => $file['code'],
                            'perkara_id' => $perkara_id,
                            'tersangka_perkara_id' => $key,
                            'original_name' => $data->getClientOriginalName(),
                            'name' => $name,
                            'type_file' => $ext,
                            'path' => $folder . DIRECTORY_SEPARATOR . $name,
                            'created_by' => Auth::user()->id,
                        ]);
                    }
                }
            }
        }

        return true;
    }

    public function filePerkaraById($perkaraid)
    {
        $data = FilePerkara::where('perkara_id', $perkaraid)->get();
        return $data;
    }


    public function notifToWa()
    {
        /**
         * store data notifikasi
         */
        // $text = 'Penerimaan SPDP dengan no lp '.$request->no_lp;
        // $req = [
        //     'user_id'       => $this->user->id,
        //     'desc'          => $text,
        //     'perkara_id'    => $laporanPerkara->id,
        // ];
        // notificationMany($req, 'admin-kejaksaan');

        /**
         * send whatsapp
         * nunggu berlangganan dahulu
         */
        // $to = "62" . ltrim($request->no_hp, "0");
        // $status = 'OPEN';
        // $kategori_bagian = KategoriBagian::with('kategori')->where('id', $akses->kategori_bagian_id)->first();
        // $nama_kategori_bagian = $kategori_bagian->name;
        // $nama_kategori = $kategori_bagian->kategori->name;
        // $description = "Hello, ".$request->penyidik." (".$request->nrp.")\n\nTerdapat data perkara baru dengan no lp : ". $request->no_lp . ", tanggal lp : ".date("d M Y", strtotime($request->date_no_lp)).".\nKronologi :\n".$request->kronologi .".\n\n".$status."\n\n".$nama_kategori." - ".$nama_kategori_bagian;
        // BroadcastWhatsappServices::sendWa($to, $description);
    }
}
