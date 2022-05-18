<?php

namespace App\Http\Livewire\Admin\KategoriBagian;

use App\Constant;
use App\Kategori;
use App\KategoriBagian;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\KategoriBagianRepository;


class KategoriBagianUpdateModal extends Component
{
    public $uid = null,
        $name,
        $alamat,
        $email,
        $no_tlp,
        $kategori_data,
        $kategori_id,
        $breadcrumb,
        $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->codeFile = null;
            $this->kategori_data = Kategori::select('name', 'id')->whereIn('id', [Constant::N_KEPOLISIAN])->get();
            if ($id) {
                $idInstansi = Crypt::decrypt($id);
                $this->data = (new KategoriBagianRepository)->getKategoriBagianById($idInstansi);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
                    $this->email = $this->data->email;
                    $this->alamat = $this->data->alamat;
                    $this->no_tlp = $this->data->no_tlp;
                    $this->kategori_id = $this->data->kategori_id;
                }
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addData()
    {
        if (!$this->data) {
            if ($this->email) {
                $this->validate([
                    'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/',
                ]);
            }
            $this->validate([
                'name' => 'required',
                'kategori_id' => 'required',
            ]);

            KategoriBagian::create([
                'name' => $this->name,
                'kategori_id' => $this->kategori_id,
                'email' => $this->email,
                'alamat' => $this->alamat,
                'no_tlp' => $this->no_tlp,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/kategori-bagian'
            ];
            $this->emit('sweetAlert', $param);
        } else {
            if ($this->email) {
                $this->validate([
                    'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/',
                ]);
            }
            $this->validate([
                'name' => 'required',
                'kategori_id' => 'required',
            ]);

            $this->data->name = $this->name;
            $this->data->kategori_id = $this->kategori_id;
            $this->data->email = $this->email;
            $this->data->alamat = $this->alamat;
            $this->data->no_tlp = $this->no_tlp;
            $this->data->save();

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/kategori-bagian'
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
        $this->email = '';
        $this->alamat = '';
        $this->no_tlp = '';
        $this->kategori_id = '';
    }

    public function render()
    {
        return view('livewire.admin.kategori-bagian.kategori-bagian-update-modal');
    }
}
