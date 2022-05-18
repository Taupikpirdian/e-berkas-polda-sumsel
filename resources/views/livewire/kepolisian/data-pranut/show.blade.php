<div class="container">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Data Prapenuntutan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/data-prapenuntutan')}}">Data Prapenuntutan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Data Prapenuntutan</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-sm-8">
            <div class="card productdesc">
                @if($perkara->is_split == 1)
                    <div class="ribbone">
                        <div class="ribbon">
                            <span>split data</span>
                        </div>
                    </div>
                @endif
                <div class="card-header">
                    <b>Detail Laporan</b>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <ul class="list-unstyled mb-5">
                            <li class="row">
                                <div class="col-sm-3 text-muted">No LP</div>
                                <div class="col">{{ $perkara->no_lp ? $perkara->no_lp : '-' }}</div>
                            </li>
                            <li class="row">
                                <div class="col-sm-3 text-muted">Kronologi</div>
                                <div class="col">{{ $perkara->kronologi ? $perkara->kronologi : '-' }}</div>
                            </li>
                            <li class="row">
                                <div class="col-sm-3 text-muted">User Pengirim</div>
                                <div class="col">{{ $perkara->user ? $perkara->user->name : '-' }}</div>
                            </li>
                            <li class="row">
                                <div class="col-sm-3 text-muted">Tanggal Pengiriman</div>
                                <div class="col">{{ dateTimeIndo($perkara->created_at) }}</div>
                            </li>
                            <li class=" row">
                                <div class="col-sm-3 text-muted">No LP</div>
                                <div class="col">{{ $perkara->no_lp }}</div>
                            </li>
                            <li class="p-b-20 row">
                                <div class="col-sm-3 text-muted">Tanggal No LP</div>
                                <div class="col">{{ dateIndo($perkara->date_no_lp) }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
        <div class="col-sm-4">
            <div  class="card productdesc">
                <div class="card-header">
                    <b>Data Penyidik</b>
                </div>
                <div class="card-body">
                    <?php
                    $penyidik = $perkara->listPenyidik[0];
                    ?>
                    <ul class="list-unstyled mb-0">
                        <li class="p-b-20 row">
                            <div class="col-sm-4 text-muted">NRP Penyidik</div>
                            @if ($penyidik == null || $penyidik->masterPenyidik == null)
                                <div class="col">-</div>
                            @else
                                <div class="col">{{ $penyidik->masterPenyidik->nrp ? $penyidik->masterPenyidik->nrp : "-" }}</div>
                            @endif
                        </li>
                        <li class="p-b-20 row">
                            <div class="col-sm-4 text-muted">Nama Penyidik</div>
                            @if ($penyidik == null || $penyidik->masterPenyidik == null)
                                <div class="col">-</div>
                            @else
                                <div class="col">{{ $penyidik->masterPenyidik->name ? $penyidik->masterPenyidik->name : "-" }}</div>
                            @endif
                        </li>
                        <li class="p-b-20 row">
                            <div class="col-sm-4 text-muted">Email Penyidik</div>
                            @if ($penyidik == null || $penyidik->masterPenyidik == null || $penyidik->masterPenyidik->user == null)
                                <div class="col">-</div>
                            @else
                                <div class="col">{{ $penyidik->masterPenyidik->user->email ? $penyidik->masterPenyidik->email : "-" }}</div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->

    {{-- ROW-2 OPEN --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Data Tersangka</b>
                </div>
                <div class="card-body">
                    <h4 class="mb-5">Tersangka</h4>
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <thead>
                                <tr class="border-top">
                                    <th class="w-1 text-center">No</th>
                                    <th class="w-5 text-center">Proses</th>
                                    <th class="w-15 text-center">NIK</th>
                                    <th class="w-5 text-center">Nama</th>
                                    <th class="w-5 text-center">Tempat Lahir</th>
                                    <th class="w-5 text-center">Tanggal Lahir</th>
                                    <th class="w-5 text-center">Jenis Kelamin</th>
                                    <th class="w-5 text-center">Kebangsaan</th>
                                    <th class="w-5 text-center">Alamat</th>
                                    <th class="w-5 text-center">Agama</th>
                                    <th class="w-5 text-center">Pekerjaan</th>
                                    <th class="w-5 text-center">Pendidikan</th>
                                    <th class="w-5 text-center">Pasal</th>
                                    <th class="w-5 text-center">Tercatat Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $y = $listTersangka->currentPage() > 1 ? (10 * ($listTersangka->currentPage() - 1)) + 1 : 1; ?>
                                @forelse ($listTersangka as $i=>$tersangka)
                                <tr>
                                    <td style="text-align: center;">{{ $y }}</td>
                                    <td>
                                        @if($tersangka->is_proses == 1)
                                            <span class="badge bg-success">IYA</span>
                                        @else
                                            <span class="badge bg-danger">TIDAK</span>
                                        @endif
                                    </td>
                                    <td>{{ $tersangka->nik ? $tersangka->nik : '-' }}</td>
                                    <td>{{ $tersangka->name ? $tersangka->name : '-' }}</td>
                                    <td>{{ $tersangka->tempat_lahir ? $tersangka->tempat_lahir : '-' }}</td>
                                    <td>{{ $tersangka->tgl_lahir ? date("d M Y", strtotime($tersangka->tgl_lahir)) : '-' }}</td>
                                    <td>{{ $tersangka->jk ? $tersangka->jk : '-' }}</td>
                                    <td>{{ $tersangka->kebangsaan ? $tersangka->kebangsaan : '-' }}</td>
                                    <td>{{ $tersangka->alamat ? $tersangka->alamat : '-' }}</td>
                                    <td>{{ $tersangka->agama ? $tersangka->agama : '-' }}</td>
                                    <td>{{ $tersangka->pekerjaan ? $tersangka->pekerjaan : '-' }}</td>
                                    <td>{{ $tersangka->pendidikan ? $tersangka->pendidikan : '-' }}</td>
                                    <td>{{ $tersangka->pasal ? $tersangka->pasal : '-' }}</td>
                                    <td>{{ dateTimeIndo($tersangka->created_at) }}</td>
                                </tr>
                                <?php $y++; ?>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                        {{ $paginate_content_listtersangka }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {!! $listTersangka->appends(['tersangka' => $listTersangka->currentPage()])->links("livewire::bootstrap") !!}
            </div>
        </div>
    </div>
    {{-- ROW-2 CLOSED --}}

    {{-- ROW-3 OPEN --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Data Jaksa</b>
                </div>
                <div class="card-body">
                    <h4 class="mb-5">Jaksa</h4>
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <thead>
                                <tr class="border-top">
                                    <th class="w-1">No</th>
                                    <th class="w-15">NIP</th>
                                    <th class="w-5">Nama</th>
                                    <th class="w-5">Pangkat</th>
                                    <th class="w-5">Email</th>
                                    <th class="w-5">No Hp</th>
                                    <th class="w-5">Tanggal Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = $listJaksa->currentPage() > 1 ? (10 * ($listJaksa->currentPage() - 1)) + 1 : 1; ?>
                                @forelse ($listJaksa as $i=>$jaksa)
                                <tr>
                                    <td style="text-align: center;">{{ $x }}</td>
                                    <td>{{ $jaksa->masterJaksa ? $jaksa->masterJaksa->nip : '-' }}</td>
                                    <td>{{ $jaksa->masterJaksa ? $jaksa->masterJaksa->name : '-' }}</td>
                                    <td>{{ $jaksa->masterJaksa ? $jaksa->masterJaksa->pangkat->name : '-' }}</td>
                                    <td>{{ $jaksa->masterJaksa ? $jaksa->masterJaksa->user->email : '-' }}</td>
                                    <td>{{ $jaksa->masterJaksa ? ($jaksa->masterJaksa->no_tlp ? $jaksa->masterJaksa->no_tlp : '-') : '-' }}</td>
                                    <td>{{ dateTimeIndo($jaksa->created_at) }}</td>
                                </tr>
                                <?php $x++; ?>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align: center">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                        {{ $paginate_content_listjaksa }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {!! $listJaksa->appends(['jaksa' => $listJaksa->currentPage()])->links("livewire::bootstrap") !!}
            </div>
        </div>
    </div>
    {{-- ROW-3 CLOSED --}}

    {{-- ROW-4 OPEN --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Data Berkas</b>
                </div>
                <div class="card-body">
                    <h4 class="mb-5">List Berkas</h4>
                    <div class="table-responsive">
                        <table class="table table-striped border table-bordered table-hover">
                            <thead>
                                <tr class="border-top">
                                    <th class="w-10" style="text-align: center">No</th>
                                    <th class="w-5" style="text-align: center">No Berkas</th>
                                    <th class="w-15" style="text-align: center">Jenis Berkas</th>
                                    <th class="w-15" style="text-align: center">Original Name</th>
                                    <th class="w-15" style="text-align: center">Diupload</th>
                                    <th class="w-10" style="text-align: center">Oleh</th>
                                    <th class="w-10" style="text-align: center">Catatan</th>
                                    <th class="w-10" style="text-align: center">Pemilik</th>
                                    <th class="w-10" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $z = $filePerkara->currentPage() > 1 ? (10 * ($filePerkara->currentPage() - 1)) + 1 : 1; ?>
                                @foreach($filePerkara as $key=>$files)
                                <tr>
                                    <td style="text-align: center;">{{ $z }}</td>
                                    <td>{{ $files->no_berkas ? $files->no_berkas : '-' }}</td>
                                    <td style="text-align: center;">
                                        <span class="badge bg-success">{{ $files->masterFile ? $files->masterFile->name : '-' }}</span>
                                    </td>
                                    <td>{{ $files->original_name ? $files->original_name : '-' }}</td>
                                    <td>{{ $files->uploadedBy ? dateTimeIndo($files->uploadedBy->created_at) : '-' }}</td>
                                    <td>{{ $files->uploadedBy ? $files->uploadedBy->name : '-' }}</td>
                                    <td>{{ $files->catatan ? $files->catatan : '-' }}</td>
                                    <td>{{ $files->tersangka ? $files->tersangka->name : 'Semua Tersangka' }}</td>
                                    <td style="text-align: center">
                                        <a href="/download-file/{{ helperEncrypt($files->id) }}" class="btn btn-info-light btn-square br-50 m-1" data-bs-toggle="tooltip" title="" data-bs-original-title="download berkas" target="_blank"><i class="fe fe-download fs-13""></i> </a>
                                    </td>
                                </tr>
                                <?php $z++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="col-sm-12 mt-3" style="text-align: left;">
                        {{ $paginate_content_fileperkara }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {!! $filePerkara->appends(['fileperkara' => $filePerkara->currentPage()])->links("livewire::bootstrap") !!}
            </div>
        </div>
    </div>
    {{-- ROW-4 CLOSED --}}
</div>