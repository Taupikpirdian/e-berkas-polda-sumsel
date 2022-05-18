<?php

namespace App\Http\Repositories;

use App\Constant;
use App\KategoriBagian;

class PolresRepository 
{
    public function listPolres()
    {
        $data = KategoriBagian::join('akses', 'kategori_bagians.id', '=', 'akses.kategori_bagian_id')
        ->where('kategori_id', Constant::N_KEPOLISIAN)
        ->get();

        return $data;
    }
}