@extends('layout.app')
@section('content')

<style>
    .modal .form-control {
        text-align: center !important;
        border-top : none !important;
        border-left : none !important;
        border-right : none !important;
        border-radius: 0px !important;
    }

    .ff_fileupload_wrap .ff_fileupload_dropzone {
        height: 180px !important;
    }
</style>

<div class="app-content hor-content">
    <div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Detail Data {{ $label }}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/izin-pengadilan?fitur='.$data->jns_izin)}}">Izin Pengadilan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Data {{ $label }}</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-sm-8">
                <div class="card productdesc">
                    <div class="card-header">
                        <b>Detail</b>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <ul class="list-unstyled mb-5">
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Jenis Penetapan</div>
                                    <div class="col">: {{ $data->jenisPenetapan ? $data->jenisPenetapan->name : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Tanggal Surat Permohonan Penyidik</div>
                                    <div class="col">: {{ $data->tgl_surat_permohonan ? dateIndo($data->tgl_surat_permohonan) : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Nomor Surat Permohonan Penyidik</div>
                                    <div class="col">: {{ $data->no_surat_permohonan ? $data->no_surat_permohonan : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Tanggal Surat Perintah Penggeledahan</div>
                                    <div class="col">: {{ $data->tgl_surat_perintah ? dateIndo($data->tgl_surat_perintah) : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Nomor Surat Perintah Penggeledahan</div>
                                    <div class="col">: {{ $data->no_surat_perintah ? $data->no_surat_perintah : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Tanggal Laporan Polisi</div>
                                    <div class="col">: {{ $data->tgl_lapor ? dateIndo($data->tgl_lapor) : '-' }}</div>
                                </li>
                                <li class="row">
                                    <div class="col-sm-6 text-muted">Nomor Lapor Polisi</div>
                                    <div class="col">: {{ $data->no_lapor ? $data->no_lapor : '-' }}</div>
                                </li>
                                <li class=" row">
                                    <div class="col-sm-6 text-muted">Tanggal Berita Acara Penggeledahan</div>
                                    <div class="col">: {{ $data->tgl_ba ? dateIndo($data->tgl_ba) : '-' }}</div>
                                </li>
                                <li class=" row">
                                    <div class="col-sm-6 text-muted">Nomor Berita Acara Penggeledahan</div>
                                    <div class="col">: {{ $data->no_ba ? $data->no_ba : '-' }}</div>
                                </li>

                                <li class=" row">
                                    <div class="col-sm-6 text-muted">Lokasi</div>
                                    <div class="col">: {{ $data->lokasi }}</div>
                                </li>
                                @if($data->barang_sita != null)
                                <li class=" row">
                                    <div class="col-sm-6 text-muted">Barang Sita</div>
                                    <div class="col">: {{ $data->barang_sita }}</div>
                                </li>
                                @endif
                                @if($data->penggeledahan_terhadap_id != null)
                                <li class=" row">
                                    <div class="col-sm-6 text-muted">Penggeledahan Terhadap</div>
                                    <div class="col">: {{ $data->penggeledahanTerhadap ? $data->penggeledahanTerhadap->name : '' }}</div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
            <div class="col-sm-4">
                {{-- kepolisian --}}
                @if($data->kategori_id == 5)
                    @include('datatable.master-pengadilan.component.data-pengaju-kepolisian')
                @else {{-- kejaksaan --}}
                    @include('datatable.master-pengadilan.component.data-pengaju-kejaksaan')
                @endif
            </div>
        </div>
        <!-- ROW-1 CLOSED -->

        {{-- ROW-2 OPEN --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <b>Data Pihak Terkait</b>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-5">Pihak Terkait</h4>
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                                <thead>
                                    <tr class="border-top">
                                        <th class="w-1">No</th>
                                        <th class="w-5">Jenis Pihak</th>
                                        <th class="w-5">Nama</th>
                                        <th class="w-5">Tempat Lahir</th>
                                        <th class="w-5">Tanggal Lahir</th>
                                        <th class="w-5">Jenis Kelamin</th>
                                        <th class="w-5">Kebangsaan</th>
                                        <th class="w-5">Alamat</th>
                                        <th class="w-5">Agama</th>
                                        <th class="w-5">Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td>{{ $data->pihak ? ucfirst($data->pihak->jns_pihak) : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->name : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->tempat_lahir : '-' }}</td>
                                        <td>{{ $data->pihak ? dateIndo($data->pihak->tgl_lahir) : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->jk : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->kebangsaan : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->alamat : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->agama : '-' }}</td>
                                        <td>{{ $data->pihak ? $data->pihak->pekerjaan : '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ROW-2 CLOSED --}}

        {{-- ROW-3 OPEN --}}
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
                                        <th class="w-15" style="text-align: center">Jenis Berkas</th>
                                        <th class="w-15" style="text-align: center">Original Name</th>
                                        <th class="w-15" style="text-align: center">Diupload</th>
                                        <th class="w-10" style="text-align: center">Oleh</th>
                                        <th class="w-10" style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->fileIzin as $key=>$file)
                                    @php
                                        $class = 'bg-info';
                                        if($file->jns_file == 'balasan'){
                                            $class = 'bg-success';
                                        }else{
                                            $class = 'bg-info';
                                        }
                                    @endphp                                    
                                    <tr>
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td style="text-align: center;">
                                            <span class="badge {{ $class }}">{{ $file->jns_file }}</span>
                                        </td>
                                        <td>{{ $file->original_name ? $file->original_name : '-' }}</td>
                                        <td>{{ $file->created_at ? dateTimeIndo($file->created_at) : '-' }}</td>
                                        <td>{{ $file->created_by ? userById($file->created_by) : '-' }}</td>
                                        <td style="text-align: center">
                                            <a href="/download-file-izin-pengadilan/{{ helperEncrypt($file->id) }}" class="btn btn-info-light btn-square  br-50 m-1" data-bs-toggle="tooltip" title="" data-bs-original-title="download berkas" target="_blank"><i class="fe fe-download fs-13""></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ROW-3 CLOSED --}}
    </div>
</div>
@endsection