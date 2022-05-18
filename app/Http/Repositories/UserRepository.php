<?php

namespace App\Http\Repositories;

use App\User;
use App\Akses;
use App\Constant;
use App\MSubdit;
use App\Penyidik;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function index($query, $role, $kategori_bagian_id = null, $user = null)
    {
        return User::with([
            'penyidik.subDit',
            'akses.satker',
        ])->when($role == Constant::ADMIN_KEPOLISIAN || $role == Constant::ADMIN_KEJAKSAAN, function ($q) use ($kategori_bagian_id, $user) {
            $q->whereHas('akses', function ($query) use ($kategori_bagian_id, $user) {
                $query->where('kategori_bagian_id', $kategori_bagian_id)
                    ->where('user_id', '!=', $user->id);
            });
        })->where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })->orderBy('created_at', 'desc');
    }

    public function dataPenyidik($user_id)
    {
        return Penyidik::select([
            'id',
            'user_id',
            'nrp',
            'name',
            'pangkat_id',
            'subdit_id',
        ])->where('user_id', $user_id)->first();
    }

    public function dataSatuanKerja($user_id)
    {
        return Akses::with(['satker'])->where('user_id', $user_id)->first();
    }

    public function listDirektoratPolda()
    {
        return MSubdit::orderBy('name', 'asc')->where('type', '!=', Constant::SUBDIT_POLRES)->get();
    }

    public function listDirektoratPolres()
    {
        return MSubdit::orderBy('name', 'asc')->where('type', Constant::SUBDIT_POLRES)->get();
    }

    public function listDirektoratWithParam($no_urut)
    {
        $type = '';
        $field = 'type';

        if ($no_urut == '08') { // sat spkt
            $field = 'name';
            $type = '';
        }

        if ($no_urut == '10') { // Sat Reskrim
            $field = 'name';
            $type = 'Sat Reskrim';
        }

        if ($no_urut == '11') { // Sat Narkoba
            $field = 'name';
            $type = 'Sat Narkoba';
        }

        if ($no_urut == '14') { // Sat Lantas
            $field = 'name';
            $type = 'Sat Narkoba';
        }

        if ($no_urut == '15') { // reskrimum
            $type = 'reskrimum';
        }

        if ($no_urut == '16') { // reskrimsus
            $type = 'reskrimsus';
        }

        if ($no_urut == '17') { // narkoba
            $type = 'narkoba';
        }

        if ($no_urut == '20') { // ditlantas
            $type = '';
        }

        if ($no_urut == '21') { // polair
            $type = 'polair';
        }

        if ($no_urut == '22') { // samapta
            $type = 'samapta';
        }

        return MSubdit::orderBy('name', 'asc')
            ->where($field, $type)
            ->get();
    }

    public function listRoleKejati($type = null)
    {
        $arrRole = [
            'operator-01',
            'operator-02',
            'operator-03',
            'operator-04',
            'kejaksaan',
        ];
        if ($type == Constant::ROLE_KEJAKSAAN) {
            return Role::where('name', '=', Constant::ROLE_KEJAKSAAN)->get();
        } else {
            return Role::whereIn('name', $arrRole)->where('name', '!=', Constant::ROLE_KEJAKSAAN)->get();
        }
    }

    public function listRoleKejari($type = null)
    {
        $arrRole = [
            'operator-kasi-pidum',
            'operator-kasi-pidsus',
            'kejaksaan',
        ];
        if ($type == Constant::ROLE_KEJAKSAAN) {
            return Role::where('name', '=', Constant::ROLE_KEJAKSAAN)->get();
        } else {
            return Role::whereIn('name', $arrRole)->where('name', '!=', Constant::ROLE_KEJAKSAAN)->get();
        }
    }
}
