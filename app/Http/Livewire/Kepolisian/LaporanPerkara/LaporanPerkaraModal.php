<?php

namespace App\Http\Livewire\Kepolisian\LaporanPerkara;

use App\Perkara;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanPerkaraModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $createdLaporanPerkara = false;
    public $selectedLaporanPerkaraId = null;
    public $deleteModalLaporanPerkara = false;

    protected $listeners = [
        'laporanPerkaraUpdated',
        'indexLaporanPerkara',
        'deleteLaporanPerkara',
    ];

    public function laporanPerkaraUpdated($status)
    {
        $this->createdLaporanPerkara = false;
        if ($status) {
            $this->emit('updateSweetAlert', true);
        } else {
            $this->emit('createSweetAlert', true);
        }
    }

    public function showFormCreateLaporanPerkara($id)
    {
        try {
            $idLaporanPerkara = $id != null ? Crypt::decrypt($id) : $id;
            $this->createdLaporanPerkara = true;
            $this->emit('showFormCreateLaporanPerkara', true);
            $this->selectedLaporanPerkaraId = $idLaporanPerkara;
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function deleteLaporanPerkara($params)
    {
        try {
            $idLaporanPerkara = Crypt::decrypt($params);
            $laporanPerkara = Perkara::find($idLaporanPerkara);
            $laporanPerkara->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function indexLaporanPerkara($params)
    {
        $this->createdLaporanPerkara = false;
    }

    public function showDetail($id)
    {
        try {
            $idLaporanPerkara = Crypt::decrypt($id);
            $this->createdLaporanPerkara = true;
            $this->emit('showFormCreateLaporanPerkara', true);
            $data = [
                'id' => $idLaporanPerkara,
                'show' => true,
            ];

            $this->selectedLaporanPerkaraId = $data;
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $laporanPerkara = Perkara::orderBy('updated_at', 'desc')
            ->where('no_lp', 'like', "%$this->query%")
            ->orWhere('status', 'like', "%$this->query%")
            ->paginate($this->perPage);

        $this->page > $laporanPerkara->lastPage() ? $this->page = $laporanPerkara->lastPage() : true;

        $count = $laporanPerkara->count();

        $limit = $laporanPerkara->perPage();
        $page = $laporanPerkara->currentPage();
        $total = $laporanPerkara->total();

        $upper = min($total, $page * $limit);
        if ($count == 0) {
            $lower = 0;
        } else {
            $lower = ($page - 1) * $limit + 1;
        }
        $paginate_content = "Showing $lower to $upper of $total";

        return view('livewire.kepolisian.laporan-perkara.laporan-perkara-modal', compact('laporanPerkara', 'paginate_content'));
    }
}
