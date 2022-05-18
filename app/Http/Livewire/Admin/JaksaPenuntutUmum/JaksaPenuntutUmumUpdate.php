<?php

namespace App\Http\Livewire\Admin\JaksaPenuntutUmum;

use App\User;
use App\Pangkat;
use Livewire\Component;
use App\JaksaPenuntutUmum;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Repositories\Admin\JaksaPenuntutUmumRepository;

class JaksaPenuntutUmumUpdate extends Component
{
    public $uid = null,
    $name,
    $nip,
    $status,
    $no_tlp,
    $pangkat_id,
    $user_id,
    $breadcrumb,
    $pangkat_data,
    $user_data,
    $data;

    public function mount($id = null)
    {
        try {
            $this->breadcrumb = "Tambah";
            $this->pangkat_data = (new JaksaPenuntutUmumRepository)->masterPangkat();
            $this->user_data = User::select([
                'name', 
                'id'
            ])->where('assign_jaksa_id','=',null)
              ->role('kejaksaan')
              ->get();

            if ($id) {
                $idInstansi = Crypt::decrypt($id);
                $this->data = (new JaksaPenuntutUmumRepository)->getJaksaPenuntutUmumById($idInstansi);
                if ($this->data) {
                    $this->user_data = User::select([
                        'name', 
                        'id'
                    ])->where('assign_jaksa_id','=',null)
                      ->orWhere('assign_jaksa_id','=',$this->data->id)
                      ->role('kejaksaan')
                      ->get();
                      
                    $this->breadcrumb = "Edit";
                    $this->uid = $this->data->id;
                    $this->name = $this->data->name;
                    $this->nip = $this->data->nip;
                    $this->status = $this->data->status;
                    $this->no_tlp = $this->data->no_tlp;
                    $this->pangkat_id = $this->data->pangkat_id;
                    $this->user_id = $this->data->user_id;
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
                'pangkat_id' => 'required',
                'nip' => 'required|unique:jaksa_penuntut_umums,nip',
                'user_id' => 'required',
                'status' => 'required|boolean'
            ]);

            $jaksa = JaksaPenuntutUmum::create([
                'name' => $this->name,
                'pangkat_id' => $this->pangkat_id,
                'user_id' => $this->user_id,
                'nip' => $this->nip,
                'status' => $this->status,
                'no_tlp' => $this->no_tlp,
            ]);

            if($jaksa) {
                $user = User::find($this->user_id);
                $user->assign_jaksa_id = $jaksa->id;
                $user->save();
            }

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil tambah data!',
                'url_redirect' => '/jaksa-penuntut-umum',
            ];
            $this->emit('sweetAlert', $param);
        } else {
            $this->validate([
                'name' => 'required',
                'pangkat_id' => 'required',
                'nip' => 'required|unique:jaksa_penuntut_umums,nip,'.$this->data->id.',id',
                'user_id' => 'required',
                'status' => 'required|boolean'
            ]);
            
            // prepared assign jaksa id user old
            $user_old = User::find($this->data->user_id);
            if($user_old){
                $user_old->assign_jaksa_id = null;
                // lama
                $user_old->save();
            }
            
            $this->data->name = $this->name;
            $this->data->pangkat_id = $this->pangkat_id;
            $this->data->user_id = $this->user_id;
            $this->data->nip = $this->nip;
            $this->data->status = $this->status;
            $this->data->no_tlp = $this->no_tlp;
            $updated = $this->data->save();

            if($updated) {
                // baru
                $user = User::find($this->user_id);
                $user->assign_jaksa_id = $this->data->id;
                $user->save();
            }

            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Anda berhasil update data!',
                'url_redirect' => '/jaksa-penuntut-umum',
            ];
            $this->emit('sweetAlert', $param);
        }

        $this->name = '';
        $this->nip = '';
        $this->status = '';
        $this->no_tlp = '';
        $this->pangkat_id = '';
        $this->user_id = '';
    }

    public function render()
    {
        return view('livewire.admin.jaksa-penuntut-umum.jaksa-penuntut-umum-update');
    }
}
