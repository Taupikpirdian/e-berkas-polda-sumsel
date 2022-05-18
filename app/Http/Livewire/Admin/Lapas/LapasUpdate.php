<?php

namespace App\Http\Livewire\Admin\Lapas;

use App\RumahTahanan;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\LapasRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class LapasUpdate extends Component
{
    public $uid = null,
    $name, $breadcrumb, $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            if ($id) {
                $idLapas = Crypt::decrypt($id);
                $this->data = (new LapasRepository)->getRumahTahananById($idLapas);

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
                'name' => 'required|unique:rumah_tahanans,name',
            ]);

            RumahTahanan::create([
                'name' => $this->name,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/lapas'
            ];
            $this->emit('sweetAlert', $param);
        } else {
            if ($this->data->name != $this->name) {
                $this->validate([
                    'name' => 'required|unique:rumah_tahanans,name',
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
                'url_redirect' => '/lapas'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
    }
    
    public function render()
    {
        return view('livewire.admin.lapas.lapas-update');
    }
}
