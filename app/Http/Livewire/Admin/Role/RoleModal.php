<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class RoleModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $createRole = false;
    public $selectedRoleId = null;
    public $deleteModalRole = false;

    protected $listeners = [
        'roleUpdated',
        'indexRole',
        'deleteRole',
    ];

    public function roleUpdated($status) {
      // notification sweet alert show
      $this->createRole = false;
      if ($status) {
          $this->emit('updateSweetAlert', true);
      }else{
          $this->emit('createSweetAlert', true);
      }
    }

    public function showFormCreateRole($id) {
        $this->createRole = true;
        $this->emit('showFormCreateRole', true);
        $this->selectedRoleId = $id;
    }

    public function deleteRole($params) {
        $role = Role::find($params);
        $permissionNames = $role->getPermissionNames();
        $role->revokePermissionTo($permissionNames);
        $role->delete();
    }

    public function indexRole($params) {
      $this->createRole = false;
    }

    public function render()
    {
      $roles = Role::orderBy('created_at', 'desc')
        ->where('name', 'like', "%$this->query%")
        ->paginate($this->perPage);

      $this->page > $roles->lastPage() ? $this->page = $roles->lastPage() : true;

      $count  = $roles->count();

      // for calculate the current display of paginated content
      $limit  = $roles->perPage();
      $page   = $roles->currentPage();
      $total  = $roles->total();

      $upper = min( $total, $page * $limit);
      if($count == 0){
          $lower = 0;
      }else{
          $lower = ($page - 1) * $limit + 1;
      }
      $paginate_content = "Showing $lower to $upper of $total";

      return view('livewire.admin.role.role-modal', compact('roles', 'paginate_content'));
    }
}
