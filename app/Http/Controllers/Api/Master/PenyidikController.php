<?php

namespace App\Http\Controllers\Api\Master;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\DataMasterRepository;

class PenyidikController extends Controller
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

            $data = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.phone'
            ])->role('kepolisian')
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
                "message" => "Authentication failur",
                "data" => null
            ];
        }

    }
}
