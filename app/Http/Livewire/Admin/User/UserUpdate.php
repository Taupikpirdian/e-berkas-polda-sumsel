<?php

namespace App\Http\Livewire\Admin\User;

use App\User;
use App\Akses;
use App\Constant;
use App\Instansi;
use Livewire\Component;
use App\JaksaPenuntutUmum;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\Admin\PejabatRepository;
use App\Http\Repositories\Admin\JaksaPenuntutUmumRepository;
use App\Penyidik;

class UserUpdate extends Component
{
    public $uid = null,
        $breadcrumb,
        $roles,
        $user,
        $password,
        $password_confirmation,
        $email,
        $role_name,
        $instansis,
        $instansi_id,
        $name;

    public $akses, $kategori_bagian_id;
    public $is_update = false, $assignRoleForUser;
    public $is_hide = false;
    public $is_admin_kejaksaan = false;
    public $is_admin_kepolisian = false;
    public $is_direktorat = false;
    public $is_sat_polres = false;
    public $is_admin_master = false;
    public $nip, $pangkat_id, $pangkat_data;
    public $typeLembaga, $direktorats, $subdit_id, $nrp, $type, $codeSatker;

    public function mount($id = null)
    {
        $this->breadcrumb = "Tambah User";

        $this->role = thisRole(); // role login
        $this->user = thisUser(); // user login
        $this->akses = thisAksesFirst(); // user login
        $this->typeLembaga = findTypeLembagaByAkses();
        $this->codeSatker = findKodeSatker();

        if ($this->typeLembaga == Constant::SATUAN_POLRES) {
            $this->is_sat_polres = true;
            $no_urut = substr($this->codeSatker, -2);
            $this->direktorats = (new UserRepository())->listDirektoratWithParam($no_urut);
        }

        if ($this->typeLembaga == Constant::DIREKTORAT_POLDA) {
            $this->is_direktorat = true;
            $no_urut = substr($this->codeSatker, -2);

            $this->direktorats = (new UserRepository())->listDirektoratWithParam($no_urut);
        }

        if ($this->role == Constant::ADMIN_KEPOLISIAN) {
            $this->kategori_bagian_id = $this->akses->kategori_bagian_id;
            $this->assignRoleForUser = Constant::ROLE_KEPOLISIAN;
            $this->is_admin_kepolisian = true;
            $this->pangkat_data = (new PejabatRepository)->masterPangkatKepolisian();
        } else if ($this->role == Constant::ADMIN_KEJAKSAAN) {
            $this->kategori_bagian_id = $this->akses->kategori_bagian_id;
            $this->assignRoleForUser = Constant::ROLE_KEJAKSAAN;
            $this->pangkat_data = (new PejabatRepository)->masterPangkatKejaksaan();
            $this->is_admin_kejaksaan = true;
            if ($this->typeLembaga == Constant::KEJATI) {
                $this->roles = (new UserRepository)->listRoleKejati();
            } else if ($this->typeLembaga == Constant::KEJARI) {
                $this->roles = (new UserRepository)->listRoleKejari();
            } else {
                $this->roles = [];
            }
        } else {
            $this->roles = Role::select('name', 'id')->get();
            $this->instansis = Instansi::select('name', 'id')->get();
            $this->is_admin_master = true;
        }

        if ($id) {
            $this->uid =  Crypt::decrypt($id);
        }

        $this->user = User::find($this->uid);
        if ($this->user) {
            $this->is_update = true;
            $this->breadcrumb = "Edit User";
            $this->uid = $this->user->id;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role_name = $this->user->roles->pluck('name');
            $this->instansi_id = $this->user->instansi_id;

            if ($this->role == Constant::ADMIN_KEPOLISIAN) {
                $penyidik = (new UserRepository())->dataPenyidik($this->uid);
                if ($penyidik) {
                    $this->nrp = $penyidik->nrp;
                    $this->pangkat_id = $penyidik->pangkat_id;
                    $this->subdit_id = $penyidik->subdit_id;
                }
            } else if ($this->role == Constant::ADMIN_KEJAKSAAN) {
                if ($this->role_name == Constant::ROLE_KEJAKSAAN) {
                    $this->type = Constant::ROLE_KEJAKSAAN;
                } else {
                    $this->type = 'operator';
                }
                $jpu = (new JaksaPenuntutUmumRepository())->getJaksaPenuntutUmumByUserId($this->uid);

                if ($jpu) {
                    $this->nip = $jpu->nip;
                    $this->pangkat_id = $jpu->pangkat_id;
                }
            } else {
            }
        }
    }

    protected $listeners = [
        'store',
    ];

    public function validatePolda()
    {
        $this->validate(
            [
                'name' => 'required',
                'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/|unique:users,email,' . $this->uid,
                'nrp' => 'required',
                'pangkat_id' => 'required',
            ],
            [
                'name.required' => 'Data ini tidak boleh kosong',
                'email.unique' => 'Email sudah digunakan',
                'email.required' => 'Data ini tidak boleh kosong',
                'nrp.required' => 'Data ini tidak boleh kosong',
                'pangkat_id.required' => 'Data ini tidak boleh kosong',
            ]
        );

        if ($this->user) {
            if ($this->password) {
                $this->validate([
                    'password'  => 'min:6|confirmed',
                ]);
            }
        } else {
            $this->validate(
                [
                    'password'  => 'required|min:6|confirmed',
                ],
                [
                    'password.confirmed' => 'Password tidak sama',
                ]
            );
        }

        // store data
        $this->emit('confirmSubmit');
    }

    public function validateDitPolda()
    {
        $this->validate(
            [
                'name' => 'required',
                'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/|unique:users,email,' . $this->uid,
                'nrp' => 'required',
                'pangkat_id' => 'required',
                'subdit_id' => 'required',
            ],
            [
                'name.required' => 'Data ini tidak boleh kosong',
                'email.unique' => 'Email sudah digunakan',
                'email.required' => 'Data ini tidak boleh kosong',
                'nrp.required' => 'Data ini tidak boleh kosong',
                'pangkat_id.required' => 'Data ini tidak boleh kosong',
                'subdit_id.required' => 'Data ini tidak boleh kosong',
            ]
        );

        if ($this->user) {
            if ($this->password) {
                $this->validate([
                    'password'  => 'min:6|confirmed',
                ]);
            }
        } else {
            $this->validate(
                [
                    'password'  => 'required|min:6|confirmed',
                ],
                [
                    'password.confirmed' => 'Password tidak sama',
                ]
            );
        }

        // store data
        $this->emit('confirmSubmit');
    }

    public function validasiKejaksaan()
    {
        $this->validate(
            [
                'type' => 'required',
                'name' => 'required',
                'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/|unique:users,email,' . $this->uid,
                'role_name' => 'required',
            ],
            [
                'type.required' => 'Data ini tidak boleh kosong',
                'name.required' => 'Data ini tidak boleh kosong',
                'email.unique' => 'Email sudah digunakan',
                'email.required' => 'Data ini tidak boleh kosong',
                'role_name.required' => 'Data ini tidak boleh kosong',
            ]
        );

        if ($this->type == Constant::ROLE_KEJAKSAAN) {
            $this->validate(
                [
                    'nip' => 'required',
                    'pangkat_id' => 'required',
                ],
                [
                    'nip.required' => 'Data ini tidak boleh kosong',
                    'pangkat_id.required' => 'Data ini tidak boleh kosong',
                ]
            );
        }

        if ($this->user) {
            if ($this->password) {
                $this->validate([
                    'password'  => 'min:6|confirmed',
                ]);
            }
        } else {
            $this->validate(
                [
                    'password'  => 'required|min:6|confirmed',
                ],
                [
                    'password.confirmed' => 'Password tidak sama',
                ]
            );
        }

        // store data
        $this->emit('confirmSubmit');
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $createUser = User::updateOrCreate(
                [
                    'id' => $this->uid,
                ],
                [
                    'name'  => $this->name,
                    'email'  => $this->email,
                    'instansi_id' => $this->instansi_id,
                    'password' => Hash::make($this->password),
                ]
            );

            // remove role
            if ($this->is_update == true) {
                $this->user->removeRole($this->user->roles->pluck('name')[0]);
            }

            // assign role
            if ($this->role == Constant::ADMIN_KEPOLISIAN) {
                $createUser->assignRole($this->assignRoleForUser);
            } else {
                $createUser->assignRole($this->role_name);
            }

            // create profil kejaksaan
            if ($this->role == Constant::ADMIN_KEJAKSAAN && $this->type == Constant::ROLE_KEJAKSAAN) {
                JaksaPenuntutUmum::updateOrCreate(
                    [
                        'user_id' => $createUser->id,
                    ],
                    [
                        'nip'  => $this->nip,
                        'name'  => $this->name,
                        'pangkat_id'  => $this->pangkat_id,
                        'status'  => 1,
                    ]
                );
            }

            // create profil penyidik
            if ($this->role == Constant::ADMIN_KEPOLISIAN) {
                Penyidik::updateOrCreate(
                    [
                        'user_id' => $createUser->id,
                    ],
                    [
                        'nrp'  => $this->nrp,
                        'name'  => $this->name,
                        'pangkat_id'  => $this->pangkat_id,
                        'subdit_id'  => $this->subdit_id,
                    ]
                );
            }

            // assign akses
            Akses::updateOrCreate(
                [
                    'user_id' => $createUser->id,
                ],
                [
                    'kategori_bagian_id'  => $this->kategori_bagian_id,
                ]
            );

            DB::commit();
            return redirect()->to('/users')->with(['success' => 'Data Berhasil Dibuat']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        // $this->emit('select2Trigger', true);
        if ($this->role == Constant::ADMIN_KEJAKSAAN) {
            if ($this->typeLembaga == Constant::KEJATI) {
                $this->roles = (new UserRepository)->listRoleKejati($this->type);
            } else if ($this->typeLembaga == Constant::KEJARI) {
                $this->roles = (new UserRepository)->listRoleKejari($this->type);
            } else {
                $this->roles = [];
            }
        }
        return view('livewire.admin.user.user-update');
    }
}
