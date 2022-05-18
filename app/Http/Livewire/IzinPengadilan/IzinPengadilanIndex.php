<?php

namespace App\Http\Livewire\IzinPengadilan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\IzinPengadilanService;
use App\Http\Repositories\Admin\PangkatRepository;

class IzinPengadilanIndex extends Component
{
    use WithPagination;

    public $label, $fitur, $pihak, $role, $user;
    public $query = '';
    public $query_daterange;
    public $status;
    public $perPage = 25;
    public $arrayPengadilan = [];

    public function mount($fitur)
    {
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login

        $this->fitur = $fitur ?? '';
        if ($this->fitur == 'izin-geledah') {
            $this->label = 'Izin Geledah';
            $this->pihak = 'Pihak Tergeledah';
        } elseif ($fitur == 'izin-sita') {
            $this->label = 'Izin Sita';
            $this->pihak = 'Pihak Tersita';
        } else { // clear
            $this->label = '';
        }

        if ($this->role == 'pengadilan') {
            $this->arrayPengadilan = arrayPengadilanByAkses();
        }
    }

    public function render()
    {
        $request = [
            'query' => $this->query,
            'query_daterange' => $this->query_daterange,
            'status' => $this->status
        ];

        $datas = (new IzinPengadilanService)->index($request, $this->fitur, $this->role, $this->user->id, $this->arrayPengadilan)
            ->paginate($this->perPage);

        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        $paginate_content = (new PangkatRepository)->paginateContent($datas);

        return view('livewire.izin-pengadilan.izin-pengadilan-index', compact('datas', 'paginate_content'));
    }
}
