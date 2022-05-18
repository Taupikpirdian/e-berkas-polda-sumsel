<?php

namespace App\Http\Livewire\Kepolisian\BarangBuktiNarkotika;

use App\Http\Repositories\BarangBuktiNarkotikaRepository;
use App\Http\Repositories\ComponentRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Component;
use Livewire\WithPagination;

class BarangBuktiNarkotikaModal extends Component
{
    use WithPagination;

    public $query;
    public $perPage = 25;
    public $page = 1;
    public $role, $user, $kategoriBagianId;

    public function mount()
    {
        /**
         * role:
         * kepolisian, admin-kejaksaan, kejaksaan, pengadilan, admin-master
         */
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->kategoriBagianId = thisAksesFirst() ? thisAksesFirst()->kategori_bagian_id : null;
    }

    protected $listeners = [
        'deleteBarangBuktiNarkotika',
    ];

    public function deleteBarangBuktiNarkotika($params)
    {
        try {
            $id = helperDecrypt($params);
            $data = (new BarangBuktiNarkotikaRepository)->listBarangBuktiNarkotikaById($id);
            $data_file = (new BarangBuktiNarkotikaRepository)->fileBarangBuktiNarkotikaById($id);

            $data->delete();
            // file 
            foreach ($data_file as $data) {
                $data->delete();
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listDataBukti = (new BarangBuktiNarkotikaRepository)->listBarangBuktiNarkotika($this->query, $this->role)->paginate($this->perPage);
        $this->page > $listDataBukti->lastPage() ? $this->page = $listDataBukti->lastPage() : true;
        $paginate_content = (new ComponentRepository)->paginateContent($listDataBukti);

        return view('livewire.kepolisian.barang-bukti-narkotika.barang-bukti-narkotika-modal', compact('listDataBukti', 'paginate_content'));
    }
}
