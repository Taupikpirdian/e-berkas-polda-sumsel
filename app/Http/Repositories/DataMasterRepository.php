<?php

namespace App\Http\Repositories;

use App\Status;
use App\Kategori;
use App\Penyidik;
use App\JenisPidana;
use App\KategoriBagian;

class DataMasterRepository
{
    public function token()
    {
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI0MTAzNzAwNjE1MTAxNyIsIm5hbWUiOiJDcmltaW5hbCBKdXN0aWNlIFN5c3RlbSBQbHVzIiwiaWF0IjoxNTE2MjM5MDIyfQ.85duIqjOqqo40QqVeVGhaVVhZsu2UUhwtB1hjexXNEg';
    }

    public function masterKategori()
    {
        return Kategori::orderBy('name', 'asc')->get();
    }

    public function masterKategoriBagian()
    {
        return KategoriBagian::orderBy('name', 'asc')->get();
    }

    public function masterJenisPidana()
    {
        return JenisPidana::orderBy('name', 'asc')->get();
    }

    public function masterStatus($is_custom = false, $status = [])
    {
        return Status::orderBy('name', 'asc')
            ->when($is_custom == true, function ($q) use ($status) {
                $q->whereIn('id', $status);
            })->get();
    }

    public function dataPenyidikById($user_id)
    {
        return Penyidik::where('user_id', $user_id)->first();
    }

    public function contentPaginate($datas)
    {
        // for calculate the current display of paginated content
        $count  = $datas->count();
        $limit  = $datas->perPage();
        $page   = $datas->currentPage();
        $total  = $datas->total();

        $upper = min($total, $page * $limit);
        if ($count == 0) {
            $lower = 0;
        } else {
            $lower = ($page - 1) * $limit + 1;
        }

        return "Showing $lower to $upper of $total";
    }
}
