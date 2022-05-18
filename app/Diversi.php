<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diversi extends Model
{
    protected $fillable = [
        'kategori_id',
        'kategori_bagian_id',
        'nomor_register',
        'pengaju',
        'status',
        'created_by',
        'updated_by',
        'catatan',
        'pengadilan_id',
    ];

    public function pengaju()
	{
		return $this->belongsTo('App\User', 'pengaju', 'id');
	}

    public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

    public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by', 'id');
	}

    public function fileDiversiPengaju()
	{
		return $this->hasOne('App\FileDiversi', 'diversi_id', 'id')->where('code', Constant::PENGAJU);
	}

    public function tersangka()
    {
        return $this->belongsTo('App\TersangkaDiversi', 'id', 'diversi_id');
    }

    public function fileDiversiBalasan()
	{
		return $this->hasOne('App\FileDiversi', 'diversi_id', 'id')->where('code', Constant::BALASAN);
	}
    
    public function kategoriBagian()
    {
        return $this->belongsTo('App\KategoriBagian', 'kategori_bagian_id', 'id');
    }
}
