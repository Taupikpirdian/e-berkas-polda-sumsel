<?php 

namespace App\Http\Traits;

use App\Constant;
use App\FileTitipanPenahanan;
use App\TersangkaTitipanTahanan;
use App\TitipanTahanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait TitipanPenahananTraits {
    public function listTitipanPenahanan($query_search)
    {
        $data = TitipanTahanan::with(array('pengadilan', 'tersangka', 'fileTitipanTahananPengaju', 'fileTahananBalasanBalasan', 'rumahtahanan'))->orderBy('created_at', 'asc');

        if($query_search) {
            $data->whereHas('tersangka', function ($query) use ($query_search) {
                $query->where('name', 'like', "%$query_search%");
            });
        }

        $akses = [];
        foreach(thisAkses() as $key=>$dataakses) {
            $akses[] = $dataakses->kategori_bagian_id;
        }

        if (Auth::user()->hasRole('kepolisian')) {
            $data->where('created_by', Auth::user()->id);
        }

        if (Auth::user()->hasRole('lapas')) {
            $data->whereIn('lapas_id', $akses);
        }


        return $data;
    }

    public function getTitipanPenahananById($id)
    {
        return TitipanTahanan::find($id);
    }

    public function getFileTitipanTahananById($id)
    {
        return FileTitipanPenahanan::where('titipanpenahanan_id', $id)->get();
    }

    public function getTersangkaTitipanTahananById($id)
    {
        return TersangkaTitipanTahanan::where('titipanpenahanan_id', $id)->get();
    }

    public function storeDataTersangkaTitipanTahanan($request, $dataTitipanTahanan)
    {
        return TersangkaTitipanTahanan::create([
            'titipantahanan_id' => $dataTitipanTahanan->id,
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'kebangsaan' => $request->kebangsaan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => null,
            'pasal' => null,
        ]);
    }

    public function storeFileTitipanTahanan($request, $dataTitipanTahanan)
    {
        if ($request->file) {
            // extract file
            $folder = 'titipan_penahanan' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'TITIPAN_PENAHANAN' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            return FileTitipanPenahanan::create([
                'titipanpenahanan_id' => $dataTitipanTahanan->id,
                'code' => Constant::PENGAJU,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);
        }
    }

    public function storeTitipanTahanan($request)
    {
        return TitipanTahanan::create([
            'kategori_id' => $request->kategori_id,
            'kategori_bagian_id' => $request->kategori_bagian_id,
            'lapas_id' => $request->lapas_id,
            'rumahtahanan_id' => $request->rumah_tahanan,
            'code' => Constant::PENGAJU,
            'catatan' => $request->catatan,
            'status' => Constant::PENGAJU,
            'created_by' => Auth::user()->id,
        ]);
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