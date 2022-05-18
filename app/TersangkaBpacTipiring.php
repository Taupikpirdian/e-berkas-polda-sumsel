<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TersangkaBpacTipiring extends Model
{
    protected $fillable = [
        'name',
        'tempat_lahir',
        'tgl_lahir',
        'jk',
        'kebangsaan',
        'alamat',
        'agama',
        'pekerjaan',
        'pendidikan',
        'pasal',
        'created_by',
        'updated_by',
        'id_bpac_tipiring',
        'nik'
    ];

    public function bpacTipiring()
	{
		return $this->belongsTo('App\BpacTipiring', 'id_bpac_tipiring', 'id');
	}

    public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

    public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by', 'id');
	}
}
