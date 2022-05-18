<div>
    @if ($createdLaporanPerkara === false)
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">List Laporan Perkara</h1>
        </div>
  
        <div class="ms-auto pageheader-btn">
            <button type="button" class="btn btn-primary btn-icon text-white me-2" wire:click="showFormCreateLaporanPerkara(null)"><i class="fe fe-plus"></i>Tambah Laporan Perkara</button>
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
                                    <th>No</th>
                                    <th>User</th>
                                    <th>No LP</th>
                                    <th>Tanggal LP</th>
                                    <th>Kategori</th>
                                    <th>Kategori Bagian</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporanPerkara as $i=>$laporan)
                                <tr>
                                    <td class="text-nowrap align-middle">{{ ($laporanPerkara->currentpage()-1) * $laporanPerkara->perpage() + $i + 1 }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->user_id }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->no_lp }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->date_no_lp }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->kategori_id }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->kategori_bagian_id }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->status }}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top">
                                            <button class="btn btn-sm btn-primary badge" wire:click="showFormCreateLaporanPerkara('{{ Crypt::encrypt($laporan->id) }}')" data-target="#laporanperkara-form-modal" data-bs-toggle="modal" type="button"><i class="fa fa-edit"></i></button> 
                                            <button class="btn btn-sm btn-primary badge" type="button" wire:click="$emit('deleteLaporanPerkara', '{{ Crypt::encrypt($laporan->id) }}')"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="8" class="text-nowrap align-middle">
                                    Data Kosong
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
              {{ $laporanPerkara->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW CLOSED -->
    @else
        @livewire('kepolisian.laporan-perkara.laporan-perkara-update', compact('selectedLaporanPerkaraId'))
    @endif
  </div>
  
  @section('js')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      window.livewire.on('deleteLaporanPerkara', (params) => {
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
              window.livewire.emit('deleteLaporanPerkara', params);
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