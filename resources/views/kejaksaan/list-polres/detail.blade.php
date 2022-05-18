@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">List Laporan Perkara</h1>
            </div>
        </div>
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive deleted-table">
                        <table id="delete-datatable" class="table table-bordered text-nowrap border-bottom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No LP</th>
                                    <th>Tanggal LP</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($laporanPerkara as $i=>$laporan)
                                <tr>
                                    <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->no_lp }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->date_no_lp }}</td>
                                    <td class="text-nowrap align-middle">{{ $laporan->statusBerkas ? $laporan->statusBerkas->name : '' }}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top">
                                            <button class="btn btn-sm btn-primary badge" data-bs-toggle="modal" data-bs-target="#laporanperkara{{ $laporan->id }}" type="button"><i class="fa fa-eye"></i></button> 
                                            <button class="btn btn-sm btn-primary badge" type="button" wire:click="$emit('deleteLaporanPerkara', {{ $laporan->id }})"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade"  id="laporanperkara{{ $laporan->id }}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Detail List Perkara</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="form-label">User Pengirim :</label>
                                                        <input class="form-control form-control-sm mb-4" type="text" value="{{Auth::user()->name}}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">No LP</label>
                                                        <input class="form-control form-control-sm mb-4" name="no_lp" value="{{ $laporan->no_lp }}" placeholder="Masukan no lp" type="text" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Tanggal No LP</label>
                                                        <div class="input-group">
                                                            <input class="form-control" name="date_no_lp" value="{{ date('d M Y', strtotime($laporan->date_no_lp)) }}" type="text" readonly>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="form-label">File SPDP</label>
                                                        <div class="row mb-5 container-field">
                                                            <div class="col-lg-6 col-sm-12 mb-4 mb-lg-0">
                                                                <input type="file" class="dropify" disabled="disabled"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-light" data-bs-dismiss="modal" >Close</button>
                                                <button class="btn btn-primary" >Save changes</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection