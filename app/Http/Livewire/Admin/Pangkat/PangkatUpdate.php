<?php

namespace App\Http\Livewire\Admin\Pangkat;

use App\Pangkat;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\PangkatRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class PangkatUpdate extends Component
{
    public $uid = null,
        $name, $breadcrumb, $data, $role;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->codeFile = null;
            if ($id) {
                $idPangkat = Crypt::decrypt($id);
                $this->data = (new PangkatRepository)->getPangkatById($idPangkat);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
                    $this->role = $this->data->role;
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
                'role' => 'required',
            ]);

            Pangkat::create([
                'name' => $this->name,
                'role' => $this->role,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/pangkat'
            ];
            $this->emit('sweetAlert', $param);
        } else {

            $this->validate([
                'name' => 'required',
                'role' => 'required',
            ]);

            $this->data->name = $this->name;
            $this->data->role = $this->role;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/pangkat'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
    }

    public function render()
    {
        return view('livewire.admin.pangkat.pangkat-update');
    }
}
