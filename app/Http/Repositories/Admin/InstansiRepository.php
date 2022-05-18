<?php

namespace App\Http\Repositories\Admin;

use App\Instansi;

class InstansiRepository
{
    public function listInstansi($query)
    {
        return Instansi::orderBy('name', 'asc')->where('name', 'like', "%$query%");
    }

    public function getInstansiById($id)
    {
        return Instansi::where('id', $id)->first();
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
