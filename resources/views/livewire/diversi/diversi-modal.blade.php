<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Register Diversi</h1>
        </div>

        <div class="ms-auto pageheader-btn">
            <a href="{{ route('diversi.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan nama terdakwa">
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
                                    <th>Tanggal Register</th>
                                    <th>Nomor Register</th>
                                    <th>Terdakwa</th>
                                    <th>Pengaju</th>
                                    <th>Surat Pengaju</th>
                                    <th>Surat Balasan</th>
                                    <th>Status</th>
                                    @hasanyrole('kepolisian')
                                    <th class="text-center">Aksi</th>
                                    @endhasanyrole
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listDiversi as $i=>$diversi)
                                <tr>
                                    <td class="text-nowrap align-middle">
                                        {{ ($listDiversi->currentpage()-1) * $listDiversi->perpage() + $i + 1 }}
                                    </td>
                                    <td class="text-nowrap align-middle">{{ dateIndo($diversi->created_at, false, false) }}</td>
                                    <td class="text-nowrap align-middle">{{ $diversi->nomor_register }}</td>
                                    <td class="text-nowrap align-middle">{{ $diversi->tersangka ? $diversi->tersangka->name : '' }}</td>
                                    <td class="text-nowrap align-middle">{{ $diversi->createdBy->name }}</td>
                                    <td class="text-nowrap align-middle">
                                        <center>
                                            <a href="/download-diversi/{{ $diversi->fileDiversiPengaju ? Crypt::encrypt($diversi->fileDiversiPengaju->id) : '' }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                        </center>
                                    </td>
                                    @hasanyrole('pengadilan')
                                        @if($diversi->status == 1)
                                            <td>
                                                <center>
                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalUploadBalasan_{{$diversi->id}}">
                                                        <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
                                                    </a>
                                                </center>
                                            </td>
                                        @elseif($diversi->status == 2)
                                            @if($diversi->fileDiversiBalasan)
                                                <td class="text-nowrap align-middle">
                                                    <center>
                                                        <a href="/download-diversi/{{ Crypt::encrypt($diversi->fileDiversiBalasan->id) }}">
                                                            <i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
                                                        </a>
                                                    </center>
                                                </td>
                                            @endif
                                        @endif
                                    @else
                                        @if($diversi->status == 2)
                                            @if($diversi->fileDiversiBalasan)
                                                <td class="text-nowrap align-middle"><a href="/download-diversi/{{ Crypt::encrypt($diversi->fileDiversiBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a></td>
                                            @else
                                                <td>
                                                    <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <center>
                                                    <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Balasan"></i>
                                                </center>
                                            </td>
                                        @endif
                                    @endhasanyrole
                                    <td class="text-nowrap align-middle">
                                        @if($diversi->status == 1)
                                            <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                        @elseif($diversi->status == 2)
                                            <button class="btn btn-sm btn-success badge">Balasan</button>
                                        @else
                                            '-'
                                        @endif
                                    </td>
                                    @hasanyrole('kepolisian')
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top">
                                            <!-- <a href="{{ route('diversi.edit', Crypt::encrypt($diversi->id)) }}"
                                                class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a> -->
                                            <button class="btn btn-sm btn-primary badge" type="button"
                                                wire:click="$emit('deleteDiversiModal', '{{ Crypt::encrypt($diversi->id) }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                    @endhasanyrole
                                </tr>
                                @include('shared.pengadilan.diversi.diversi')
                                @empty
                                <td colspan="9" class="text-nowrap align-middle">
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
                {{ $listDiversi->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('deleteDiversiModal', (params) => {
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
                        window.livewire.emit('deleteDiversi', params);
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
