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
            <h1 class="page-title">Titipan Penahanan</h1>
        </div>

        <div class="ms-auto pageheader-btn">
            <a href="{{ route('titipan-tahanan.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Titipan Penahanan
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari Berdasarkan Tersangka">
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
                                <tr class="center-align">
                                    <th>No</th>
                                    <th>Tersangka</th>
                                    <th>Lapas</th>
                                    <th>Surat Pengaju</th>
                                    <th>Surat Balasan</th>
                                    <th>Status</th>
                                    @hasanyrole('kepolisian')
                                    <th>Aksi</th>
                                    @endhasanyrole
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($listTitipanTahanan as $i=>$titipanTahanan)
                                <tr>
                                <td>{{ ($listTitipanTahanan->currentpage()-1) * $listTitipanTahanan->perpage() + $i + 1 }}</td>
                                <td>{{ $titipanTahanan->tersangka->name }}</td>
                                <td>{{ $titipanTahanan->pengadilan->name }}</td>
                                <td class="text-nowrap align-middle">
                                    <center>
                                        <a href="/download-titipan-penahanan/{{ Crypt::encrypt($titipanTahanan->fileTitipanTahananPengaju->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a></td>
                                    </center>
                                @hasanyrole('lapas')
                                    @if($titipanTahanan->status == 1)
                                        <td>
                                            <center>
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#modalUploadBalasan_{{$titipanTahanan->id}}">
                                                    <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
                                                </a>
                                            </center>
                                        </td>
                                    @elseif($titipanTahanan->status == 2)
                                        @if($titipanTahanan->fileTahananBalasanBalasan)
                                            <td class="text-nowrap align-middle">
                                                <center>
                                                    <a href="/download-titipan-penahanan/{{ Crypt::encrypt($titipanTahanan->fileTahananBalasanBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                                </center>
                                            </td>
                                        @endif
                                    @endif
                                @else
                                    @if($titipanTahanan->status == 2)
                                        @if($titipanTahanan->fileTahananBalasanBalasan)
                                            <td class="text-nowrap align-middle">
                                                <center>
                                                    <a href="/download-titipan-penahanan/{{ Crypt::encrypt($titipanTahanan->fileTahananBalasanBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                                </center>
                                            </td>
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
                                    @if($titipanTahanan->status == 1)
                                        <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                    @elseif($titipanTahanan->status == 2)
                                        <button class="btn btn-sm btn-success badge">Balasan</button>
                                    @else
                                        '-'
                                    @endif
                                </td>
                                @hasanyrole('kepolisian')
                                <td>
                                    <div class="btn-group align-top">
                                        <!-- <a href="{{ route('data-penahanan.edit', Crypt::encrypt($titipanTahanan->id)) }}"
                                            class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a> -->
                                        <button class="btn btn-sm btn-primary badge" type="button"
                                            wire:click="$emit('deleteTitipanPenahananModal', '{{ Crypt::encrypt($titipanTahanan->id) }}')"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                                @endhasanyrole
                                @include('shared.lapas.titipan-tahanan.titipan-tahanan')
                                @empty
                                <td colspan="8" class="text-nowrap align-middle">
                                    Data Kosong
                                </td>
                                </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {{ $listTitipanTahanan->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('deleteTitipanPenahananModal', (params) => {
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
                        window.livewire.emit('deleteTitipanPenahanan', params);
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
