<?php

namespace App\Http\Livewire\Admin\User;

use App\User;
use App\Akses;
use App\Constant;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\Admin\PangkatRepository;

class UserModal extends Component
{
  use WithPagination;
  public $query = '';
  public $perPage = 25;
  public $deleteModalUser = false;
  public $tgl_lahir;
  public $role, $user, $akses, $kategori_bagian_id, $typeLembaga;
  public $is_direktorat = false;
  public $is_sat_polres = false;

  protected $listeners = [
    'userUpdated',
    'indexUser',
    'deleteUser',
  ];

  public function mount()
  {
    $this->role = thisRole(); // role login
    $this->user = thisUser(); // user login
    $this->akses = thisAksesFirst(); // user login
    $this->typeLembaga = findTypeLembagaByAkses();

    if ($this->role == Constant::ADMIN_KEPOLISIAN || $this->role == Constant::ADMIN_KEJAKSAAN) {
      $this->kategori_bagian_id = $this->akses->kategori_bagian_id;
    }

    if ($this->typeLembaga == Constant::DIREKTORAT_POLDA) {
      $this->is_direktorat = true;
    }

    if ($this->typeLembaga == Constant::SATUAN_POLRES) {
      $this->is_sat_polres = true;
    }
  }

  public function deleteUser($params)
  {
    DB::beginTransaction();
    try {
      $user = User::find($params);
      if ($user) {
        if (!$user->roles->isEmpty()) {
          $user->removeRole($user->roles->pluck('name')[0]);
        }

        $akses = Akses::where('user_id', $user->id)->first();

        $akses->delete();
        $user->delete();
      }

      DB::commit();
    } catch (\Throwable $th) {
      DB::rollBack();
      dd($th->getMessage());
    }
  }

  public function render()
  {
    $query = $this->query;
    $kategori_bagian_id = $this->kategori_bagian_id;
    $user = $this->user;

    $users = (new UserRepository())->index($query, $this->role, $kategori_bagian_id, $user)->paginate($this->perPage);
    $this->page > $users->lastPage() ? $this->page = $users->lastPage() : true;
    $paginate_content = (new PangkatRepository)->paginateContent($users);
    return view('livewire.admin.user.user-modal', compact('users', 'paginate_content'));
  }
}
