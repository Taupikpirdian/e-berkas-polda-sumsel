<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $label }}</h1>
        </div>
        

        <div class="ms-auto pageheader-btn">
            <a href="{{URL::to('/data-penahanan/create?fitur='.$fitur)}}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Permohonan Perpanjangan Penahanan
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a style="cursor: pointer;" href="#anak" class="active show" data-bs-toggle="tab">Anak</a></li>
                                    <li><a style="cursor: pointer;" href="#dewasa" data-bs-toggle="tab" class="">Dewasa</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="anak">
                    <div class="row row-cards">
                        <div class="col-lg-12 col-xl-12">
                            <div class="input-group mb-5">
                                <input type="text" class="form-control" wire:model='queryPenahananAnak' placeholder="Cari Nama Tersangka Penahanan Anak">
                                <div class="input-group-text btn btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header border-bottom-0 p-4">
                                    <h2 class="card-title"></h2>
                                </div>
                                <div class="e-table px-5 pb-5">
                                    <div class="table-responsive table-lg">
                                        <table class="table border-top table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Register</th>
                                                    <th>Nomor Surat Permohonan</th>
                                                    <th>Pengaju</th>
                                                    <th>JPU</th>
                                                    <th>Tersangka</th>
                                                    <th>Surat Pengaju</th>
                                                    <th>Surat Balasan</th>
                                                    <th>Status</th>
                                                    @hasanyrole('kepolisian')
                                                    <th class="text-center">Aksi</th>
                                                    @endhasanyrole
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($listDataPenahananAnak as $i=>$dataPenahanan)
                                                @if($dataPenahanan->type_tersangka == 1)
                                                <tr>
                                                    <td class="text-nowrap align-middle">
                                                        {{ ($listDataPenahananAnak->currentpage()-1) * $listDataPenahananAnak->perpage() + $i + 1 }}
                                                    </td>
                                                    <td class="text-nowrap align-middle">{{ dateIndo($dataPenahanan->created_at, false, false) }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->no_surat_pengajuan }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->createdBy->name }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->assignDataPenahanan->jaksa->name }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->tersangka->name }}</td>
                                                    <td class="text-nowrap align-middle">
                                                        <center>
                                                            <a href="/download-data-penahanan/{{ $dataPenahanan->fileDataPenahananPengaju ? Crypt::encrypt($dataPenahanan->fileDataPenahananPengaju->id) : '' }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                                        </center>
                                                    </td>
                                                    @hasanyrole('pengadilan')
                                                        @if($dataPenahanan->status == 1)
                                                            <td>
                                                                <center>
                                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalUploadBalasan_{{$dataPenahanan->id}}">
                                                                        <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        @elseif($dataPenahanan->status == 2)
                                                            @if($dataPenahanan->fileDataPenahananBalasan)
                                                                <td class="text-nowrap align-middle">
                                                                    <center>
                                                                        <a href="/download-data-penahanan/{{ Crypt::encrypt($dataPenahanan->fileDataPenahananBalasan->id) }}">
                                                                            <i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if($dataPenahanan->status == 2)
                                                            @if($dataPenahanan->fileDataPenahananBalasan)
                                                                <td class="text-nowrap align-middle"><a href="/download-data-penahanan/{{ Crypt::encrypt($dataPenahanan->fileDataPenahananBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a></td>
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
                                                        @if($dataPenahanan->status == 1)
                                                            <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                                        @else
                                                            <button class="btn btn-sm btn-success badge">Balasan</button>
                                                        @endif
                                                    </td>
                                                    @hasanyrole('kepolisian')
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <!-- <a href="{{ route('data-penahanan.edit', Crypt::encrypt($dataPenahanan->id)) }}"
                                                                class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a> -->
                                                            <button class="btn btn-sm btn-primary badge" type="button"
                                                                wire:click="$emit('deleteDataPenahananModal', '{{ Crypt::encrypt($dataPenahanan->id) }}')"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    @endhasanyrole
                                                </tr>
                                                @include('shared.modal-data-penahanan')
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-nowrap align-middle">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                @endif
                                                @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-5">
                                {{ $listDataPenahananAnak->links("livewire::bootstrap") }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="dewasa">
                    <div class="row row-cards">
                        <div class="col-lg-12 col-xl-12">
                            <div class="input-group mb-5">
                                <input type="text" class="form-control" wire:model='queryPenahananDewasa' placeholder="Cari Nama Tersangka Penahanan Dewasa">
                                <div class="input-group-text btn btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header border-bottom-0 p-4">
                                    <h2 class="card-title"></h2>
                                </div>
                                <div class="e-table px-5 pb-5">
                                    <div class="table-responsive table-lg">
                                        <table class="table border-top table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Register</th>
                                                    <th>Nomor Surat Permohonan</th>
                                                    <th>Pengaju</th>
                                                    <th>Tersangka</th>
                                                    <th>Surat Pengaju</th>
                                                    <th>Surat Balasan</th>
                                                    <th>Status</th>
                                                    @hasanyrole('kepolisian')
                                                    <th class="text-center">Aksi</th>
                                                    @endhasanyrole
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($listDataPenahananDewasa as $i=>$dataPenahanan)
                                                @if($dataPenahanan->type_tersangka == 2)
                                                <tr>
                                                    <td class="text-nowrap align-middle">
                                                        {{ ($listDataPenahananDewasa->currentpage()-1) * $listDataPenahananDewasa->perpage() + $i + 1 }}
                                                    </td>
                                                    <td class="text-nowrap align-middle">{{ dateIndo($dataPenahanan->created_at, false, false) }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->no_surat_pengajuan }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->createdBy->name }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dataPenahanan->tersangka->name }}</td>
                                                    <td class="text-nowrap align-middle">
                                                        <center>
                                                            <a href="/download-data-penahanan/{{ $dataPenahanan->fileDataPenahananPengaju ? Crypt::encrypt($dataPenahanan->fileDataPenahananPengaju->id) : '' }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
                                                        </center>
                                                    </td>
                                                    @hasanyrole('pengadilan')
                                                        @if($dataPenahanan->status == 1)
                                                            <td>
                                                                <center>
                                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalUploadBalasan_{{$dataPenahanan->id}}">
                                                                        <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        @elseif($dataPenahanan->status == 2)
                                                            @if($dataPenahanan->fileDataPenahananBalasan)
                                                                <td class="text-nowrap align-middle">
                                                                    <center>
                                                                        <a href="/download-data-penahanan/{{ Crypt::encrypt($dataPenahanan->fileDataPenahananBalasan->id) }}">
                                                                            <i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if($dataPenahanan->status == 2)
                                                            @if($dataPenahanan->fileDataPenahananBalasan)
                                                                <td class="text-nowrap align-middle">
                                                                    <center>
                                                                        <a href="/download-data-penahanan/{{ Crypt::encrypt($dataPenahanan->fileDataPenahananBalasan->id) }}"><i class="fa fa-check-circle-o text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> </a>
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
                                                        @if($dataPenahanan->status == 1)
                                                            <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                                        @else
                                                            <button class="btn btn-sm btn-success badge">Balasan</button>
                                                        @endif
                                                    </td>
                                                    @hasanyrole('kepolisian')
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <!-- <a href="{{ route('data-penahanan.edit', Crypt::encrypt($dataPenahanan->id)) }}"
                                                                class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a> -->
                                                            <button class="btn btn-sm btn-primary badge" type="button"
                                                                wire:click="$emit('deleteDataPenahananModal', '{{ Crypt::encrypt($dataPenahanan->id) }}')"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    @endhasanyrole
                                                </tr>
                                                @include('shared.modal-data-penahanan')
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-nowrap align-middle">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                @endif
                                                @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-5">
                                {{ $listDataPenahananDewasa->links("livewire::bootstrap") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
	</div>
   
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('deleteDataPenahananModal', (params) => {
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
                        window.livewire.emit('deleteDataPenahanan', params);
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
