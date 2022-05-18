<?php

namespace App\Http\Repositories\Admin;

use App\Akses;
use App\KategoriBagian;

class KategoriBagianRepository
{
    public function listKategoriBagian($arrKategori, $query)
    {
        return KategoriBagian::orderBy('name', 'asc')->whereIn('kategori_id', $arrKategori)->where('name', 'like', "%$query%");
    }

    public function getKategoriBagianById($id)
    {
        return KategoriBagian::where('id', $id)->first();
    }

    public function getAksesKategoriBagian($kategoriBagianId)
    {
        return Akses::where('kategori_bagian_id', $kategoriBagianId)->get();
    }
}
