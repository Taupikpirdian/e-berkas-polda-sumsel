<?php

namespace App\Http\Livewire\Kejaksaan\ListPolres;

use Livewire\Component;
use App\KategoriBagian;
use Illuminate\Support\Facades\DB;

class ListPolres extends Component
{
    public $query = '';

    public function render()
    {
        $search = $this->query;
        // list data polres (in kategori_bagians table)
        $list_polres = KategoriBagian::select([
            'kategori_bagians.id',
            'kategori_bagians.name',
            'kategoris.name as kategori',
            DB::raw('count(perkaras.id) as total')
          ])->whereIn('kategori_bagians.kategori_id', [1,2,3])
            ->leftjoin('kategoris', 'kategoris.id', '=', 'kategori_bagians.kategori_id')
            ->leftjoin('perkaras', 'perkaras.kategori_bagian_id', '=', 'kategori_bagians.id')
            ->groupBy('kategori_bagians.name', 'kategori_bagians.id')
            ->where(function ($query) use ($search) {
                $query->where('kategori_bagians.name', 'like', "%$search%")
                    ->orWhere('kategoris.name', 'like', "%$search%");
            })
            ->orderBy('kategori_bagians.kategori_id', 'asc')
            ->orderBy('kategori_bagians.name', 'asc')
            ->get();
        
        return view('livewire.kejaksaan.list-polres.list-polres', compact('list_polres'));
    }
}
