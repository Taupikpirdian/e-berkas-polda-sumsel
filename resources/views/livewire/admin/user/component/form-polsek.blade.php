<form action="#" method="post" wire:submit.prevent="validatePolda">
    @csrf
    <div class="form-group">
        <label class="form-label form-label-required">Jenis Akun</label>
        <select class="form-control" disabled="true">
            <option selected>Penyidik Polsek</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label form-label-required">NRP</label>
        <input class="form-control form-control-sm  mb-4" wire:model='nrp' placeholder="Masukan nrp penyidik" type="text">
        @error('nrp')
          <div class="mt-2 text-danger">{{ $message }}</div>
        @enderror
    </div>

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

    <div class="form-group" wire:ignore>
      <label class="form-label form-label-required">Pangkat</label>
      <select wire:model='pangkat_id' id="pangkat_id" class="form-control select2-show-search">
          <option value=""> Pilih Pangkat</option>
          @foreach ($pangkat_data as $pangkat_datas)
          <option value="{{ $pangkat_datas->id }}">{{ $pangkat_datas->name }}</option>
          @endforeach
      </select>
    </div>
    @error('pangkat_id')
    <div class="mb-2 text-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
        <a href="{{ route('users.index') }}" class="btn btn-warning btn-icon text-white">
            <span>
                <i class="fe fe-log-in"></i>
            </span> Cancel
        </a>
    </div>
</form>