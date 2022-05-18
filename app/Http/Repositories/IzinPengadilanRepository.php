<?php

namespace App\Http\Repositories;

use App\Akses;
use App\Constant;
use App\IzinPengadilan;
use App\KategoriBagian;
use App\FileIzinPengadilan;
use App\PihakIzinPengadilan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IzinPengadilanRepository
{
    public function store($request, $user_id, $fitur)
    {
        $akses = Akses::where('user_id', $user_id)->first();
        $kategoriBagian = KategoriBagian::where('id', $akses->kategori_bagian_id)->first();
        $data = IzinPengadilan::create([
            'perkara_id' => $request->perkara_id,
            'user_id' => $user_id,
            'jns_penetapan_id' => $request->jns_penetapan_id,
            'penggeledahan_terhadap_id' => $request->penggeledahan_terhadap_id,
            'kategori_id' => $kategoriBagian->kategori_id,
            'kategori_bagian_id' => $akses->kategori_bagian_id,
            'pengadilan_id' => $request->pengadilan_id,
            'tgl_surat_permohonan' => date("Y-m-d", strtotime($request->tgl_surat_permohonan)),
            'no_surat_permohonan' => $request->no_surat_permohonan,
            'tgl_surat_perintah' => date("Y-m-d", strtotime($request->tgl_surat_perintah)),
            'no_surat_perintah' => $request->no_surat_perintah,
            'tgl_lapor' => date("Y-m-d", strtotime($request->tgl_lapor)),
            'no_lapor' => $request->no_lapor,
            'tgl_ba' => date("Y-m-d", strtotime($request->tgl_ba)),
            'no_ba' => $request->no_ba,
            'lokasi' => $request->lokasi,
            'jns_izin' => $fitur,
            'barang_sita' => $request->barang_sita,
            'status' => Constant::PENGAJUAN_IZIN_PENGADILAN,
            'created_by' => $user_id,
            'updated_by' => $user_id,
        ]);

        return $data;
    }

    public function storeFile($request, $izinPengadilan)
    {
        $arrayFile = array(
            array(
                "is_array" => is_array($request->file),
                "jns_file" => Constant::PENGAJUAN_IZIN_PENGADILAN,
                "file" => $request->file,
            ),
        );

        $folder = 'izin-pengadilan' . DIRECTORY_SEPARATOR . $izinPengadilan->id;
        foreach ($arrayFile as $file) {
            if ($file['is_array'] == false) {
                $rand = $this->generateRandomString();
                $ext = $file['file']->getClientOriginalExtension();
                $name = Constant::CODE_IZIN_SITA . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                // store to storage
                Storage::disk('public')->putFileAs($folder, $file['file'], $name);

                FileIzinPengadilan::create([
                    'izin_pengadilan_id' => $izinPengadilan->id,
                    'jns_file' => Constant::PENGAJUAN_IZIN_PENGADILAN,
                    'original_name' => $file['file']->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                ]);
            }
        }

        return true;
    }

    public function storePihak($request, $izinPengadilan)
    {
        PihakIzinPengadilan::create([
            'izin_pengadilan_id' => $izinPengadilan->id,
            'jns_pihak' => $request->jns_pihak,
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'kebangsaan' => $request->kebangsaan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
        ]);
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
}
