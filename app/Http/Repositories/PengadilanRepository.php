<?php

namespace App\Http\Repositories;

use App\Akses;
use App\AksesUserView;
use App\Constant;
use App\KategoriBagian;

class PengadilanRepository 
{
    public function listPengadilan()
    {
        $data = AksesUserView::orderBy('created_at', 'desc')->where('kategori_id', Constant::N_PENGADILAN)->get();

        return $data;
    }
}