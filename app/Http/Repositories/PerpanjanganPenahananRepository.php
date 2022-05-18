<?php

namespace App\Http\Repositories;

use App\Perkara;
use App\PerpanjanganPenahanan;
use App\Constant;
use App\DataPenahanan;
use App\PerpanjanganPenahananFile;
use App\PerpanjanganPenahananView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerpanjanganPenahananRepository
{
    public function listPerpanjanganPenahanan($query)
    {
        $data = PerpanjanganPenahananView::with(array('perpanjanganPenahanan' => function($query) {
            $query->with('rumahTahanan','tandaTangan','filePerpanjanganPenahanan');
        }))->where('user_id', Auth::user()->id)
        ->where('name_tersangka', 'like', "%$query%")
        ->orderBy('created_at', 'desc');
        return $data;
    }

    public function getPerpanjanganPenahananById($id)
    {
        return PerpanjanganPenahanan::with('filePerpanjanganPenahanan')->where('datapenahanan_id', $id)->first();
    }

    public function filePerpanjanganPenahanan($id)
    {
        return PerpanjanganPenahananFile::where('perpanjanganpenahanan_id', $id)->get();
    }

    public function createPerpanjanganPenahanan($request, $id_ecrypt)
    {
        return PerpanjanganPenahanan::create(
            [
                'kategori_id' => $request->kategori_id,
                'kategori_bagian_id' => $request->kategori_bagian_id,
                'perkara_id' => $request->perkara_id['perkara_id'],
                'datapenahanan_id' => $id_ecrypt,
                'nomor_t4' => $request->nomor_t4,
                'tanggal_t4' => $request->tanggal_t4,
                'nomor_permintaan_perpanjangan' => $request->nomor_permintaan,
                'tanggal_permintaan_perpanjangan' => $request->tanggal_permintaan_perpanjangan,
                'uraian_kejadian' => $request->uraian_kejadian,
                'lama_perpanjangan' => $request->lama_perpanjangan,
                'tanggal_perpanjangan_penahanan' => $request->tanggal_perpanjangan,
                'rumah_tahanan' => $request->rumah_tahanan,
                'tanda_tangan' => $request->tanda_tangan,
            ]
        );

    }

    public function createFilePerpanjanganPenahanan($request, $perpanjanganpenahanan_id)
    {
        if ($request->file) {
            $folder = 'perpanjangan_penahanan' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'perpanjangan_penahanan' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            return PerpanjanganPenahananFile::create([
                'perpanjanganpenahanan_id' => $perpanjanganpenahanan_id->id,
                'code_id' => Constant::BALASAN,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);
        }
    }

    public function generateRandomString($length = 10)
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
