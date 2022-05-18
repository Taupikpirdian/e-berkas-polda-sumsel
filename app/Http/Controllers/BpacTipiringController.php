<?php

namespace App\Http\Controllers;

use App\Constant;
use App\BpacTipiring;
use App\FileBpacTipiring;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BpacTipiringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bpac-tipiring.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bpac-tipiring.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fitur = 'detail';
        return view('bpac-tipiring.edit', compact('id', 'fitur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fitur = 'edit';
        return view('bpac-tipiring.edit', compact('id', 'fitur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($id, $code)
    {
        // decrypt
        $id = helperDecrypt($id);
        $data = FileBpacTipiring::where('id', $id)->where('code', $code)->first();

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->name;
            $originalName = $data->original_name;
            $mainPath = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
            $path = $data->path != null ? $data->path : 'bpac_tipiring' . DIRECTORY_SEPARATOR . $data->tanggal_pelimpahan . DIRECTORY_SEPARATOR . $name;
            $file = storage_path() . $mainPath . $path;

            $content_type = "";
            if ($data['type_file'] == "pdf") {
                $content_type = "application/pdf";
            } else {
                $content_type = "image/" . $data['type_file'];
            }

            $header = [
                'Content-Type: ' . $content_type,
            ];

            return response()->download($file, $name, $header);
        } else {
            return redirect()->back()->with(['error' => 'File Tidak ada']);
        }
    }

    public function createBalasan(Request $request)
    {
        $data = BpacTipiring::find($request->bpac_tipiring_id);
        DB::beginTransaction();
        try {
            $folder = 'bacp_tipiring' . DIRECTORY_SEPARATOR . $data->tanggal_register;
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'BACP_Tipiring' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            FileBpacTipiring::create([
                'bpac_tipiring_id' => $data->id,
                'code' => Constant::BALASAN,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
                'created_by' => Auth::user()->id,
            ]);

            $data->status = Constant::BALASAN;
            $data->updated_by = Auth::user()->id;
            $save = $data->save();

            if ($save) {
                // notif for kepolisian
                $text = 'Telah Mengirim Surat Balasan BACP Tipiring';
                $reqNotifOne = [
                    'user_id' => Auth::user()->id,
                    'notif_for' => $data->created_by,
                    'desc' => $text,
                    'data_id' => $data->id,
                    'notif_fitur' => 'Upload Surat Balasan BACP Tipiring',
                    'notif_type' => Constant::NOTIF_BACP
                ];

                // kirim notif ke user tektokan
                notificationOne($reqNotifOne);

                // kirim notif untuk admin kejaksaan
                $reqNotifMany = [
                    'user_id'       => Auth::user()->id,
                    'desc'          => $text,
                    'data_id'    => $data->id,
                    'notif_type' => Constant::NOTIF_BACP
                ];
                notificationMany($reqNotifMany, 'admin-kejaksaan', 'Upload Surat Balasan BACP Tipiring');
            }

            DB::commit();
            return redirect()->route('bacp-tipiring.index')->with(['success' => 'Berhasil upload Balasan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
