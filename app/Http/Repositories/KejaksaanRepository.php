<?php

namespace App\Http\Repositories;

use App\AksesUserView;
use App\AssignPerkara;
use App\AssignPerkaraToOperator;
use App\Constant;
use App\JaksaPenuntutUmum;
use App\KategoriBagian;
use App\WilayahHukum;

class KejaksaanRepository
{
    public function userJaksaByJaksaId($jaksa_penuntut_umum_id)
    {
        return JaksaPenuntutUmum::where('id', $jaksa_penuntut_umum_id)->first();
    }

    public function jaksaAssingPerkaraByPerkaraId($perkara_id)
    {
        $data = AssignPerkara::with([
            'masterJaksa'
        ])->whereHas('masterJaksa', function ($q) {
            $q->where('user_id', '!=', NULL);
        })->where('perkara_id', $perkara_id)->get();

        return $data;
    }

    public function jaksaAssingPerkaraByJaksaId($jaksaId)
    {
        $data = AssignPerkara::where('jaksa_penuntut_umum_id', $jaksaId)->pluck('perkara_id')->toArray();
        return $data;
    }

    public function operatorAssingPerkaraByJaksaId($userId)
    {
        $data = AssignPerkaraToOperator::where('user_id', $userId)->pluck('perkara_id')->toArray();
        return $data;
    }

    public function userJaksaByUserId($userId)
    {
        return JaksaPenuntutUmum::where('user_id', $userId)->first();
    }

    public function listJaksa()
    {
        $data = AksesUserView::where('kategori_id', Constant::N_KEJAKSAAN)->get();
        return $data;
    }

    public function listJaksaByWilayah()
    {
        $akses_kode = thisKategoriBagian()->kode;
        $kode_relasi = WilayahHukum::where('kode_induk', $akses_kode)->first();
        $kategori_bagian = KategoriBagian::where('kode', $kode_relasi->kode_relasi)->get();

        return $kategori_bagian;
    }
}
