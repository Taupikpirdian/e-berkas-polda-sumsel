<?php

namespace App\Http\Repositories\Admin;

use App\Pangkat;
use App\Pejabat;
use App\Jabatan;

class PejabatRepository
{
    public function listPejabat($query)
    {
        return Pejabat::with('pangkat', 'jabatan')->orderBy('name', 'asc')->where('nip', 'like', "%$query%")->orwhere('name', 'like', "%$query%");
    }

    public function getPejabatById($id)
    {
        return Pejabat::where('id', $id)->first();
    }

    public function masterPangkat()
    {
        return Pangkat::select('name', 'id')->get();
    }

    public function masterPangkatKepolisian()
    {
        return Pangkat::select('name', 'id')->where('role', 'kepolisian')->get();
    }

    public function masterPangkatKejaksaan()
    {
        return Pangkat::select('name', 'id')->where('role', 'kejaksaan')->get();
    }

    public function masterJabatan()
    {
        return Jabatan::select('name', 'id')->get();
    }
}
