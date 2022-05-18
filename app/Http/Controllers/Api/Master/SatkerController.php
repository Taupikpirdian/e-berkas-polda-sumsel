<?php
/*
|
| Author Bambang Hermawan
|
 */

namespace App\Http\Controllers\Api\Master;

use App\KategoriBagian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\DataMasterRepository;

class SatkerController extends Controller
{
    public function __construct(DataMasterRepository $repoDataMaster) 
    {
        $this->repoDataMaster = $repoDataMaster;
    }

    public function getDataMaster(Request $request)
    {
        $tokenFromRequest = $request->bearerToken();
        $token = $this->repoDataMaster->token();

        if($tokenFromRequest == $token){
            $data = KategoriBagian::with('kategori')
            ->select(['id','kategori_id','name'])
            ->get();
            
            if(!$data) {
                return [
                    "status" => 500,
                    "message" => "error",
                    "data" => null
                ];
            }
    
            return [
                "status" => 200,
                "message" => "success",
                "data" => $data
            ];
        }else{
            return [
                "status" => 500,
                "message" => "Authentication failure",
                "data" => null
            ];
        }

    }
}
