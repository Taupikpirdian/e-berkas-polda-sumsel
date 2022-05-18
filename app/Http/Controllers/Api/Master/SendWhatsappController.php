<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Services\BroadcastWhatsappServices;
use Illuminate\Http\Request;

class SendWhatsappController extends Controller
{
    public function sendMessage(Request $request)
    {
        $validated = \Validator::make($request->all(),
            [
                'no_lp' => 'required|max:255',
                'kronologi' => 'required',
                'penyidik' => 'required',
                'nrp' => 'required',
                'no_hp' => 'required',
                'date_no_lp' => 'required',
                // 'kategori' => 'required|numeric',
                // 'kategori_bagian_id' => 'required|numeric',
            ], [
                'no_lp.required' => 'No LP tidak boleh kosong',
                'kronologi.required' => 'Kronologi tidak boleh kosong',
                'penyidik.required' => 'Penyidik tidak boleh kosong',
                'nrp.required' => 'NRP tidak boleh kosong',
                'date_no_lp.required' => 'Tanggal No LP tidak boleh kosong',
            ]
        );

        if (!$validated->fails()) {
            $to = "62" . ltrim($request->no_hp, "0");
            // $kategori_bagian = KategoriBagian::with('kategori')->where('id', $akses->kategori_bagian_id)->first();
            // $nama_kategori_bagian = $kategori_bagian->name;
            // $nama_kategori = $kategori_bagian->kategori->name;
            $description = "Hello, " . $request->penyidik . " (" . $request->nrp . ")\n\nTerdapat data perkara baru dengan no lp : " . $request->no_lp . ", tanggal no lp : " . date("d M Y", strtotime($request->date_no_lp)) . ".\nKronologi :\n" . $request->kronologi . ".\n\nStatus : " . $request->status; // . "\n\n" . $nama_kategori . " - " . $nama_kategori_bagian;

            BroadcastWhatsappServices::sendWa($to, $description);

            return response()->json([
                'data' => array(
                    'message' => $description,
                ),
                'code' => 200,
                'message' => 'Send message by whatsapp success',
            ], 200);
        } else {
            return response()->json([
                'data' => null,
                'code' => 400,
                'message' => 'Error : ' . $validated->messages(),
            ], 400);
        }
    }
}
