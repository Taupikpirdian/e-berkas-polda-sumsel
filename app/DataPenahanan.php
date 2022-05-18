<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPenahanan extends Model
{
    protected $fillable = [
        'kategori_id',
        'kategori_bagian_id',
        'perkara_id',
        'jenis_penahanan',
        'type_tersangka',
        'typebagian_id',
        'status',
        'satuan_kerja',
        'tanggal_surat_pengajuan',
        'waktu_penahanan_habis',
        'jenis_tempat_penahanan',
        'tindak_pidana_tersangka',
        'nomor_surat_perintah_penahanan',
        'nomor_surat_kepanjangan',
        'no_surat_pengajuan',
        'catatan',
        'created_by'
    ];
    
    public function tersangka()
    {
        return $this->belongsTo('App\TersangkaPenahanan', 'id', 'datapenahanan_id');
    }

    public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

    public function fileDataPenahananPengaju()
	{
		return $this->hasOne('App\FilePenahanan', 'data_penahanan_id', 'id')->where('code', Constant::PENGAJU);
	}

    public function fileDataPenahananBalasan()
	{
		return $this->hasOne('App\FilePenahanan', 'data_penahanan_id', 'id')->where('code', Constant::BALASAN);
	}

    public function assignDataPenahanan()
    {
        return $this->belongsTo('App\AssignDataPenahanan', 'id', 'datapenahanan_id');
    }
}
