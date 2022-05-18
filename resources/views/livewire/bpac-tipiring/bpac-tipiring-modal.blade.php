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
            <h1 class="page-title">BACP Tipiring</h1>
        </div>

        @hasanyrole('kepolisian')
        <div class="ms-auto pageheader-btn">
            <a href="{{ route('bacp-tipiring.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create BACP Tipiring
            </a>
        </div>
        @endhasanyrole
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari Berdasarkan nama penyidik, nama tersangka, nama pengadilan">
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
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Tanggal Pelimpahan</th>
                                    <th rowspan="2">Tanggal Register</th>
                                    <th rowspan="2">Pengadilan</th>
                                    <th rowspan="2">Penyidik</th>
                                    <th rowspan="2">Tersangka</th>
                                    <th colspan="2">File</th>
                                    <th rowspan="2">status</th>
                                    <th rowspan="2" class="text-center">Aksi</th>
                                </tr>
                                <tr class="center-align">
                                    <th>Surat Pengaju</th>
                                    <th>Surat Balasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listBpacTipiring as $i=>$bpacTipiring)
                                <tr>
                                    <td class="text-nowrap align-middle">
                                        {{ ($listBpacTipiring->currentpage()-1) * $listBpacTipiring->perpage() + $i + 1 }}
                                    </td>
                                    <td class="text-nowrap align-middle">{{ dateIndo($bpacTipiring->tanggal_pelimpahan, false, false) }}</td>
                                    <td class="text-nowrap align-middle">{{ dateIndo($bpacTipiring->tanggal_register, false, false) }}</td>
                                    <td class="text-nowrap align-middle">{{ $bpacTipiring->pengadilan ? $bpacTipiring->pengadilan->name : '-' }}</td>
                                    <td class="text-nowrap align-middle">{{ $bpacTipiring->penyidik->name }}</td>
                                    {{-- <td class="text-nowrap align-middle">{{ $bpacTipiring->tersangka }}</td> --}}
                                    <td class="text-nowrap align-middle">
                                        @forelse ($bpacTipiring->tersangka as $x => $t)
                                            {{ $x+1 . ") " . $t->name }}
                                            <br>
                                        @empty
                                            {{ "-" }}
                                        @endforelse
                                    </td>
                                    {{-- td pengadilan --}}
                                    @hasanyrole('pengadilan')
                                    @include('livewire.bpac-tipiring.component.td-pengadilan')
                                    @endhasanyrole
                                    {{-- td admin kejaksaan --}}
                                    @hasanyrole('admin-kejaksaan|kejaksaan')
                                    @include('livewire.bpac-tipiring.component.td-admin-kejaksaan')
                                    @endhasanyrole
                                    {{-- td kepolisian --}}
                                    @hasanyrole('kepolisian')
                                    @include('livewire.bpac-tipiring.component.td-kepolisian')
                                    @endhasanyrole
                                    <td class="text-nowrap" style="text-align: center;">
                                        @if($bpacTipiring->status == 2)
                                            <button class="btn btn-sm btn-success badge">Balasan</button>
                                        @else
                                            <button class="btn btn-sm btn-success badge">Menunggu Balasan</button>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top">
                                            @hasanyrole('kepolisian')
                                            <a href="{{ route('bacp-tipiring.edit', Crypt::encrypt($bpacTipiring->id)) }}" class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a>
                                            @endhasanyrole

                                            <a href="{{ route('bacp-tipiring.show', Crypt::encrypt($bpacTipiring->id)) }}" class="btn btn-sm btn-primary badge"><i class="fa fa-eye"></i></a>
                                            
                                            @hasanyrole('kepolisian')
                                            <button class="btn btn-sm btn-primary badge" type="button" wire:click="$emit('deleteBpacTipiringModal', '{{ Crypt::encrypt($bpacTipiring->id) }}')"><i class="fa fa-trash"></i></button>
                                            @endhasanyrole
                                        </div>
                                    </td>
                                </tr>
                                @include('shared.pengadilan.bpac-tipiring.bpac-tipiring')
                                @empty
                                <td colspan="10" class="text-nowrap align-middle">
                                    Data Kosong
                                </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {{ $listBpacTipiring->links("livewire::bootstrap") }}
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
