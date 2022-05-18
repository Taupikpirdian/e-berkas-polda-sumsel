<?php

namespace App\Http\Repositories;

use App\Akses;
use App\Constant;
use App\Diversi;
use App\FileDiversi;
use App\TersangkaDiversi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiversiRepository
{
    public function storeDiversi($request)
    {
        $data = Diversi::find($request->id);

        if ($data) {
            $data->nomor_register = $request->nomor_register;
            $data->pengaju = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->pengadilan_id = $request->pengadilan_id;
            $data->save();
        } else {
            $data = Diversi::create([
                'nomor_register' => $request->nomor_register,
                'pengaju' => Auth::user()->id,
                'status' => Constant::PENGAJU,
                'pengadilan_id' => $request->pengadilan_id,
                'created_by' => Auth::user()->id,
                'kategori_id' => $request->kategori_id,
                'kategori_bagian_id' => $request->kategori_bagian_id
            ]);
        }

        return $data;
    }

    public function storeFileDiversi($request, $diversi)
    {
        $data_file = FileDiversi::find($request->id);

        if ($data_file) {
            if ($request->file) {
                $folder = 'diversi' . DIRECTORY_SEPARATOR . date('YmdHis');
                $rand = $this->generateRandomString();
                $ext = $request->file->getClientOriginalExtension();
                $name = 'diversi' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                // store to storage
                Storage::disk('public')->putFileAs($folder, $request->file, $name);

                $data_file->original_name = $request->file->getClientOriginalName();
                $data_file->name = $name;
                $data_file->type_file = $ext;
                $data_file->path = $folder . DIRECTORY_SEPARATOR . $name;
                $data_file->save();
            }
        } else {
            $folder = 'diversi' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'diversi' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            $data_file = FileDiversi::create([
                'diversi_id' => $diversi->id,
                'code' => Constant::PENGAJU,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);
        }

        return $data_file;
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

    public function listDiversi($search_query)
    { 
        $data = Diversi::with(array('pengaju', 'tersangka', 'createdBy', 'fileDiversiPengaju', 'fileDiversiBalasan'));
        $akses;
        foreach(thisAkses() as $key=>$dataakses) {
            $akses[] = $dataakses->kategori_bagian_id;
        }
        if ($search_query) {
            $data->whereHas('tersangka', function ($query) use ($search_query) {
                $query->where('name', 'like', "%$search_query%");
            });
        }

        if (Auth::user()->hasRole('kepolisian')) {
            $data->where('created_by', Auth::user()->id);
        }

        if (Auth::user()->hasRole('pengadilan')) {
            $data->where('pengadilan_id', $akses);
        }

        $data->orderBy('updated_at', 'asc')->get();

        return $data;
    }

    public function getDiversiById($id)
    {
        return Diversi::find($id);
    }

    public function getFileDiversiById($id)
    {
        return FileDiversi::where('diversi_id', $id)->get();
    }

    public function storeTersangkaDiversi($request, $diversi)
    {
        return TersangkaDiversi::create([
            'diversi_id' => $diversi->id,
            'name' => $request->nama_tersangka,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'kebangsaan' => $request->kebangsaan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => $request->pendidikan ? $request->pendidikan : null,
            'pasal' => $request->pasal ? $request->pasal : null,
        ]);
    }

    public function paginateContent($datas)
    {
        $count = $datas->count();

        $limit = $datas->perPage();
        $page = $datas->currentPage();
        $total = $datas->total();

        $upper = min($total, $page * $limit);
        if ($count == 0) {
            $lower = 0;
        } else {
            $lower = ($page - 1) * $limit + 1;
        }
        $paginate_content = "Showing $lower to $upper of $total";

        return $paginate_content;
    }
}
