<?php

namespace App\Http\Repositories\Admin;

use App\PengadilanNegeri;

class PengadilanNegeriRepository
{
    public function listPengadilanNegeri()
    {
        return PengadilanNegeri::orderBy('name', 'asc');
    }

    public function getPengadilanNegeriById($id)
    {
        return PengadilanNegeri::where('id', $id)->first();
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
