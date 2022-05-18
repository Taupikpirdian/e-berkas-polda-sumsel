<?php

namespace App\Http\Repositories\Admin;

use App\Akses;
use App\JaksaPenuntutUmum;
use App\Pangkat;

class JaksaPenuntutUmumRepository
{
    public function listJaksaPenuntutUmum()
    {
        return JaksaPenuntutUmum::orderBy('name', 'asc');
    }

    public function getJaksaPenuntutUmumById($id)
    {
        return JaksaPenuntutUmum::where('id', $id)->first();
    }

    public function masterPangkat()
    {
        return Pangkat::select('name', 'id')->get();
    }

    // public function getAksesJaksaPenuntutUmum($jaksaPenuntutUmumId)
    // {
    //     return Akses::where('kategori_bagian_id', $jaksaPenuntutUmumId)->get();
    // }

    public function getJaksaPenuntutUmumByUserId($userId)
    {
        return JaksaPenuntutUmum::where('user_id', $userId)->first();
    }
}
