<?php

namespace App\Services;

use App\Perkara;
use App\Constant;
use App\Http\Repositories\GeneralRepository;

class PerkaraTahap2Service
{
    public function index($request, $role, $user_id = null, $arrayPerkaraId = [], $filter = null)
    {
        $freeTextSearch = isset($request['query']) ? $request['query'] : null;
        $statusData = isset($request['status']) ? $request['status'] : null;
        $date = null;
        if (isset($request['query_daterange'])) {
            $date = (new GeneralRepository())->customDateRange($request['query_daterange']);
        }

        $data = Perkara::with([
            'statusBerkas',
            'fileSpdp',
            'fileSprintSidik',
            'fileSprintTugas',
            'fileBa',
            'fileP16',
            'fileP17',
            'fileP18',
            'fileP19',
            'fileResumeBerkasPerkara',
            'fileP20',
            'fileP21',
            'fileP21A',
            'fileSop02',
            'fileBerkasKembali',
            'fileTahapII',
            'perkaraTersangka',
            'perkaraJaksa.masterJaksa',
            'penyidik',
        ])->whereIn('status', [Constant::LENGKAP, Constant::TAHAP_II])
            ->when($role == 'kepolisian', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })->when($role == 'admin-kejaksaan', function ($q) {
                $q->whereIn('status', [Constant::OPEN, Constant::ON_PROGRESS]);
            })->when($role == 'kejaksaan', function ($q) use ($arrayPerkaraId) {
                $q->whereIn('id', $arrayPerkaraId);
            })->where(function ($query) use ($freeTextSearch) {
                $query->where('perkaras.no_lp', 'like', "%$freeTextSearch%")
                    ->orWhereHas('perkaraTersangka', function ($query) use ($freeTextSearch) {
                        $query->where('name', 'like', "%$freeTextSearch%");
                    });
            })->when($statusData, function ($q) use ($statusData) {
                $q->where('status', $statusData);
            })->when($date, function ($q) use ($date) {
                $q->whereBetween('date_no_lp', [$date['startDate'], $date['endDate']]);
            })->when($filter == "berkas", function ($q) {
                $q->has('fileResumeBerkasPerkara');
            })->when($filter == "p21", function ($q) {
                $q->has('fileP21');
            })->orderBy('perkaras.updated_at', 'desc');

        return $data;
    }
}
