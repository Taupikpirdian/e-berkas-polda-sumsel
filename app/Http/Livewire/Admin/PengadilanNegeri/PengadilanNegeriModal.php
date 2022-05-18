<?php

namespace App\Http\Livewire\Admin\PengadilanNegeri;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;
use App\Http\Repositories\Admin\PengadilanNegeriRepository;

class PengadilanNegeriModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $arrKategoriBagian = [];

    public function mount()
    {
        $this->arrKategoriBagian = [Constant::N_PENGADILAN];
    }

    protected $listeners = [
        'deletePengadilanNegeri',
    ];

    public function deletePengadilanNegeri($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new KategoriBagianRepository)->getKategoriBagianById($id);
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listPengadilanNegeri = (new KategoriBagianRepository)->listKategoriBagian($this->arrKategoriBagian, $this->query)->paginate($this->perPage);
        $this->page > $listPengadilanNegeri->lastPage() ? $this->page = $listPengadilanNegeri->lastPage() : true;
        $paginate_content = (new PengadilanNegeriRepository)->paginateContent($listPengadilanNegeri);

        return view('livewire.admin.pengadilan-negeri.pengadilan-negeri-modal', compact('listPengadilanNegeri', 'paginate_content'));
    }
}
