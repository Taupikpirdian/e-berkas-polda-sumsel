<?php

namespace App\Http\Livewire\Admin\KejaksaanNegeri;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;
use App\Http\Repositories\Admin\PengadilanNegeriRepository;

class KejaksaanNegeriModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $arrKategoriBagian = [];

    public function mount()
    {
        $this->arrKategoriBagian = [Constant::N_KEJAKSAAN];
    }

    protected $listeners = [
        'deleteKejaksaanNegeri',
    ];

    public function deleteKejaksaanNegeri($params)
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
        $datas = (new KategoriBagianRepository)->listKategoriBagian($this->arrKategoriBagian, $this->query)->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        $paginate_content = (new PengadilanNegeriRepository)->paginateContent($datas);

        return view('livewire.admin.kejaksaan-negeri.kejaksaan-negeri-modal', compact('datas', 'paginate_content'));
    }
}
