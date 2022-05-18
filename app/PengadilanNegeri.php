<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengadilanNegeri extends Model
{
    protected $fillable = [
        'name', 'wilayah_hukum'
    ];
}
