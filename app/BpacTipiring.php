<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BpacTipiring extends Model
{
    protected $fillable = [
        'tanggal_pelimpahan',
        'tanggal_register',
        'kategori_id',
        'kategori_bagian_id',
        'penyidik_id',
        'pengadilan_id',
        'status',
        'created_by',
        'updated_by',
    ];

    public function penyidik()
	{
		return $this->belongsTo('App\Penyidik', 'penyidik_id', 'id');
	}

    public function tersangka()
    {
        return $this->hasMany(TersangkaBpacTipiring::class, 'id_bpac_tipiring', 'id');
    }

    public function fileBpacTipiring()
    {
        return $this->hasOne(FileBpacTipiring::class, 'bpac_tipiring_id', 'id')->orderBy('created_at', 'desc');
    }

    public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

    public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by', 'id');
	}
    
    public function kategoriBagian()
    {
        return $this->belongsTo('App\KategoriBagian', 'kategori_bagian_id', 'id');
    }

    public function filePengajuan()
    {
        return $this->hasOne('App\FileBpacTipiring', 'bpac_tipiring_id', 'id')->where('code', Constant::PENGAJUAN_BACP_TIPIRING)->orderBy('created_at', 'desc');
    }

    public function fileBalasan()
    {
        return $this->hasOne('App\FileBpacTipiring', 'bpac_tipiring_id', 'id')->where('code', Constant::BALASAN_BACP_TIPIRING)->orderBy('created_at', 'desc');
    }

    public function pengadilan()
    {
        return $this->belongsTo('App\User', 'pengadilan_id', 'id');
    }
}
