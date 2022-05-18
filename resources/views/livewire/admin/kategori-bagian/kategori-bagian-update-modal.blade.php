<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Lembaga Penyidik</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/kategori-bagian')}}">Lembaga Penyidik</a></li>
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
                            <label class="form-label form-label-required">Nama Lembaga Penyidik</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='name' placeholder="Masukan nama lembaga penyidik" type="text">
                            @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Lembaga</label>
                            <select wire:model='kategori_id' id="kategori_id" class="select2 form-control select2-show-search" required>
                                <option value="" selected> Pilih Lembaga </option>
                                @foreach ($kategori_data as $kategori_datas)
                                <option value="{{ $kategori_datas->id }}">{{ $kategori_datas->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='email' placeholder="Masukan email lembaga penyidik" type="email">
                            @error('email')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm  mb-4" wire:model='alamat' placeholder="Masukan alamat lembaga penyidik"></textarea>
                            @error('alamat')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">No Tlp</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='no_tlp' placeholder="Masukan No Tlp lembaga penyidik" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            @error('no_tlp')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('kategori-bagian.index') }}" class="btn btn-warning btn-icon text-white">
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
    document.addEventListener('DOMContentLoaded', function() {

        // data select2 kategori
        $('#kategori_id').on('change', function(e) {
            @this.set('kategori_id', e.target.value);
        });

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function() {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                }).then(function() {
                    window.location = param.url_redirect;
                });
            }, 1000);
        });

    });
</script>
@endsection