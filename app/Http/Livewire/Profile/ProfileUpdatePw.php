<?php

namespace App\Http\Livewire\Profile;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ProfileUpdatePw extends Component
{
    public $uid, $pin, $old_password, $password, $password_confirmation;

    public function mount($id)
    {
        $this->uid = Crypt::decrypt($id);;
    }

    public function updatePassword()
    {
        $this->validate(
            [
                'pin'  => 'required',
                'old_password'  => 'required',
                'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            ],
            [
                'password.regex' => 'Password minimal 8 karakter terdiri dari huruf dan huruf besar dan angka dan symbol! Contoh: Aaa123!@#',
            ]
        );

        DB::beginTransaction();
        try {
            // data user
            $check_data = User::where(['id' => $this->uid])->first();
            // check PIN
            $check_pin = Hash::check($this->pin, $check_data->pin);
            if (!$check_pin) {
                $params = [
                    'icon'  => 'error',
                    'title' => 'Gagal!',
                    'text'  => 'PIN yang Anda masukan salah!',
                ];
                $this->emit('sweetAlert', $params);
            }
            // check Sandi Sebelumnya
            $check_old_password = Hash::check($this->old_password, $check_data->password);
            if (!$check_old_password) {
                $params = [
                    'icon'  => 'error',
                    'title' => 'Gagal!',
                    'text'  => 'Kata sandi sebelumnya yang Anda masukan salah!',
                ];
                $this->emit('sweetAlert', $params);
            }

            if ($check_data) {
                // Update Password
                $check_data->password = Hash::make($this->password);
                $check_data->change_pw = true;
                $check_data->save();
            }

            $params = [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Kata sandi Anda berhasil diubah!',
                'url'  => '/profiles',
            ];
            $this->emit('sweetAlertRedirect', $params);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profile.profile-update-pw');
    }
}
