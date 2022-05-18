<?php

namespace App\Http\Controllers\Lapas;

use App\Constant;
use App\FileTitipanPenahanan;
use App\Http\Controllers\Controller;
use App\TitipanTahanan as AppTitipanTahanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TitipanTahananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lapas.titipan-tahanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lapas.titipan-tahanan.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function download($id)
    {
        // decrypt
        $id = helperDecrypt($id);
        $data = FileTitipanPenahanan::where('id', $id)->first();

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->name;
            $originalName = $data->original_name;
            $mainPath = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
            $path = $data->path != null ? $data->path : 'titipan_tahanan' . DIRECTORY_SEPARATOR . date("Y-m-d", $data->created_at) . DIRECTORY_SEPARATOR . $name;
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
        $data = AppTitipanTahanan::find($request->titipantahanan_id);
        DB::beginTransaction();
        try {
            $folder = 'titipan-tahanan' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'titipan-tahanan' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            FileTitipanPenahanan::create([
                'titipanpenahanan_id' => $data->id,
                'code' => Constant::BALASAN,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'catatan' => $request->catatan,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);

            $data->status = Constant::BALASAN;
            $data->save();
            
            DB::commit();
            return redirect()->route('titipan-tahanan.index')->with(['success' => 'Berhasil upload Balasan']);
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
