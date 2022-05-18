<?php

namespace App\Http\Livewire\Profile;

use id;
use App\User;
use App\Constant;
use App\Penyidik;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\PenyidikRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\Admin\PejabatRepository;
use App\JaksaPenuntutUmum;

class ProfileUpdate extends Component
{
    public $uid = null,
        $pin,
        $old_password,
        $password,
        $password_confirmation,
        $phone,
        $email,
        $name;

    public $nip, $nrp, $nama_lengkap, $pangkat_id, $pangkats, $role, $penyidik, $jaksa;

    public function mount($id)
    {
        $this->role = thisRole(); // role login
        $this->uid = Crypt::decrypt($id);
        $this->user = User::find($this->uid);
        if ($this->role == Constant::ROLE_KEPOLISIAN) {
            $this->pangkats = (new PejabatRepository)->masterPangkatKepolisian();
            $this->penyidik = (new PenyidikRepository)->penyidikByUserId($this->uid);
        } else {
            $this->pangkats = (new PejabatRepository)->masterPangkatKejaksaan();
            $this->jaksa = (new KejaksaanRepository)->userJaksaByUserId($this->uid);
        }

        if ($this->user) {
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
        }

        if ($this->penyidik) {
            $this->nrp = $this->penyidik->nrp;
            $this->nama_lengkap = $this->penyidik->name;
            $this->pangkat_id = $this->penyidik->pangkat_id;
        }

        if ($this->jaksa) {
            $this->nip = $this->jaksa->nip;
            $this->nama_lengkap = $this->jaksa->name;
            $this->pangkat_id = $this->jaksa->pangkat_id;
            $this->phone = $this->jaksa->no_tlp;
        }
    }

    public function updateUser()
    {
        $this->validate([
            'name'  => 'required',
            'phone' => 'unique:users,phone,' . $this->uid,
            'nama_lengkap'  => 'required',
            'pangkat_id'  => 'required',
        ]);

        if ($this->role == Constant::ROLE_KEPOLISIAN) {
            $this->validate([
                'nrp'  => 'required',
            ]);
        }

        if ($this->role == Constant::ROLE_KEJAKSAAN) {
            $this->validate([
                'nip'  => 'required',
            ]);
        }

        DB::beginTransaction();
        try {
            User::updateOrCreate(
                [
                    'id'   => $this->uid,
                ],
                [
                    'name' => $this->name,
                    'phone' => $this->phone,
                ]
            );

            if ($this->role == Constant::ROLE_KEPOLISIAN) {
                Penyidik::updateOrCreate(
                    [
                        'user_id'   => $this->uid,
                    ],
                    [
                        'nrp' => $this->nrp,
                        'name' => $this->nama_lengkap,
                        'pangkat_id' => $this->pangkat_id,
                    ]
                );
            }

            if ($this->role == Constant::ROLE_KEJAKSAAN) {
                JaksaPenuntutUmum::updateOrCreate(
                    [
                        'user_id'   => $this->uid,
                    ],
                    [
                        'nip' => $this->nip,
                        'name' => $this->nama_lengkap,
                        'pangkat_id' => $this->pangkat_id,
                        'no_tlp' => $this->phone,
                    ]
                );
            }

            DB::commit();
            return redirect()->to('/profiles')->with(['success' => 'Berhasil Update Profil']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profile.profile-update');
    }
}
