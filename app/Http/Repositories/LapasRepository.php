<?php

namespace App\Http\Repositories;

use App\Tahanan;
use App\Constant;
use App\KategoriBagian;

class LapasRepository
{
    public function listLapas()
    {
        $data = KategoriBagian::where('kategori_id', Constant::N_KEMENKUMHAM)->get();
        return $data;
    }

    public function getTahananByLapasId($lapasId, $query)
    {
        $datas = Tahanan::where('kategori_bagian_id', $lapasId)
            ->where(function ($q) use ($query) {
                $q->where('no_reg_instansi', 'like', "%$query%")->orWhere('name', 'like', "%$query%");
            })->orderBy('name', 'asc');

        return $datas;
    }

    public function tahananById($id)
    {
        $data = Tahanan::where('id', $id);
        return $data;
    }
}
