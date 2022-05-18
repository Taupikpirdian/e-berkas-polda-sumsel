<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleUpdate extends Component
{
    public $uid = null,
    $id_permission = [],
    $role,
    $permissions,
    $breadcrumb,
    $name;

    public function mount($selectedRoleId)
    {
        $this->role         = Role::find($selectedRoleId);
        $this->permissions  = Permission::orderBy('name', 'desc')->get();
        $this->breadcrumb   = "Tambah Role";
        
        if ($this->role) {
            $this->breadcrumb   = "Edit Role";
            $this->uid          = $selectedRoleId;
            $this->name         = $this->role->name;

            // cek data sudah di ckls atau belum
            foreach ($this->permissions as $key => $permission) {
                if($this->role->hasPermissionTo($permission->name)){
                    $permission->status = 1;
                    $this->id_permission[$permission->name] = true;
                }else{
                    $permission->status = 0;
                    $this->id_permission[$permission->name] = false;
                }
            }
        }
    }

    public function addRole()
    {
        if($this->id_permission){
            foreach ($this->id_permission as $key => $value){
                if($value == true){ // filter hanya permission yang di pilih saja
                    $permission[] = $key;
                }else{
                    $permission_uncheck[] = $key;
                }
            }
        }

        if(isset($permission)){
            $check_role = Role::where(['id' => $this->uid])->first();
            if (!$check_role) {
                $role = Role::create(['name' => $this->name]);
                $role->givePermissionTo($permission);
    
                $this->emit('roleUpdated', false);
            }else{
                // validasi
                $this->validate([
                    'name' => 'required|unique:roles,name,' . $this->uid,
                ]);
                // update
                $check_role->name = $this->name;
                $check_role->save();
                $check_role->givePermissionTo($permission);
                $check_role->revokePermissionTo($permission_uncheck);
                $this->emit('roleUpdated', true);
            }
            
            $this->name             = '';
            $this->id_permission    = '';
        }else{
            $this->emit('errorSweetAlert');
            return view('livewire.role.role-update-page');
        }

    }

    public function indexRole()
    {
        $this->emit('indexRole', true);
    }

    public function render()
    {
        return view('livewire.admin.role.role-update');
    }
}
