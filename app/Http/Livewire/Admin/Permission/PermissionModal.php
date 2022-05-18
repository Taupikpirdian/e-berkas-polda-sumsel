<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class PermissionModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $createPermission = false;
    public $selectedPermissionId = null;
    public $deleteModalPermission = false;

    protected $listeners = [
        'permissionUpdated',
        'indexPermission',
        'deletePermission',
    ];

    public function permissionUpdated($status) {
        // notification sweet alert show
        $this->createPermission = false;
        if ($status) {
            $this->emit('updateSweetAlert', true);
        }else{
            $this->emit('createSweetAlert', true);
        }
      }
  
      public function showFormCreatePermission($id) {
          $this->createPermission = true;
          $this->emit('showFormCreatePermission', true);
          $this->selectedPermissionId = $id;
      }
  
      public function deletePermission($params) {
          $permission = Permission::find($params);
          $permission->delete();
      }
  
      public function indexPermission($params) {
        $this->createPermission = false;
      }

    public function render()
    {
        $permissions = Permission::orderBy('created_at', 'desc')
            ->where('name', 'like', "%$this->query%")
            ->paginate($this->perPage);

        $this->page > $permissions->lastPage() ? $this->page = $permissions->lastPage() : true;

        $count  = $permissions->count();

        // for calculate the current display of paginated content
        $limit  = $permissions->perPage();
        $page   = $permissions->currentPage();
        $total  = $permissions->total();

        $upper = min( $total, $page * $limit);
        if($count == 0){
            $lower = 0;
        }else{
            $lower = ($page - 1) * $limit + 1;
        }
        $paginate_content = "Showing $lower to $upper of $total";

        return view('livewire.admin.permission.permission-modal', compact('permissions', 'paginate_content'));
    }
}
