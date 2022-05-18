@section('css')
<style>
    .center-align {
        text-align: center;
    }

    .color-green {
        color: green;
    }

    .color-yellow {
        color: #F7BE00;
    }

    .color-blue {
        color: #23AEC8;
    }
</style>
@endsection

<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Bon Tahanan</h1>
        </div>

        @hasanyrole('kepolisian')
        <div class="ms-auto pageheader-btn">
            <a href="{{ route('bon-tahanan.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Bon Tahanan
            </a>
        </div>
        @endhasanyrole
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan nama tersangka">
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
                                <tr class="center-align">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">No Reg Instansi</th>
                                    <th rowspan="2">Tahanan</th>
                                    <th rowspan="2">Pengaju</th>
                                    <th colspan="2">File</th>
                                    <th rowspan="2">Waktu Peminjaman</th>
                                    <th rowspan="2">Waktu Pengembalian</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Updated By</th>
                                    <th rowspan="2">Updated At</th>
                                    <th class="text-center" rowspan="2">Aksi</th>
                                </tr>
                                <tr class="text-center">
                                    <th>File Pengajuan</th>
                                    <th>File Balasan</th>
                                </tr>

                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {{-- {{ $listBpacTipiring->links("livewire::bootstrap") }} --}}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('deleteBpacTipiringModal', (params) => {
            setTimeout(function () {
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
                        window.livewire.emit('deleteBpacTipiring', params);
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
    });

</script>
@endsection
