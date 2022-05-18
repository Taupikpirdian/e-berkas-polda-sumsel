@include('include.loading-target')
<form action="#" method="post" wire:submit.prevent="validasiKejaksaan">
    @csrf
    <div class="form-group" wire:ignore>
      <label class="form-label form-label-required">Jenis Akun</label>
      <select wire:model='type' id="type" class="form-control select2-show-search">
          <option value=""> Pilih Jenis Akun</option>
          <option value="kejaksaan">Kejaksaan</option>
          <option value="operator">Operator</option>
      </select>
    </div>
    @error('type')
    <div class="mb-2 text-danger">{{ $message }}</div>
    @enderror

    @if($type)
      @if($type == \App\Constant::ROLE_KEJAKSAAN)
        <div class="form-group">
            <label class="form-label form-label-required">NIP</label>
            <input class="form-control form-control-sm  mb-4" wire:model='nip' placeholder="Masukan nip jaksa" type="text">
            @error('nip')
              <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
          <label class="form-label form-label-required">Pangkat</label>
          <select wire:model='pangkat_id' id="pangkat_id" class="form-control select2-show-search">
              <option value=""> Pilih Pangkat</option>
              @foreach ($pangkat_data as $pangkat_datas)
              <option value="{{ $pangkat_datas->id }}">{{ $pangkat_datas->name }}</option>
              @endforeach
          </select>
          @error('pangkat_id')
          <div class="mt-2 text-danger">{{ $message }}</div>
          @enderror
        </div>
      @endif

      <div class="form-group">
          <label class="form-label form-label-required">Nama</label>
          <input class="form-control form-control-sm  mb-4" wire:model='name' placeholder="Masukan nama user" type="text">
          @error('name')
            <div class="mt-2 text-danger">{{ $message }}</div>
          @enderror
      </div>

      <div class="form-group">
        <label class="form-label form-label-required">Email</label>
        <input class="form-control form-control-sm  mb-4" wire:model='email' placeholder="Masukan email user" type="email">
        @error('email')
          <div class="mt-2 text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label form-label-required">Password</label>
        <input class="form-control form-control-sm  mb-4" wire:model='password' placeholder="Masukan password user" type="password" autocomplete="new-password">
        @error('password')
          <div class="mt-2 text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label form-label-required">Konfirmasi Password</label>
        <input class="form-control form-control-sm  mb-4" wire:model='password_confirmation' placeholder="Masukan konfirmasi password" type="password">
        @error('password_confirmation')
          <div class="mt-2 text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label form-label-required">Role</label>
        <select wire:model='role_name' id="role_name" class="form-control select2-show-search">
          <option value=""> Pilih Role </option>
          @foreach ($roles as $role)
          <option value="{{ $role->name }}">{{ transRoleOperator()[$role->name] }}</option>
          @endforeach
        </select>
        @error('role_name')
          <div class="mt-2 text-danger">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group">
          <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
          <a href="{{ route('users.index') }}" class="btn btn-warning btn-icon text-white">
              <span>
                  <i class="fe fe-log-in"></i>
              </span> Cancel
          </a>
      </div>
    @endif
</form>