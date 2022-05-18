<?php

namespace App\Http\Repositories;

use App\Akses;
use App\Penyidik;
use App\PenyidikPerkara;

class PenyidikRepository 
{
    public function penyidikByUserId($userId)
    {
        return Penyidik::with(['pangkat'])->where('user_id', $userId)->first();
    }

    public function aksesByUserId($userId)
    {
        return Akses::where('user_id', $userId)->exists();
    }

    public function perkaraByPenyidikId($penyidikId)
    {
        return PenyidikPerkara::where('penyidik_id', $penyidikId)->pluck('perkara_id')->toArray();
    }
}