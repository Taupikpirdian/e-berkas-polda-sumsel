<?php

namespace App\Http\Repositories\Admin;

use App\Akses;

class AksesRepository
{
    public function listPangkat()
    {
        return Akses::select([
            'akses.id',
            'users.name',
            'kategori_bagians.name as satker',
        ])->join('users', 'akses.user_id', '=', 'users.id')
          ->join('kategori_bagians', 'akses.kategori_bagian_id', '=', 'kategori_bagians.id')
          ->orderBy('satker', 'asc');
    }

    public function getAksesById($id)
    {
        return Akses::where('id', $id)->first();
    }
}
