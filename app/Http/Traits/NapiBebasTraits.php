<?php 

namespace App\Http\Traits;

use App\NapiBebas;

trait NapiBebasTraits {
    public function listNapiBebas($query = null)
    {
        $data = NapiBebas::orderBy('name', 'asc');

        if ($query) {
            $data->where('name','like',"%$query%");
        }
        
        return $data;
    }
}