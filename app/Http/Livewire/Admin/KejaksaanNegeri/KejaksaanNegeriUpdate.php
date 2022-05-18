<?php

namespace App\Http\Livewire\Admin\KejaksaanNegeri;

use App\Constant;
use App\KategoriBagian;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;

class KejaksaanNegeriUpdate extends Component
{
    public $uid = null,
        $name, $breadcrumb, $data, $alamat;

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
                    $this->alamat = $this->data->alamat;
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
                'alamat' => 'required'
            ]);

            KategoriBagian::create([
                'kategori_id' => Constant::N_KEJAKSAAN,
                'name' => $this->name,
                'alamat' => $this->alamat
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/kejaksaan-negeri'
            ];
            $this->emit('sweetAlert', $param);
        } else {

            $this->validate([
                'name' => 'required|unique:kategori_bagians,name,' . $this->data->id . ',id',
                'alamat' => 'required'
            ]);

            $this->data->name = $this->name;
            $this->data->alamat = $this->alamat;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/kejaksaan-negeri'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
        $this->alamat = '';
    }

    public function render()
    {
        return view('livewire.admin.kejaksaan-negeri.kejaksaan-negeri-update');
    }
}
