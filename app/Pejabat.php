<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = [
        'nip', 'name', 'pangkat_id', 'jabatan_id'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id');
    }
}
