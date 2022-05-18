<?php

namespace App\Http\Repositories;

use App\Akses;
use App\Perkara;
use App\BeritaAcara;
use App\Formil;
use App\Materil;
use App\Constant;

class BeritaAcaraRepository
{
    public function index($request)
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
        ])->where('status', Constant::ON_PROGRESS)->where(function ($query) use ($freeTextSearch) {
                $query->where('perkaras.no_lp', 'like', "%$freeTextSearch%")
                ->orWhereHas('perkaraTersangka', function ($query) use ($freeTextSearch) {
                    $query->where('name', 'like', "%$freeTextSearch%");
                });
            })->doesntHave('beritaAcara')->orderBy('perkaras.updated_at', 'desc');

        return $data;
    }

    public function listBeritaAcara($query_search)
    {
        $data = BeritaAcara::with(array('formil', 'materil', 'perkara' => function ($query) {
            $query->with('perkaraJaksa.masterJaksa', 'perkaraTersangka');
        }))->orderBy('created_at', 'asc');

        if($query_search) {
            $data->whereHas('perkara.perkaraTersangka', function ($query) use ($query_search) {
                $query->where('name', 'like', "%$query_search%");
            })->orWhereHas('perkara', function ($query) use ($query_search) {
                $query->where('no_lp','like', "%$query_search%");
            })->orWhereHas('perkara.listJaksa', function ($query) use ($query_search) {
                $query->whereHas('masterJaksa', function ($q) use ($query_search) {
                    $q->where('name','like',"%$query_search%");
                });
            });
        }

        return $data;
    }

    public function getBeritaAcaraById($id)
    {
        return BeritaAcara::where('id', $id)->first();
    }

    public function StoreBeritaAcara($request)
    {
        $data = BeritaAcara::updateOrCreate(
            [
                'kategori_id' => $request->kategori_id,
                'kategori_bagian_id' => $request->kategori_bagian_id,
                'perkara_id' => $request->perkara_id,
            ],
            [
                'kesimpulan' => $request->kesimpulan,
                'alamat' => $request->alamat,
                'tanggal' => $request->tanggal,
                'surat_perintah' => $request->surat_perintah
            ]
        );
        
        return $data;
    }

    /** Formils */
    public function storeFormils($array_formil, $array_formil_deleted, $request)
    {
        $getFormilById = $this->getFormilsId($array_formil_deleted);
        /**
         * delete data tersangka on db
         */
        foreach ($getFormilById as $gt) {
            $gt->delete();
        }

        foreach ($array_formil as $data) {
            Formil::Create(
                [
                    'berita_acara_id' => $request->id,
                    'name' => $data['name'],
                ]
            );
        }
    }

    public function getFormilsId($array_id)
    {
        return Formil::whereIn('id', $array_id)->get();
    }

    /** materils */
    public function storeMaterils($array_materil, $array_materil_deleted, $request)
    {
        $getMaterilById = $this->getMaterilsId($array_materil_deleted);
        /**
         * delete data tersangka on db
         */
        foreach ($getMaterilById as $gt) {
            $gt->delete();
        }

        foreach ($array_materil as $data) {
            Materil::Create(
                [
                    'berita_acara_id' => $request->id,
                    'name' => $data['name'],
                ]
            );
        }
    }

    public function getMaterilsId($array_id)
    {
        return Materil::whereIn('id', $array_id)->get();
    }

    public function deleteMaterilById($id)
    {
        return Materil::where('berita_acara_id', $id)->delete();
    }

    public function deleteFormilById($id)
    {
        return Formil::where('berita_acara_id', $id)->delete();
    }
}
