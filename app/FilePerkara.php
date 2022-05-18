<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilePerkara extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code_id',
        'perkara_id',
        'tgl_berkas',
        'original_name',
        'name',
        'tersangka_perkara_id',
        'type_file',
        'no_berkas',
        'catatan',
        'created_by',
        'updated_by',
        'path',
        'is_forward'
    ];

    public function masterFile()
    {
        return $this->belongsTo('App\CodeFile', 'code_id', 'id');
    }

    public function code()
    {
        return $this->belongsTo('App\CodeFile', 'code_id', 'id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function perkara()
    {
        return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
    }

    public function tersangka()
    {
        return $this->belongsTo('App\TersangkaPerkara', 'tersangka_perkara_id', 'id');
    }
}
