<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangBuktiNarkotika extends Model
{
    protected $fillable = [
        'kejaksaan_id',
        'perkara_id',
        'nosurat_permohonan',
		'status',
        'created_by',
        'updated_by',
    ];

    public function perkara()
	{
		return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
	}

    public function filePengaju()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::PENGAJU);
	}

    public function fileBalasan()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::BALASAN);
	}

    public function fileSpSita()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::SP_SITA);
	}

    public function fileBaCc()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::BA_CC);
	}

    public function fileBaSita()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::BA_SITA);
	}

    public function fileResume()
	{
		return $this->hasOne('App\BarangBuktiNarkotikaFile', 'barangbuktinarkotika_id', 'id')->where('code_id', Constant::RESUME);
	}
}
