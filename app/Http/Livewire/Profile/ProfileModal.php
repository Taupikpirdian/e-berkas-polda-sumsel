<?php

namespace App\Http\Livewire\Profile;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\PenyidikRepository;
use App\Http\Repositories\DashboardRepository;
use App\Http\Repositories\KejaksaanRepository;

class ProfileModal extends Component
{
  public $createProfile = false;
  public $selectedProfileId = null;
  public $pangkat_id;
  public $uid, $role, $user, $countDataPranut, $penyidik, $jaksa;

  public function mount()
  {
    $this->role = thisRole(); // role login
    $this->user = User::with([
      'akses.satker'
    ])->where('id', Auth::user()->id)
      ->first();

    $this->uid = $this->user->id;
    $this->countDataPranut = (new DashboardRepository)->countDataPranut($this->role, $this->uid);

    $this->penyidik = (new PenyidikRepository)->penyidikByUserId($this->uid);
    $this->jaksa = (new KejaksaanRepository)->userJaksaByUserId($this->uid);
  }

  protected $listeners = [
    'profileUpdated',
    'indexProfile',
  ];

  public function profileUpdated($status)
  {
    // notification sweet alert show
    $this->createProfile = false;
    if ($status) {
      $this->emit('updateSweetAlert', true);
    } else {
      $this->emit('createSweetAlert', true);
    }
  }

  public function showFormCreateProfile($id)
  {
    $this->createProfile = true;
    $this->emit('showFormCreateProfile', true);
    $this->selectedProfileId = $id;
  }

  public function indexProfile($params)
  {
    $this->createProfile = false;
  }

  public function getSelect2($data)
  {
    $this->emit('getSelect2', $data);
  }

  public function render()
  {
    return view('livewire.profile.profile-modal');
  }
}
