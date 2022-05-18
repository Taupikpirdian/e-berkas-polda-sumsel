<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/permissions')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div  class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $breadcrumb }}</h3>
                </div>
                <div class="card-body pt-2">
                {{-- penyidik polda --}}
                @if($is_admin_kepolisian == true && $typeLembaga == \App\Constant::POLDA)
                    @include('livewire.admin.user.component.form-polda')
                @endif
                {{-- penyidik dit polda --}}
                @if($is_admin_kepolisian == true && $typeLembaga == \App\Constant::DIREKTORAT_POLDA)
                    @include('livewire.admin.user.component.form-dit-polda')
                @endif
                {{-- penyidik polres --}}
                @if($is_admin_kepolisian == true && $typeLembaga == \App\Constant::POLRES)
                    @include('livewire.admin.user.component.form-polres')
                @endif
                
                @if($is_admin_kepolisian == true && $typeLembaga == \App\Constant::SATUAN_POLRES)
                    @include('livewire.admin.user.component.form-sat-polres')
                @endif

                @if($is_admin_kepolisian == true && $typeLembaga == \App\Constant::POLSEK)
                    @include('livewire.admin.user.component.form-polsek')
                @endif

                @if($is_admin_kejaksaan == true)
                    @include('livewire.admin.user.component.form-kejati')
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#instansi_id').on('change', function(e) {
            @this.set('instansi_id', e.target.value);
        });

        $('#pangkat_id').on('change', function(e) {
            @this.set('pangkat_id', e.target.value);
        });

        $('#role_name').on('change', function(e) {
            @this.set('role_name', e.target.value);
        });

        $('#subdit_id').on('change', function(e) {
            @this.set('subdit_id', e.target.value);
        });

        $('#type').on('change', function(e) {
            @this.set('type', e.target.value);
        });
        
        window.livewire.on('confirmSubmit', () => {
            setTimeout(function(){
                Swal.fire({
                title: 'Apakah Anda yakin akan menyimpan data ini?',
                text: "Harap cek kembali sampai Anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Simpan!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                cancelButtonText: 'Cek Dahulu',
                buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        window.livewire.emit('store');
                    }
                });

            }, 1000);
        });
        
    });
</script>
@endsection