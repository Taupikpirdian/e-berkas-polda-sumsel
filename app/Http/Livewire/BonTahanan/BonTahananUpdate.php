<?php

namespace App\Http\Livewire\BonTahanan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Repositories\LapasRepository;
use App\Http\Repositories\Admin\PangkatRepository;

class BonTahananUpdate extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $query = '';
    public $role, $user;
    public $lapasDatas;
    public $lapas_id;
    public $selectTahanan = false;
    public $perPage = 25;

    // data tahanan
    public $tahanan_id,
        $no_reg_instansi,
        $name,
        $alamat,
        $tempat_lahir,
        $tanggal_lahir,
        $tanggal_ekspirasi,
        $tanggal_bebas,
        $keterangan;

    public $file;

    public function mount()
    {
        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login

        $this->lapasDatas = (new LapasRepository())->listLapas();
    }

    public function selectData($id)
    {
        // clear data
        $this->tahanan_id = '';
        $this->no_reg_instansi = '';
        $this->name = '';
        $this->alamat = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->tanggal_ekspirasi = '';
        $this->tanggal_bebas = '';
        $this->keterangan = '';

        $this->selectTahanan = true;
        $tahanan = (new LapasRepository())->tahananById($id)->first();

        $this->tahanan_id = $id;
        $this->no_reg_instansi = $tahanan->no_reg_instansi;
        $this->name = $tahanan->name;
        $this->alamat = $tahanan->alamat;
        $this->tempat_lahir = $tahanan->tempat_lahir;
        $this->tanggal_lahir = $tahanan->tanggal_lahir;
        $this->tanggal_ekspirasi = $tahanan->tanggal_ekspirasi;
        $this->tanggal_bebas = $tahanan->tanggal_bebas;
        $this->keterangan = $tahanan->keterangan;
    }

    public function render()
    {
        $dataTahanan = (new LapasRepository())->getTahananByLapasId($this->lapas_id, $this->query)->paginate($this->perPage);
        $paginate_content = (new PangkatRepository)->paginateContent($dataTahanan);

        $this->emit('refreshJs');

        return view('livewire.bon-tahanan.bon-tahanan-update', compact('dataTahanan', 'paginate_content'));
    }
}
