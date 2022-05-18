<?php

namespace App\Imports;

use App\RumahTahanan;
use Maatwebsite\Excel\Concerns\ToModel;

class RumahTahananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RumahTahanan([
            'name' => $row[1]
        ]);
    }
}
