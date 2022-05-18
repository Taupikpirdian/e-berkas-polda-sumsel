<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Barang Bukti Narkotika</h1>
        </div>

        <div class="ms-auto pageheader-btn">
            <a href="{{URL::to('/barang-bukti-narkotika/create')}}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Barang Bukti Narkotika
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan no lp ...">
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
                                    <th class="text-center">No</th>
                                    <th class="text-center">No Lp</th>
                                    <th class="text-center">Tanggal Lp</th>
                                    <th class="text-center">Pengaju</th>
                                    <th class="text-center">No Surat Permohonan</th>
                                    <th class="text-center">Surat Pengaju</th>
                                    <th class="text-center">Surat Balasan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listDataBukti as $i=>$dataBukti)
                                <tr>
                                    <td>{{ ($listDataBukti->currentpage()-1) * $listDataBukti->perpage() + $i + 1 }}</td>
                                    <td>
                                        {{ $dataBukti->perkara->no_lp ? $dataBukti->perkara->no_lp: '-' }}
                                    </td>
                                    <td>
                                        {{ $dataBukti->perkara->date_no_lp ? dateIndo($dataBukti->perkara->date_no_lp) : '-' }}
                                    </td>
                                    <td>
                                        {{ $dataBukti->created_by ? CjsHelper::createdAtData($dataBukti->created_by)->name_kategori_bagian : '-' }}
                                    </td>
                                    <td>
                                        {{ $dataBukti->nosurat_permohonan ? $dataBukti->nosurat_permohonan : '-' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="/download-barang-bukti-narkotika/{{ $dataBukti->filePengaju ? Crypt::encrypt($dataBukti->filePengaju->id) : '' }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                    </td>
                                    @hasanyrole('admin-kejaksaan')
                                        @if($dataBukti->status == 1)
                                            <td class="align-middle text-center">
                                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalUploadBalasan_{{$dataBukti->id}}">
                                                    <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
                                                </a>
                                            </td>
                                        @elseif($dataBukti->status == 2)
                                            @if($dataBukti->fileBalasan)
                                                <td class="align-middle text-center">
                                                        <a href="/download-barang-bukti-narkotika/{{ Crypt::encrypt($dataBukti->fileBalasan->id) }}">
                                                            <i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
                                                        </a>
                                                </td>
                                            @endif
                                        @endif
                                    @else
                                        @if($dataBukti->status == 2)
                                            @if($dataBukti->fileBalasan)
                                                <td class="text-nowrap align-middle text-center"><a href="/download-barang-bukti-narkotika/{{ Crypt::encrypt($dataBukti->fileBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a></td>
                                            @else
                                                <td class="text-nowrap align-middle text-center">
                                                    <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                                </td>
                                            @endif
                                        @else
                                            <td class="text-nowrap align-middle text-center">
                                                <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Balasan"></i>
                                            </td>
                                        @endif
                                    @endhasanyrole
                                    <td class="text-nowrap align-middle text-center">
                                        @if($dataBukti->status == 1)
                                            <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                        @elseif($dataBukti->status == 2)
                                            <button class="btn btn-sm btn-success badge">Balasan</button>
                                        @else
                                            '-'
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropup btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fe fe-list"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#barangBuktiNarkotika{{$dataBukti->id}}"><i class="fe fe-eye"></i> Detail</a>
                                                @hasanyrole('kepolisian')
                                                <a class="dropdown-item" wire:click="$emit('deleteBarangBuktiModal', '{{ Crypt::encrypt($dataBukti->id) }}')"><i class="fe fe-trash"></i> Hapus</a>
                                                @endhasanyrole
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('shared.barang-bukti-narkotika.modal')
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
                {{ $listDataBukti->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('deleteBarangBuktiModal', (params) => {
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
                        window.livewire.emit('deleteBarangBuktiNarkotika', params);
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