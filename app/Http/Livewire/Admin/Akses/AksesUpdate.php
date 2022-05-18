<?php

namespace App\Http\Livewire\Admin\Akses;

use App\User;
use App\Akses;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\DataMasterRepository;
use App\Http\Repositories\Admin\AksesRepository;
use Illuminate\Contracts\Encryption\DecryptException;

class AksesUpdate extends Component
{
    public $uid = null,
    $kategori_bagian_id,
    $user_id,
    $breadcrumb,
    $satkers,
    $users,
    $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->satkers = (new DataMasterRepository)->masterKategoriBagian();
            $this->users = User::select([
                'name', 
                'id'
            ])->role('kepolisian')
              ->get();

            if ($id) {
                $idAkses = Crypt::decrypt($id);
                $this->data = (new AksesRepository)->getAksesById($idAkses);
                if ($this->data) {
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->user_id = $this->data->user_id;
                    $this->kategori_bagian_id = $this->data->kategori_bagian_id;
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
                'user_id' => 'required',
                'kategori_bagian_id' => 'required',
            ]);

            Akses::create([
                'user_id' => $this->user_id,
                'kategori_bagian_id' => $this->kategori_bagian_id,
            ]);

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/akses',
            ];
            $this->emit('sweetAlert', $param);
        } else {
            $this->validate([
                'user_id' => 'required',
                'kategori_bagian_id' => 'required',
            ]);

            Akses::updateOrCreate([
                'id' => $this->uid,
                'user_id' => $this->user_id
              ],
              [
                'kategori_bagian_id' => $this->kategori_bagian_id
              ]);
            

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/akses',
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->user_id = '';
        $this->kategori_bagian_id = '';
    }

    public function render()
    {
        return view('livewire.admin.akses.akses-update');
    }
}
