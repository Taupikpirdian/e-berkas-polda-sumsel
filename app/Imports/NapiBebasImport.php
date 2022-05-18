<?php

namespace App\Imports;

use App\NapiBebas;
use Maatwebsite\Excel\Concerns\ToModel;

class NapiBebasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NapiBebas([
            'name' => $row[1]
        ]);
    }
}
