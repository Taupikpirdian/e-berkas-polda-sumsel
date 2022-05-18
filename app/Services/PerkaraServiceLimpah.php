<?php

namespace App\Services;

use App\Constant;
use App\FilePerkara;
use App\Http\Repositories\GeneralRepository;
use App\Http\Repositories\SpdpRepository;
use App\Perkara;
use App\Services\PerkaraServiceLimpah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerkaraServiceLimpah
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
            'perkaraTersangka',
            'perkaraJaksa.masterJaksa',
            'penyidik',
            'fileP31',
            'fileP33',
            'fileP34',
            'fileRendak',
            'assignPengadilan',
        ])->whereIn('status', [Constant::LENGKAP, Constant::LIMPAH]) // tahap 2 nanti hapus, temporary aja sekarang
        ->when($role == 'pengadilan', function ($q) use ($user_id) {
            $q->whereHas('assignPengadilan', function ($q) use ($user_id) {
                $q->where('pengadilan_id', $user_id);
            });
        })->when($role == 'kepolisian', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
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
        })->when($filter == "p31", function ($q) {
            $q->has('fileP31');
        })->when($filter == "p33", function ($q) {
            $q->has('fileP33');
        })->when($filter == "p34", function ($q) {
            $q->has('fileP34');
        })->when($filter == "fileRendak", function ($q) {
            $q->has('fileRendak');
        })->orderBy('perkaras.updated_at', 'desc');

        return $data;
    }

    public function uploadFileLimpahPerkara($request, $codeFile, $file)
    {
        $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
        if ($file) {
            $rand = (new SpdpRepository)->generateRandomString();
            $ext = $file->getClientOriginalExtension();
            $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

            Storage::disk('public')->putFileAs($folder, $file, $name);

            // save db
            FilePerkara::create([
                'code_id' => $codeFile,
                'perkara_id' => $request->perkara_id,
                'original_name' => $file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
                'created_by' => Auth::user()->id,
                'catatan' => $request->catatan,
            ]);
        }
    }
}
