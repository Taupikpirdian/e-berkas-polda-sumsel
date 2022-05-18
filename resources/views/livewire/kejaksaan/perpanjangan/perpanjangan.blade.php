<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Perpanjangan Penahanan</h1>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan nama tersangka ...">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom-0 p-4">
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Lp</th>
                                    <th>Tanggal Lp</th>
                                    <th>Tersangka</th>
                                    @hasanyrole('pengadilan')
                                    <th>Pengadilan</th>
                                    @endhasanyrole
                                    @hasanyrole('kejaksaan')
                                    <th>JPU</th>
                                    @endhasanyrole
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($perpanjanganPenahanan as $i=>$perpanjanganPenahanans)
                                <tr>
                                    <td>{{ ($perpanjanganPenahanan->currentpage()-1) * $perpanjanganPenahanan->perpage() + $i + 1 }}</td>
                                    <td>
                                        {{ $perpanjanganPenahanans->no_lp ? $perpanjanganPenahanans->no_lp: '-' }}
                                    </td>
                                    <td>
                                        {{ $perpanjanganPenahanans->tanggal_lp ? dateIndo($perpanjanganPenahanans->tanggal_lp) : '-' }}
                                    </td>
                                    <td>{{$perpanjanganPenahanans->name_tersangka}}</td>
                                    <td>
                                        {{$perpanjanganPenahanans->name_assign}}
                                    </td>
                                    <td>
                                        <center>
                                            <a type="button" class="btn btn-sm btn-primary badge" data-bs-toggle="modal" data-bs-target="#detailPerpanjangan{{$perpanjanganPenahanans->datapenahanan_id}}"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('perpanjangan-penahanan.show', Crypt::encrypt($perpanjanganPenahanans->datapenahanan_id)) }}" class="btn btn-sm btn-primary badge"><i class="fa fa-plus"></i></a>
                                            <button class="btn btn-sm btn-primary badge" type="button"
                                                wire:click="$emit('deletePerpanjanganPenahananModal', '{{ Crypt::encrypt($perpanjanganPenahanans->datapenahanan_id) }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </center>
                                    </td>
                                </tr>
                                @include('shared.perpanjangan-penahanan.modal')
                                @empty
                                <td colspan="5" class="text-nowrap align-middle">
                                    Data Kosong
                                </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                        {{ $paginate_content }}
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-5">
                {{ $perpanjanganPenahanan->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('deletePerpanjanganPenahananModal', (params) => {
            setTimeout(function() {
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
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('deletePerpanjanganPenahanan', params);
                        Swal.fire({
                            icon: "success",
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            confirmButtonClass: 'btn btn-success',
                        })
                    }
                });

            }, 1000);
        });

        window.livewire.on('createSweetAlert', () => {
            setTimeout(function() {
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
            setTimeout(function() {
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