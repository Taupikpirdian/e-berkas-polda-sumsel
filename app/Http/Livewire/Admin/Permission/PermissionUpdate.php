<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionUpdate extends Component
{
    public $uid = null,
    $breadcrumb,
    $permission,
    $name;

    public function mount($selectedPermissionId)
    {
        $this->permission   = Permission::find($selectedPermissionId);
        $this->breadcrumb   = "Tambah Permission";
        
        if ($this->permission) {
            $this->breadcrumb   = "Edit Permission";
            $this->uid          = $selectedPermissionId;
            $this->name         = $this->permission->name;
        }
    }

    public function addPermission()
    {
        $check_permission = Permission::where(['id' => $this->uid])->first();
        if (!$check_permission) {
            // validasi
            $this->validate([
                'name' => 'required',
            ]);

            Permission::create(['name' => $this->name]);
            $this->emit('permissionUpdated', false);
        }else{
            // validasi
            $this->validate([
                'name' => 'required|unique:permissions,name,' . $this->uid,
            ]);
            // update
            $check_permission->name = $this->name;
            $check_permission->save();
            // update data permission
            $this->emit('permissionUpdated', true);
        }

        
        $this->name             = '';
    }

    public function indexPermission()
    {
        $this->emit('indexPermission', true);
    }

    public function render()
    {
        return view('livewire.admin.permission.permission-update');
    }
}
