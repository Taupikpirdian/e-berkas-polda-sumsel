<?php

namespace App\Http\Livewire\Admin\Pejabat;

use App\Pejabat;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\Admin\PejabatRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class PejabatUpdate extends Component
{
    public $uid = null,
    $breadcrumb, $data, $jabatans, $pangkats;
    public $nip, $name, $pangkat_id, $jabatan_id;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->codeFile = null;
            $this->pangkats = (new PejabatRepository)->masterPangkat();
            $this->jabatans = (new PejabatRepository)->masterJabatan();

            if ($id) {
                $idInstansi = Crypt::decrypt($id);
                $this->data = (new PejabatRepository)->getPejabatById($idInstansi);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
                    $this->nip = $this->data->nip;
                    $this->pangkat_id = $this->data->pangkat_id;
                    $this->jabatan_id = $this->data->jabatan_id;
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
                'nip' => 'required|unique:pejabats,nip',
                'name' => 'required',
                'pangkat_id' => 'required',
                'jabatan_id' => 'required',
            ]);

            Pejabat::create([
                'nip' => $this->nip,
                'name' => $this->name,
                'pangkat_id' => $this->pangkat_id,
                'jabatan_id' => $this->jabatan_id,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/pejabat'
            ];
            $this->emit('sweetAlert', $param);
        } else {
            if ($this->data->name != $this->name) {
                $this->validate([
                    'nip' => 'required|unique:pejabats,nip',
                    'name' => 'required',
                    'pangkat_id' => 'required',
                    'jabatan_id' => 'required',
                ]);
            }else{
                $this->validate([
                    'nip' => 'required',
                    'name' => 'required',
                    'pangkat_id' => 'required',
                    'jabatan_id' => 'required',
                ]);
            }

            $this->data->nip = $this->nip;
            $this->data->name = $this->name;
            $this->data->pangkat_id = $this->pangkat_id;
            $this->data->jabatan_id = $this->jabatan_id;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/pejabat'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->nip = '';
        $this->name = '';
        $this->pangkat_id = '';
        $this->jabatan_id = '';
    }

    public function render()
    {
        return view('livewire.admin.pejabat.pejabat-update');
    }
}
