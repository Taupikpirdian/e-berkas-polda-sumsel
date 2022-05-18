<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Berita Acara</h1>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <!-- PAGE-HEADER END -->
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan no lp ...">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                {{-- table --}}
                <div class="table-responsive p-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="center-align">
                                <th class="text-center">No</th>
                                <th class="text-center">No LP</th>
                                <th class="text-center">Tanggal LP</th>
                                <th class="text-center">Tersangka</th>
                                <th class="text-center">JPU</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPrapenuntutans as $i=>$dp)
                            @php
                            $class_span = 'bg-info';
                            if($dp->statusBerkas){
                            if($dp->statusBerkas->id == 1){
                            $class_span = 'bg-warning';
                            }elseif($dp->statusBerkas->id == 2){
                            $class_span = 'bg-info';
                            }else{
                            $class_span = 'bg-success';
                            }
                            }

                            $countTersangka = count($dp->perkaraTersangka);
                            @endphp

                            <tr>
                                <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                                <td class="text-nowrap align-middle">{{ $dp->no_lp }}</td>
                                <td class="text-nowrap align-middle">{{ dateIndo($dp->date_no_lp) }}</td>
                                <td class="text-nowrap align-middle">
                                    <div style="height: 50px;  overflow-y: scroll">
                                        @forelse($dp->perkaraTersangka as $key=>$tersangka)
                                        <p> Tersangka {{ $key + 1 }}: {{ $tersangka->name }}@if($countTersangka != $key + 1), </p> @endif
                                        @empty
                                        <span class="badge bg-danger text-white">Belum ada</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="text-nowrap align-middle">
                                    <div style="height: 50px;  overflow-y: scroll">
                                        @forelse($dp->perkaraJaksa as $key=>$jaksa)
                                        <p> Jaksa {{ $key + 1 }}: {{ $jaksa->masterJaksa ? $jaksa->masterJaksa->name : '' }}
                                            @if($countTersangka != $key + 1), @endif
                                        </p>
                                        @empty
                                        <span class="badge bg-danger text-white">Belum ada</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="text-nowrap align-middle">
                                    <center>
                                        <span class="badge {{ $class_span }} text-white">{{ $dp->statusBerkas ? $dp->statusBerkas->name : '' }}</span>
                                    </center>
                                </td>
                                <td class="text-nowrap align-middle text-center">
                                    <a type="button" wire:click="selectData({{ $dp->id }})"><span class="badge bg-success text-white">Pilih</span></a>
                                </td>
                            </tr>
                            @empty
                            <td class="center-align" colspan="18">
                                Data Kosong
                            </td>
                            @endforelse
                        </tbody>
                    </table>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                        {{ $paginate_content_modal_berkas }}
                    </p>
                    <div class="d-flex justify-content-end mb-5">
                        {{ $dataPrapenuntutans->links("livewire::bootstrap") }}
                    </div>
                </div>
                {{-- upload berkas --}}
                @if($dataPranutById)
                <div class="card-body">
                    <div class="media-heading">
                        <h5><strong>Data Prapenuntutan</strong></h5>
                    </div>
                    <hr>
                    <div class="table-responsive ">
                        <table class="table row table-borderless">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><strong>No LP :</strong> {{ $dataPranutById->no_lp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal LP :</strong> {{ dateIndo($dataPranutById->date_no_lp) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tersangka :</strong>
                                        @foreach($dataPranutById->perkaraTersangka as $data)
                                        {{ $data->name }},
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><strong>JPU :</strong>
                                        @foreach($dataPranutById->perkaraJaksa as $data)
                                        {{ $data->masterJaksa ? $data->masterJaksa->name : '' }},
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status :</strong> {{ $dataPranutById->statusBerkas ? $dataPranutById->statusBerkas->name : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="post" wire:submit.prevent="addData" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        {{-- Tambah Formil --}}
                        <div class="row">
                            <div class="col-sm">
                                <div class="card">
                                    <div class="card-header">
                                        Tambah Formil
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-sm-3 col-md-4 col-xl-3">
                                                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#modalFormil">Tambah</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="center-align">
                                                        <th>No</th>
                                                        <th class="text-nowrap align-middle">Name</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($formils as $key=>$ap)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $ap['name'] ? $ap['name'] : '-' }}</td>
                                                        <td>
                                                            <a type="button" wire:click.prevent="removeFormils({{ $key }})"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="13">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tambah Materil --}}
                        <div class="row">
                            <div class="col-sm">
                                <div class="card">
                                    <div class="card-header">
                                        Tambah Materil
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-sm-3 col-md-4 col-xl-3">
                                                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#modalMateril">Tambah</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="center-align">
                                                        <th>No</th>
                                                        <th class="text-nowrap align-middle">Name</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($materils as $key=>$ap)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $ap['name'] ? $ap['name'] : '-' }}</td>
                                                        <td>
                                                            <a type="button" wire:click.prevent="removeMaterils({{ $key }})"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="13">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="media-heading">
                                    <h5><strong>Surat Perintah</strong></h5>
                                </div>
                                <div class="input-group mb-3 file-browser">
                                    <textarea type="text" class="form-control" wire:model="surat_perintah" placeholder="Contoh : JAM PIDUM/Kejati/Kejari/Kacabjari JL. Gub. H. A. Bastari 8 Ilir Palembang (P.16) Nomor: PRINT / R.1.14 / Eku.1 / 01 / 2022"></textarea>
                                </div>
                                @error('surat_perintah')
                                <div class="mb-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="media-heading">
                                    <h5><strong>Tanggal Surat Perintah</strong></h5>
                                </div>
                                <div class="input-group mb-3 file-browse">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" type="date" wire:model='tanggal'
                                        id="tanggal" placeholder="DD-MM-YYYY" autocomplete="off">
                                </div>
                                @error('tanggal')
                                <div class="mb-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="media-heading">
                                    <h5><strong>Alamat</strong></h5>
                                </div>
                                <div class="input-group mb-3 file-browser">
                                    <textarea type="text" class="form-control" wire:model="alamat" placeholder="Contoh : Kejaksaan Agung RI / Kejaksaan Tinggi / Kejaksaan Negeri / Cabang Kejaksaan Negeri JL. Gub. H. A. Bastari 8 Ilir Palembang"></textarea>
                                </div>
                                @error('alamat')
                                <div class="mb-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="media-heading">
                                    <h5><strong>Kesimpulan</strong></h5>
                                </div>
                                <div class="input-group mb-3 file-browser">
                                    <textarea type="text" class="form-control" wire:model="kesimpulan"></textarea>
                                </div>
                                @error('kesimpulan')
                                <div class="mb-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">
                            Close
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                @endif
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- modal -->
    @include('shared.kejaksaan.berita-acara.modal')
    <!-- end modal  -->
</div>
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // hide modal
        window.livewire.on('closeModal', ($modal) => {
            $($modal).modal('hide');
        });

        $("#tanggal").bootstrapdatepicker({
            dateFormat: 'dd-mm-yy'
        });
        $('#tanggal').on('change', function (e) {
            @this.set('tanggal', e.target.value);
        });
    });
</script>
@endsection