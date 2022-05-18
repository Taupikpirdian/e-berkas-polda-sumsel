<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Jaksa Penuntut Umum</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/jaksa-penuntut-umum')}}">Jaksa Penuntut Umum</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $breadcrumb }}</h3>
                </div>
                <div class="card-body pt-2">
                    <form action="#" method="post" wire:submit.prevent="addData">
                        @csrf
                        <div class="form-group">
                            <label class="form-label form-label-required">Nama Jaksa Penuntut Umum</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='name'
                                placeholder="Masukan nama Jaksa Penuntut Umum" type="text">
                            @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">NIP</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='nip'
                                placeholder="Masukan NIP Jaksa Penuntut Umum" type="text"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            @error('nip')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">No Tlp</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='no_tlp'
                                placeholder="Masukan No Tlp Jaksa Penuntut Umum" type="text"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            @error('no_tlp')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Pangkat</label>
                            <select wire:model='pangkat_id' name="pangkat_id" id="pangkat_id" class="form-control select2-show-search" required>
                                <option value=""> Pilih Pangkat</option>
                                @foreach ($pangkat_data as $pangkat_datas)
                                <option value="{{ $pangkat_datas->id }}">{{ $pangkat_datas->name }}</option>
                                @endforeach
                            </select>
                            @error('pangkat_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">User</label>
                            <select wire:model='user_id' name="user_id" id="user_id" class="form-control select2-show-search" required>
                                <option value=""> Pilih User</option>
                                @foreach ($user_data as $user_datas)
                                <option value="{{ $user_datas->id }}">{{ $user_datas->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Status</label>
                            <select wire:model='status' id="status" class="form-control select2-show-search" required>
                                <option value=""> Pilih User</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i
                                    class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('jaksa-penuntut-umum.index') }}"
                                class="btn btn-warning btn-icon text-white">
                                <span>
                                    <i class="fe fe-log-in"></i>
                                </span> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // data select2 status
        $('#pangkat_id').on('change', function(e) {
            @this.set('pangkat_id', e.target.value);
        });
        // data select2 status
        $('#user_id').on('change', function(e) {
            @this.set('user_id', e.target.value);
        });
        // data select2 status
        $('#status').on('change', function(e) {
            @this.set('status', e.target.value);
        });

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                }).then(function () {
                    window.location = param.url_redirect;
                });
            }, 1000);
        });
    });
</script>
@endsection
