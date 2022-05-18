<?php

namespace App\Http\Livewire\Admin\PengadilanNegeri;

use App\Constant;
use App\KategoriBagian;
use Livewire\Component;
use App\PengadilanNegeri;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;
use App\Http\Repositories\Admin\PengadilanNegeriRepository;

class PengadilanNegeriUpdate extends Component
{
    public $uid = null,
        $name, $breadcrumb, $data, $wilayah_hukum;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->codeFile = null;
            if ($id) {
                $idPengadilanNegeri = Crypt::decrypt($id);
                $this->data = (new KategoriBagianRepository)->getKategoriBagianById($idPengadilanNegeri);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
                    $this->wilayah_hukum = $this->data->alamat;
                }
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addData()
    {
        if (!$this->data) {
            $this->validate([
                'name' => 'required|unique:kategori_bagians,name',
                'wilayah_hukum' => 'required'
            ]);

            KategoriBagian::create([
                'kategori_id' => Constant::N_PENGADILAN,
                'name' => $this->name,
                'alamat' => $this->wilayah_hukum
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/pengadilan-negeri'
            ];
            $this->emit('sweetAlert', $param);
        } else {

            $this->validate([
                'name' => 'required|unique:kategori_bagians,name,' . $this->data->id . ',id',
                'wilayah_hukum' => 'required'
            ]);

            $this->data->name = $this->name;
            $this->data->alamat = $this->wilayah_hukum;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/pengadilan-negeri'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
        $this->wilayah_hukum = '';
    }

    public function render()
    {
        return view('livewire.admin.pengadilan-negeri.pengadilan-negeri-update');
    }
}
