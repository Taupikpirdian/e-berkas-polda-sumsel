<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignPerkaraToAdmin extends Model
{
    protected $fillable = [
        'kategori_bagian_id',
        'perkara_id'
    ];
}
