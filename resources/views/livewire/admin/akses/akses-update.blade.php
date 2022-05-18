<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Akses Satuan Kerja</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/akses')}}">Akses</a></li>
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
                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">User</label>
                            <select wire:model='user_id' id="user_id" class="form-control select2-show-search" required>
                                <option value=""> Pilih User</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Satuan Kerja</label>
                            <select wire:model='kategori_bagian_id' id="kategori_bagian_id" class="form-control select2-show-search" required>
                                <option value=""> Pilih Satuan Kerja</option>
                                @foreach ($satkers as $satker)
                                <option value="{{ $satker->id }}">{{ $satker->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_bagian_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i
                                    class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('akses.index') }}" class="btn btn-warning btn-icon text-white">
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
        // data select2 user_id
        $('#user_id').on('change', function(e) {
            @this.set('user_id', e.target.value);
        });
        // data select2 kategori_bagian_id
        $('#kategori_bagian_id').on('change', function(e) {
            @this.set('kategori_bagian_id', e.target.value);
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
