<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitipanTahanan extends Model
{

    protected $fillable = [
        'kategori_id',
        'kategori_bagian_id',
        'lapas_id',
        'rumahtahanan_id',
        'code',
        'catatan',
        'status',
        'created_by'
    ];

    public function tersangka()
	{
		return $this->hasOne('App\TersangkaTitipanTahanan', 'titipantahanan_id', 'id')->orderBy('created_at', 'asc');
	}

    public function fileTitipanTahananPengaju()
	{
		return $this->hasOne('App\FileTitipanPenahanan', 'titipanpenahanan_id', 'id')->where('code', Constant::PENGAJU);
	}

    public function fileTahananBalasanBalasan()
	{
		return $this->hasOne('App\FileTitipanPenahanan', 'titipanpenahanan_id', 'id')->where('code', Constant::BALASAN);
	}

    public function rumahtahanan()
    {
        return $this->belongsTo('App\RumahTahanan', 'rumahtahanan_id', 'id');
    }

    public function pengadilan()
    {
        return $this->belongsTo('App\KategoriBagian', 'lapas_id', 'id');
    }

}
