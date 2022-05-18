<?php

namespace App\Http\Repositories;

use App\TersangkaPerkara;

class TersangkaRepository
{
    public function getTersangkaById($id)
    {
        return TersangkaPerkara::where('id', $id);
    }

    public function listTersangkaByPerkaraId($perkara_id)
    {
        return TersangkaPerkara::where('perkara_id', $perkara_id)->where('is_proses', 1)->get();
    }

    public function listSplitTersangka($perkara_id)
    {
        $data = TersangkaPerkara::where('perkara_id', $perkara_id);

        return $data;
    }
}
