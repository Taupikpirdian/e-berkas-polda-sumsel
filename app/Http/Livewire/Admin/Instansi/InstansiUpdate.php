<?php

namespace App\Http\Livewire\Admin\Instansi;

use App\Instansi;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\InstansiRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class InstansiUpdate extends Component
{
    public $uid = null,
    $name, $breadcrumb, $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->codeFile = null;
            if ($id) {
                $idInstansi = Crypt::decrypt($id);
                $this->data = (new InstansiRepository)->getInstansiById($idInstansi);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
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
                'name' => 'required',
            ]);

            Instansi::create([
                'name' => $this->name,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/instansi'
            ];
            $this->emit('sweetAlert', $param);
        } else {

            $this->validate([
                'name' => 'required',
            ]);

            $this->data->name = $this->name;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/instansi'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
    }

    public function render()
    {
        return view('livewire.admin.instansi.instansi-update');
    }
}
