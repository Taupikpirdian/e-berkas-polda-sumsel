<?php

namespace App\Http\Repositories\Admin;

use App\Constant;
use App\Http\Traits\NapiBebasTraits;
use App\Http\Traits\TitipanPenahananTraits;
use App\KategoriBagian;
use App\Perkara;
use App\RumahTahanan;
use App\Tahanan;
use Illuminate\Support\Facades\Auth;

class LapasRepository 
{
    // trait 
    use NapiBebasTraits;
    use TitipanPenahananTraits;

    public function listTahanan($query = null)
    {
        $data = Tahanan::orderBy('name', 'asc');

        if ($query) {
            $data->where('name','like',"%$query%");
        }

        return $data;
    }

    public function listRumahTahanan($query = null)
    {
        $data = RumahTahanan::orderBy('name', 'asc');

        if ($query) {
            $data->where('name','like',"%$query%");
        }
        
        return $data;
    }

    public function getRumahTahananById($id)
    {
        return RumahTahanan::where('id', $id)->first();
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

    public function listDataPranut($request, $arrayPerkaraId)
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
                $query->where('perkaras.no_lp', 'like', "%$freeTextSearch%")
                ->orWhereHas('perkaraTersangka', function ($query) use ($freeTextSearch) {
                    $query->where('name', 'like', "%$freeTextSearch%");
                });
            });

        if(Auth::user()->hasRole('kepolisian')) {
            $data->whereIn('status', [Constant::TAHAP_I, Constant::ON_PROGRESS])->where('user_id', Auth::user()->id);
        }

        if(Auth::user()->hasRole('kejaksaan')) {
            $data->whereIn('status', [Constant::TAHAP_II])->whereIn('id', $arrayPerkaraId);;
        };

        $data->orderBy('perkaras.updated_at', 'desc');


        return $data;
    }


    public function listLapas()
    {
        $data = KategoriBagian::where('kategori_id', Constant::N_KEMENKUMHAM)->get();
        return $data;
    }
}