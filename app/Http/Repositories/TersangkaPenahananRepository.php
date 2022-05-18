<?php

namespace App\Http\Repositories;

use App\TersangkaPenahanan;

class TersangkaPenahananRepository
{
    public function getListDataPenahananId($id)
    {
        return TersangkaPenahanan::where('datapenahanan_id', $id)->get();
    }
}
