<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTraits;
use App\Perkara;

class KepolisianController extends Controller
{
    use ApiResponseTraits;

    public function listPerkara()
    {
        try {
            $listPerkara = Perkara::with('filePerkara', 'kategoriBagian', 'kategoriBagian.kategori', 'filePerkara.code', 'perkaraTersangka')
                ->orderBy('perkaras.updated_at', 'desc')
                ->get();

            return $this->ok("mendapatkan data list perkara", $listPerkara);
        } catch (\Exception $e) {
            return $this->badRequest("Error : " . $e);
        }
    }
}
