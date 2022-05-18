<?php

namespace App\Http\Livewire\Admin\Jabatan;

use App\Jabatan;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\JabatanRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class JabatanUpdate extends Component
{
    public $uid = null,
    $name, $breadcrumb, $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            if ($id) {
                $idPosition = Crypt::decrypt($id);
                $this->data = (new JabatanRepository)->getJabatanById($idPosition);
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
                'name' => 'required|unique:jabatans,name',
            ]);

            Jabatan::create([
                'name' => $this->name,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/jabatan'
            ];
            $this->emit('sweetAlert', $param);
        } else {
            if ($this->data->name != $this->name) {
                $this->validate([
                    'name' => 'required|unique:jabatans,name',
                ]);
            }else{
                $this->validate([
                    'name' => 'required',
                ]);
            }

            $this->data->name = $this->name;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/jabatan'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
    }
    
    public function render()
    {
        return view('livewire.admin.jabatan.jabatan-update');
    }
}
