<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Pangkat</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/Pangkat')}}">Pangkat</a></li>
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
                            <label class="form-label form-label-required">Name</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='name'
                                placeholder="Masukan Nama Pangkat" type="text">
                            @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Role</label>
                            <select wire:model='role' id="role" class="form-control select2-show-search" required>
                                <option value=""> Pilih Role</option>
                                <option value="kejaksaan">Kejaksaan</option>
                                <option value="kepolisian">Kepolisian</option>
                                <option value="pengadilan">Pengadilan</option>
                                <option value="kemenkumham">Kemenkumhan</option>
                            </select>
                            @error('role')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i
                                    class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('pangkat.index') }}" class="btn btn-warning btn-icon text-white">
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
        // data select2 jabatan_id
        $('#role').on('change', function(e) {
            @this.set('role', e.target.value);
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
