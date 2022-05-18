<?php

namespace App\Http\Controllers\Kejaksaan;

use App\Http\Controllers\Controller;
use App\PerpanjanganPenahananFile;
use Illuminate\Http\Request;

class PerpanjanganPenahananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kejaksaan.perpanjangan-penahanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('kejaksaan.perpanjangan-penahanan.create', compact('id'));
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
        $data = PerpanjanganPenahananFile::find($id);

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->name;
            $originalName = $data->original_name;
            $mainPath = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
            $path = $data->path != null ? $data->path : 'perpanjangan_penahanan' . DIRECTORY_SEPARATOR . $data->created_at . DIRECTORY_SEPARATOR . $name;
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
