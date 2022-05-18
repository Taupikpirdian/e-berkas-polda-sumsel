<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">List User</h1>
        </div>
  
        <div class="ms-auto pageheader-btn">
            <a href="users/create" class="btn btn-primary btn-icon text-white me-2"><i class="fe fe-plus"></i> Create User</a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
  
    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan nama atau email">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom-0 p-4">
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table table-lg table-user">
                      @hasanyrole('admin-kepolisian')
                        @if($is_direktorat == true || $is_sat_polres == true)
                          @include('livewire.admin.user.component.table-admin-kepolisian-subdit')
                        @else
                          @include('livewire.admin.user.component.table-admin-kepolisian')
                        @endif
                      @endhasanyrole

                      @hasanyrole('admin-kejaksaan')
                        @include('livewire.admin.user.component.table-admin-kejaksaan')
                      @endhasanyrole

                      @hasanyrole('admin-master')
                        @include('livewire.admin.user.component.table-admin-master')
                      @endhasanyrole
                    </div>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                      {{ $paginate_content }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
              {{ $users->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW CLOSED -->
  </div>
  
  @section('js')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      window.livewire.on('deleteModalUser', (params) => {
        setTimeout(function(){
          Swal.fire({
            title: 'Apakah Anda yakin akan menghapus data ini?',
            text: "Anda tidak akan dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Hapus!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
          }).then(function (result) {
            if (result.value) {
              window.livewire.emit('deleteUser', params);
              Swal.fire(
                {
                  icon: "success",
                  title: 'Deleted!',
                  text: 'Data berhasil dihapus',
                  confirmButtonClass: 'btn btn-success',
                }
              )
            }
          });
  
        }, 1000);
      });
  
      window.livewire.on('createSweetAlert', () => {
        setTimeout(function(){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Anda berhasil input data!',
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          })
        }, 1000);
      });
  
      window.livewire.on('updateSweetAlert', () => {
        setTimeout(function(){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Anda berhasil update data!',
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          })
        }, 1000);
      });
  
    });
  </script>
  @endsection