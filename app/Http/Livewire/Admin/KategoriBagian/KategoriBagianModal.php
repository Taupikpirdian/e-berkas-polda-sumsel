<?php

namespace App\Http\Livewire\Admin\KategoriBagian;

use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\InstansiRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;

class KategoriBagianModal extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $query = '';
    public $arrKategoriBagian = [];

    public function mount()
    {
        $this->arrKategoriBagian = [Constant::N_KEPOLISIAN];
    }

    protected $listeners = [
        'deleteKategoriBagian',
    ];

    public function deleteKategoriBagian($params)
    {
        try {
            $id = Crypt::decrypt($params);
            $data = (new KategoriBagianRepository)->getKategoriBagianById($id);
            $data_akses = (new KategoriBagianRepository)->getAksesKategoriBagian($id);
            // delete akses by kategori id 
            foreach ($data_akses as $data_aksess) {
                $data_aksess->delete();
            }
            // delete data kategori bagian 
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $kategoriBagian = (new KategoriBagianRepository)->listKategoriBagian($this->arrKategoriBagian, $this->query)->paginate($this->perPage);
        $this->page > $kategoriBagian->lastPage() ? $this->page = $kategoriBagian->lastPage() : true;
        $paginate_content = (new InstansiRepository)->paginateContent($kategoriBagian);

        return view('livewire.admin.kategori-bagian.kategori-bagian-modal', compact('kategoriBagian', 'paginate_content'));
    }
}
