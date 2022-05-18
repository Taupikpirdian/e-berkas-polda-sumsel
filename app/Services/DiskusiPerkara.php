<?php

namespace App\Services;

use App\Constant;
use App\Perkara;
use App\AssignPerkara;

class DiskusiPerkara
{
    /**
     * semua data yang berstatus progress
     */
    public function kepolisian($user_id, $request, $paginate)
    {
        /**
         * list data untuk kepolisian
         * memunculkan data milik polisi tersebut
         */

        $data = Perkara::with([
            'statusBerkas',
        ])->where('user_id', $user_id)
          ->where('status', Constant::ON_PROGRESS)
          ->orderBy('created_at', 'desc')
          ->paginate($paginate);

        return $data;
    }

    public function kejaksaan($user_id, $request, $paginate)
    {
        /**
         * list data untuk kejaksaan
         * memunculkan semua data yang di assign ke user kejaksaan tersebut
         * ambil data dari table AssignPerkara
         */

        $data = AssignPerkara::select([
            'perkaras.id',
            'perkaras.no_lp',
            'perkaras.date_no_lp',
            'perkaras.status',
        ])->join('perkaras', 'assign_perkaras.perkara_id', 'perkaras.id')
          ->join('jaksa_penuntut_umums', 'assign_perkaras.jaksa_penuntut_umum_id', 'jaksa_penuntut_umums.id')
          ->where('jaksa_penuntut_umums.user_id', $user_id)
          ->where('perkaras.status', Constant::ON_PROGRESS)
          ->where(function ($query) use ($request) {
            $query->where('perkaras.no_lp', 'like', "%$request%");
        })->paginate($paginate);

        return $data;
    }

    public function pengadilan($request, $paginate)
    {
        /**
         * list data untuk pengadilan
         * memunculkan semua data yang berstatus lengkap
         */

        $data = Perkara::with([
            'statusBerkas'
        ])->whereIn('status', [Constant::LENGKAP, Constant::ON_PROGRESS])
          ->orderBy('created_at', 'desc')
          ->paginate($paginate);

        return $data;
    }
}
