<?php

namespace App\Http\Repositories;

use App\Constant;
use App\BpacTipiring;
use App\FileBpacTipiring;
use App\TersangkaBpacTipiring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BpacTipiringRepository
{
    public function storeBpacTipiring($request, $code)
    {
        $data = BpacTipiring::find($request->id);

        if ($data) {
            $data->tanggal_pelimpahan = date("Y-m-d", strtotime($request->tanggal_pelimpahan));
            $data->tanggal_register = date("Y-m-d", strtotime($request->tanggal_register));
            $data->penyidik_id = $request->penyidik_id;
            $data->pengadilan_id = $request->pengadilan_id;
            $data->updated_by = Auth::user()->id;
            $saved = $data->save();
        } else {
            $data = BpacTipiring::create([
                'tanggal_pelimpahan' => date("Y-m-d", strtotime($request->tanggal_pelimpahan)),
                'tanggal_register' => date("Y-m-d", strtotime($request->tanggal_register)),
                'penyidik_id' => $request->penyidik_id,
                'pengadilan_id' => $request->pengadilan_id,
                'created_by' => Auth::user()->id,
                'status' => $code,
                'kategori_id' => $request->kategori_id,
                'kategori_bagian_id' => $request->kategori_bagian_id
            ]);
        }

        return $data;
    }

    public function storeFileBpacTipiring($request, $code, $bpacTipiring)
    {
        if ($request->file) {
            $file_bpac_tipiring = FileBpacTipiring::where('bpac_tipiring_id', $request->id)->where('code', $code)->first();
            // extract file
            $folder = 'bacp_tipiring' . DIRECTORY_SEPARATOR . $request->tanggal_register;
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'BACP_Tipiring' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            if($file_bpac_tipiring) {
                $file_bpac_tipiring->original_name = $request->file->getClientOriginalName();
                $file_bpac_tipiring->name = $name;
                $file_bpac_tipiring->type_file = $ext;
                $file_bpac_tipiring->path = $folder . DIRECTORY_SEPARATOR . $name;
                $file_bpac_tipiring->updated_by = Auth::user()->id;
                $file_bpac_tipiring->save();
            } else {
                FileBpacTipiring::create([
                    'bpac_tipiring_id' => $bpacTipiring->id,
                    'code' => $code,
                    'original_name' => $request->file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id
                ]);
            }
        }
    }

    public function storeTersangka($array_tersangka, $array_tersangka_deleted, $bpacTipiring)
    {
        $getTersangkaById = $this->getTersangkaById($array_tersangka_deleted);
        /**
         * delete data tersangka on db
         */
        foreach($getTersangkaById as $gt){
            $gt->delete();
        }

        foreach($array_tersangka as $data){
            TersangkaBpacTipiring::updateOrCreate([
                'id' => $data['id'],
            ],
            [
                'id_bpac_tipiring' => $bpacTipiring->id,
                'name' => $data['name'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tgl_lahir' => $data['tgl_lahir'],
                'jk' => $data['jk'],
                'kebangsaan' => $data['kebangsaan'],
                'alamat' => $data['alamat'],
                'agama' => $data['agama'],
                'pekerjaan' => $data['pekerjaan'],
                'pendidikan' => $data['pendidikan'],
                'pasal' => $data['pasal'],
                'created_by' => $data['created_by'],
                'updated_by' => $data['updated_by'],
                'nik' => $data['nik']
            ]);
        }
    }

    public function getTersangkaById($array_id) {
        return TersangkaBpacTipiring::whereIn('id', $array_id)->get();
    }

    public function dataTersangka($id_bpac_tipiring)
    {
        return TersangkaBpacTipiring::with('bpacTipiring','createdBy', 'updatedBy')
            ->where('id_bpac_tipiring', $id_bpac_tipiring)
            ->orderBy('id', 'asc')
            ->get();
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

    public function listBpacTipiring($search_query)
    { 
        $data = BpacTipiring::with(['penyidik', 'fileBpacTipiring', 'filePengajuan','fileBalasan','pengadilan']);

        if ($search_query) {
            $data->whereHas('penyidik', function ($query) use ($search_query) {
                    $query->where('name', 'like', "%$search_query%");
                 })->orWhereHas('tersangka', function ($query) use ($search_query) {
                    $query->where('name', 'like', "%$search_query%");
                 })->orWhereHas('pengadilan', function ($query) use ($search_query) {
                     $query->where('name', 'like', "%$search_query%");
                 });
        }

        // $akses;
        // foreach(thisAkses() as $key=>$dataakses) {
        //     $akses[] = $dataakses->kategori_bagian_id;
        // }

        $data->when(Auth::user()->hasRole('kepolisian'), function ($q) {
            $q->where('created_by', Auth::user()->id);
        })->when(Auth::user()->hasRole('pengadilan'), function ($q) {
            $q->where('pengadilan_id', Auth::user()->id);
        });

        return $data->orderBy('updated_at', 'desc');
    }

    public function getBpacTipiringById($id)
    {
        return BpacTipiring::find($id);
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
