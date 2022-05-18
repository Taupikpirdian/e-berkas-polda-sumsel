<div>
  @if ($createPermission === false)
  <!-- PAGE-HEADER -->
  <div class="page-header">
      <div>
          <h1 class="page-title">Permission List</h1>
      </div>

      <div class="ms-auto pageheader-btn">
          <button type="button" class="btn btn-primary btn-icon text-white me-2" wire:click="showFormCreatePermission(null)"><i class="fe fe-plus"></i> Create Permission</button>
      </div>
  </div>
  <!-- PAGE-HEADER END -->

  <!-- ROW OPEN -->
  <div class="row row-cards">
      <div class="col-lg-12 col-xl-12">
          <div class="input-group mb-5">
              <input type="text" class="form-control" wire:model='query' placeholder="">
              <div class="input-group-text btn btn-primary">
                  <i class="fa fa-search" aria-hidden="true"></i>
              </div>
          </div>
          <div class="card">
              <div class="card-header border-bottom-0 p-4">
                  <h2 class="card-title">{{ $paginate_content }}</h2>
              </div>
              <div class="e-table px-5 pb-5">
                  <div class="table-responsive table-lg">
                      <table class="table border-top table-bordered mb-0">
                          <thead>
                              <tr>
                                  <th >No</th>
                                  <th >Name</th>
                                  <th class="text-center">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($permissions as $i=>$permission)
                              <tr>
                                  <td class="text-nowrap align-middle">{{ ($permissions->currentpage()-1) * $permissions->perpage() + $i + 1 }}</td>
                                  <td class="text-nowrap align-middle">{{ $permission->name }}</td>

                                  <td class="text-center align-middle">
                                      <div class="btn-group align-top">
                                          <button class="btn btn-sm btn-primary badge" wire:click="showFormCreatePermission({{ $permission->id }})" data-target="#user-form-modal" data-bs-toggle="modal" type="button"><i class="fa fa-edit"></i></button> 
                                          <button class="btn btn-sm btn-primary badge" type="button" wire:click="$emit('deleteModalPermission', {{ $permission->id }})"><i class="fa fa-trash"></i></button>
                                      </div>
                                  </td>
                              </tr>
                              @empty
                                  <td colspan="3">
                                  Data Kosong
                                  </td>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <div class="d-flex justify-content-end mb-5">
            {{ $permissions->links("livewire::bootstrap") }}
          </div>
      </div><!-- COL-END -->
  </div>
  <!-- ROW CLOSED -->
  @else
      @livewire('admin.permission.permission-update', compact('selectedPermissionId'))
  @endif
</div>

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.livewire.on('deleteModalPermission', (params) => {
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
            window.livewire.emit('deletePermission', params);
            Swal.fire(
              {
                icon: "success",
                title: 'Deleted!',
                text: 'Your file has been deleted.',
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