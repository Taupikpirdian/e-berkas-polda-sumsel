<?php

namespace App\Http\Traits;

trait ApiResponseTraits
{
    protected function ok($msg, $result = null)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil ' . $msg,
            'data' => $result,
        ], 200);
    }

    protected function created($msg, $result = null)
    {
        return response()->json([
            'code' => 201,
            'message' => 'Berhasil membuat ' . $msg,
            'data' => $result,
        ], 201);
    }

    protected function badRequest($error, $result = null)
    {
        return response()->json([
            'code' => 400,
            'message' => $error,
            'data' => $result,
        ], 400);
    }

    protected function validationFail($error, $result = null)
    {
        return response()->json([
            'code' => 403,
            'message' => $error,
            'data' => $result,
        ], 403);
    }

    protected function unauthorized()
    {
        return response()->json([
            'code' => 401,
            'message' => "Token anda sudah habis. Harap login kembali !",
            'data' => null,
        ], 401);
    }

    protected function upgradeRequired($result = null)
    {
        return response()->json([
            'code' => 426,
            'message' => 'Error harap untuk melakukan update aplikasi ke versi terbaru !',
            'data' => $result,
        ], 426);
    }
}
