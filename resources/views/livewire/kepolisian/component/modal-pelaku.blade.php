<div wire:ignore.self class="modal fade" id="scrollingmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Tambah Tersangka</h5>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="bottom: 15px">
                    <div class="form-group">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-custom" wire:model='nik' placeholder="Masukan NIK Tersangka">
                        @error('nik')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label form-label-required">Nama Tersangka</label>
                        <input type="text" class="form-custom" wire:model='nama_tersangka' placeholder="Masukan Nama">
                        @error('nama_tersangka')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-custom" wire:model='tempat_lahir' placeholder="Masukan Tempat Lahir">
                        @error('tempat_lahir')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="date" class="form-custom" id="tanggal_lahir" wire:model='tanggal_lahir'>
                        </div>
                        @error('tempat_lahir')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control select2-show-search" wire:model='jenis_kelamin' id="jenis_kelamin" data-placeholder="Pilih Jenis Kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="form-label">Kebangsaan</label>
                        <select class="form-control select2-show-search" wire:model='kebangsaan' id="kebangsaan" data-placeholder="Pilih Kebangsaan">
                            <option value="">Pilih Kebangsaan</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                        @error('kebangsaan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea type="text" class="form-custom mb-2" wire:model='alamat' placeholder="Masukan Alamat"></textarea>
                        @error('alamat')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="form-label">Agama</label>
                        <select class="form-control select2-show-search" wire:model='agama' id="agama" data-placeholder="Pilih Agama">
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('agama')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" class="form-custom mb-2" wire:model='pekerjaan' placeholder="Masukan Pekerjaan">
                        @error('pekerjaan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="form-label">Pendidikan</label>
                        <select class="form-control select2-show-search" wire:model='pendidikan' id="pendidikan" data-placeholder="Pilih Pendidikan">
                            <option value="">Pilih Pendidikan</option>
                            <option value="S3">S3</option>
                            <option value="S2">S2</option>
                            <option value="S1">S1</option>
                            <option value="SMA">SMA</option>
                            <option value="SMP">SMP</option>
                            <option value="SD">SD</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('pendidikan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pasal</label>
                        <input type="text" class="form-custom mb-2" wire:model='pasal' placeholder="Masukan Pasal">
                        @error('pasal')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button  class="btn btn-primary" wire:click.prevent="addPelaku()">Save changes</button>
            </div>
        </div>
    </div>
</div>