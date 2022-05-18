<?php

namespace App\Http\Repositories\Admin;

use App\Jabatan;

class JabatanRepository
{
    public function listJabatan($query)
    {
        return Jabatan::orderBy('name', 'asc')->where('name', 'like', "%$query%");
    }

    public function getJabatanById($id)
    {
        return Jabatan::where('id', $id)->first();
    }
}
