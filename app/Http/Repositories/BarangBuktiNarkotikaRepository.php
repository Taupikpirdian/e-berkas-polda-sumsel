<?php

namespace App\Http\Repositories;

use App\BarangBuktiNarkotika;
use App\BarangBuktiNarkotikaFile;
use App\Constant;
use App\Perkara;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangBuktiNarkotikaRepository
{
    public function listBarangBuktiNarkotika($search_query, $role)
    {
        $data = BarangBuktiNarkotika::with(array('filePengaju', 'fileBalasan', 'fileSpSita', 'fileBaCc', 'fileBaSita', 'fileResume', 'perkara' => function ($query) {
            $query->with([
                'statusBerkas',
                'fileSpdp',
                'fileSprintSidik',
                'fileSprintTugas',
                'fileBa',
                'fileP16',
                'fileP17',
                'fileP18',
                'fileResumeBerkasPerkara',
                'fileP20',
                'fileP21',
                'fileP21A',
                'perkaraTersangka',
                'perkaraJaksa.masterJaksa',
                'penyidik'
            ]);
        }))->orderBy('created_at', 'desc');

        $akses = [];
        foreach (thisAkses() as $dataakses) {
            $akses[] = $dataakses->kategori_bagian_id;
        }

        if ($role == 'kepolisian') {
            $data->where('created_by', Auth::user()->id);
        }

        if ($role == 'admin-kejaksaan') {
            $data->where('kejaksaan_id', $akses);
        }

        if ($search_query) {
            $data->whereHas('perkara', function ($query) use ($search_query) {
                $query->where('no_lp', 'like', "%$search_query%");
            });
        }
        return $data;
    }

    public function listBarangBuktiNarkotikaById($id)
    {
        $data = BarangBuktiNarkotika::find($id);
        return $data;
    }

    public function fileBarangBuktiNarkotikaById($id)
    {
        $data = BarangBuktiNarkotikaFile::where('barangbuktinarkotika_id', $id)->get();
        return $data;
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

    public function listDataPranut($request)
    {
        $freeTextSearch = isset($request['query']) ? $request['query'] : null;
        $data = Perkara::with([
            'statusBerkas',
            'fileSpdp',
            'fileSprintSidik',
            'fileSprintTugas',
            'fileBa',
            'fileP16',
            'fileP17',
            'fileP18',
            'fileResumeBerkasPerkara',
            'fileP20',
            'fileP21',
            'fileP21A',
            'perkaraTersangka',
            'perkaraJaksa.masterJaksa',
            'penyidik'
        ])->where(function ($query) use ($freeTextSearch) {
            $query->where('perkaras.no_lp', 'like', "%$freeTextSearch%");
        })
            ->whereNotIn('status', [Constant::OPEN])
            ->orderBy('perkaras.updated_at', 'desc');

        return $data;
    }

    public function storeDataBarangBuktiNarkotika($request)
    {
        return BarangBuktiNarkotika::create([
            'perkara_id' => $request->perkara_id,
            'kejaksaan_id' => $request->kejaksaan_id,
            'nosurat_permohonan' => $request->nomor_surat_permohonan,
            'status' => Constant::PENGAJU,
            'created_by' => Auth::user()->id,
        ]);
    }

    public function storeFileBarangBuktiNarkotika($request, $dataBarangBukti)
    {
        $arrayFile = array(
            array(
                "is_array" => is_array($request->file_permohonan),
                "code" => Constant::PENGAJU,
                "file" => $request->file_permohonan,
                "no_berkas" => $request->file_permohonan
            ),
            array(
                "is_array" => is_array($request->berkas_sp_sita),
                "code" => Constant::SP_SITA,
                "file" => $request->berkas_sp_sita,
                "no_berkas" => $request->berkas_sp_sita
            ),
            array(
                "is_array" => is_array($request->berkas_ba_sita),
                "code" => Constant::BA_SITA,
                "file" => $request->berkas_ba_sita,
                "no_berkas" => $request->berkas_ba_sita
            ),
            array(
                "is_array" => is_array($request->berkas_ba_cc),
                "code" => Constant::BA_CC,
                "file" => $request->berkas_ba_cc,
                "no_berkas" => $request->berkas_ba_cc
            ),
            array(
                "is_array" => is_array($request->berkas_resume),
                "code" => Constant::RESUME,
                "file" => $request->berkas_resume,
                "no_berkas" => $request->berkas_resume
            ),
        );

        $folder = 'barang_bukti_narkotika' . DIRECTORY_SEPARATOR . date('YmdHis');
        foreach ($arrayFile as $file) {
            if ($file['file']) {
                if ($file['is_array'] == false) {
                    $rand = $this->generateRandomString();
                    $ext = $file['file']->getClientOriginalExtension();
                    $name = $file['code'] . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                    // store to storage
                    Storage::disk('public')->putFileAs($folder, $file['file'], $name);

                    BarangBuktiNarkotikaFile::create([
                        'barangbuktinarkotika_id' => $dataBarangBukti->id,
                        'code_id' => $file['code'],
                        'original_name' => $file['file']->getClientOriginalName(),
                        'name' => $name,
                        'type_file' => $ext,
                        'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    ]);
                }
            }
        }

        return true;
    }
}
