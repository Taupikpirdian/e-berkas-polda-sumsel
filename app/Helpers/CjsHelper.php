<?php


namespace App\Helpers;

use App\AksesUserView;
use App\CodeFile;
use App\Http\Repositories\TersangkaRepository;

class CjsHelper
{
    public static function listNamaTersangka($id) {
        $data = (new TersangkaRepository)->getTersangkaById($id)->first();
        return $data;
    }
    
    public static function getNameFile($id)
    {
        $data = CodeFile::where('id', $id)->first();
        return $data;
    }

    public static function createdAtData($id)
    {
        $data = AksesUserView::where('user_id', $id)->first();
        return $data;
    }

    public function listJaksaByWilayah()
    {
        # code...
    }
}