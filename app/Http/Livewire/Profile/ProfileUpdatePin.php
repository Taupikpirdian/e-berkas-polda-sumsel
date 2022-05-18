<?php

namespace App\Http\Livewire\Profile;

use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileUpdatePin extends Component
{
    public $uid, $pin, $old_password, $password, $password_confirmation;

    public function mount($id)
    {
        $this->uid = Crypt::decrypt($id);
    }

    public function updatePin()
    {
        $this->validate([
            'pin' => 'required|min:6',
            'password' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // data user
            $check_data = User::where(['id' => $this->uid])->first();

            // check Sandi Sebelumnya
            $check_password = Hash::check($this->password, $check_data->password);
            if (!$check_password) {
                DB::rollBack();
                $params = [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Kata sandi yang Anda masukan salah!',
                ];
                $this->emit('sweetAlert', $params);
            } else {
                if ($check_data) {
                    // validasi
                    $check_data->pin = Hash::make($this->pin);
                    $check_data->save();
                }

                $params = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Pin Anda berhasil diubah!',
                    'url' => '/profiles',
                ];
                $this->emit('sweetAlertRedirect', $params);

                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profile.profile-update-pin');
    }
}
