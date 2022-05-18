<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perkara extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'no_lp',
        'jns_pidana_id',
        'date_no_lp',
        'kategori_id',
        'kategori_bagian_id',
        'status',
        'kronologi',
        'penyidik',
        'nrp',
        'no_hp',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }

    public function jenisPidana()
    {
        return $this->belongsTo('App\JenisPidana', 'jns_pidana_id', 'id');
    }

    public function countFilePerkara()
    {
        return $this->hasMany(FilePerkara::class, 'perkara_id', 'id');
    }

    public function filePerkara()
    {
        return $this->hasMany(FilePerkara::class, 'perkara_id', 'id');
    }

    public function statusBerkas()
    {
        return $this->belongsTo('App\Status', 'status', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function diskusiDetail()
    {
        return $this->belongsTo(DiskusiDetail::class, 'id', 'perkara_id');
    }

    public function fileSpdp()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::SPDP)->orderBy('created_at', 'desc');
    }

    public function fileSpdpFirst()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::SPDP)->orderBy('created_at', 'asc');
    }

    public function fileSpdpSplit()
    {
        return $this->hasMany(FilePerkara::class, 'perkara_id', 'id')->where('code_id', Constant::SPDP)->where('tersangka_perkara_id', '!=', NULL);
    }

    public function fileSprintSidik()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::SPRINT_SIDIK)->orderBy('created_at', 'desc');
    }

    public function fileSprintTugas()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::SPRINT_TUGAS)->orderBy('created_at', 'desc');
    }

    public function fileBa()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::BERITA_ACARA_PENYELIDIKAN)->orderBy('created_at', 'desc');
    }

    public function fileLp()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::FILE_LP)->orderBy('created_at', 'desc');
    }

    public function fileLainnya()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::FILE_LAINNYA)->orderBy('created_at', 'desc');
    }

    public function fileP16()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P16)->orderBy('created_at', 'desc');
    }

    public function fileResumeBerkasPerkara()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::RESUME_BERKAS_PERKARA)->orderBy('created_at', 'desc');
    }

    public function listJaksa()
    {
        return $this->hasMany(AssignPerkara::class, 'perkara_id', 'id');
    }

    public function listPenyidik()
    {
        return $this->hasMany(PenyidikPerkara::class, 'perkara_id', 'id');
    }

    public function listTersangka()
    {
        return $this->hasMany(TersangkaPerkara::class, 'perkara_id', 'id');
    }

    public function kategoriBagian()
    {
        return $this->belongsTo('App\KategoriBagian', 'kategori_bagian_id', 'id');
    }

    public function perkaraTersangka()
    {
        return $this->hasMany(TersangkaPerkara::class, 'perkara_id', 'id');
    }

    public function perkaraJaksa()
    {
        return $this->hasMany(AssignPerkara::class, 'perkara_id', 'id');
    }

    public function perkaraAdmin()
    {
        return $this->hasMany(AssignPerkaraToAdmin::class, 'perkara_id', 'id');
    }

    public function fileP17()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P17)->orderBy('created_at', 'desc');
    }

    public function fileP18()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P18)->orderBy('created_at', 'desc');
    }

    public function fileP19()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P19)->orderBy('created_at', 'desc');
    }

    public function fileP20()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P20)->orderBy('created_at', 'desc');
    }

    public function fileP21()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P21)->orderBy('created_at', 'desc');
    }

    public function fileP21A()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P21A)->orderBy('created_at', 'desc');
    }

    public function fileSop02()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::SOP_02)->orderBy('created_at', 'desc');
    }

    public function fileBerkasKembali()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::BERKAS_KEMBALI)->orderBy('created_at', 'desc');
    }

    public function fileTahapII()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::BERKAS_TAHAP_II)->orderBy('created_at', 'desc');
    }

    public function fileP31()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P31)->orderBy('created_at', 'desc');
    }

    public function fileP33()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P33)->orderBy('created_at', 'desc');
    }

    public function fileP34()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::P34)->orderBy('created_at', 'desc');
    }

    public function fileRendak()
    {
        return $this->hasOne('App\FilePerkara', 'perkara_id', 'id')->where('code_id', Constant::FILE_RENDAK)->orderBy('created_at', 'desc');
    }

    public function assignPengadilan()
    {
        return $this->hasOne('App\LimpahPerkara', 'perkara_id', 'id')->orderBy('created_at', 'desc');
    }

    public function penyidik()
    {
        return $this->belongsTo('App\Penyidik', 'user_id', 'user_id');
    }

    public function beritaAcara()
    {
        return $this->hasOne('App\BeritaAcara', 'perkara_id', 'id');
    }
}
