<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $fillable = [
        'name',
        'role'
    ];

    public function jaksa()
    {
        return $this->hasMany(JaksaPenuntutUmum::class, 'id', 'pangkat_id');
    }
}
