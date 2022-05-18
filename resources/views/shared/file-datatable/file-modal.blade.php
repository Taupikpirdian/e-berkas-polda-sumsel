<style>
    .card-body-content {
        height: 400px !important;
        overflow-y: auto;
    }

    #resp-table {
        width: 100%;
        display: table;
    }

    #resp-table-body {
        display: table-row-group;
    }

    .resp-table-row {
        display: table-row;
    }

    .table-body-cell {
        display: table-cell;
        border: 1px solid #dddddd;
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
    }
</style>
{{-- SPDP Modal --}}
@if(isset($dp->fileSpdp))
<div wire:ignore class="modal fade" id="modalSpdp_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File SPDP
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <form accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($dp->fileSpdp))
                                        <div class="form-group">
                                            <label class="form-label">SPDP</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <a title="download" href="/download-file/{{ helperEncrypt($dp->fileSpdp->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                                </div>
                                                <input class="form-control form-control-sm" value="{{ $dp->fileSpdp->no_berkas }}" type="text" readonly>
                                            </div>
                                            <div class="mt-2 text-success">
                                                <b>Uploaded:</b> {{ dateIndo($dp->fileSpdp->created_at, true) }},
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($dp->fileSprintSidik))
                                        <div class="form-group">
                                            <label class="form-label">Sprint Sidik</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <a title="download" href="/download-file/{{ helperEncrypt($dp->fileSprintSidik->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                                </div>
                                                <input class="form-control form-control-sm" value="{{ $dp->fileSprintSidik->no_berkas }}" type="text" readonly>
                                            </div>
                                            <div class="mt-2 text-success">
                                                <b>Uploaded:</b> {{ dateIndo($dp->fileSprintSidik->created_at, true) }},
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($dp->fileLp))
                                        <div class="form-group">
                                            <label class="form-label">File LP</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <a title="download" href="/download-file/{{ helperEncrypt($dp->fileLp->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                                </div>
                                                <input class="form-control form-control-sm" value="{{ $dp->fileLp->no_berkas }}" type="text" readonly>
                                            </div>
                                            <div class="mt-2 text-success">
                                                <b>Uploaded:</b> {{ dateIndo($dp->fileLp->created_at, true) }},
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($dp->fileLainnya))
                                        <div class="form-group">
                                            <label class="form-label">File Lainnya</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <a title="download" href="/download-file/{{ helperEncrypt($dp->fileLainnya->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                                </div>
                                                <input class="form-control form-control-sm" value="{{ $dp->fileLainnya->no_berkas }}" type="text" readonly>
                                            </div>
                                            <div class="mt-2 text-success">
                                                <b>Uploaded:</b> {{ dateIndo($dp->fileLainnya->created_at, true) }},
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Berkas Modal --}}
@if(isset($dp->fileP16))
<div wire:ignore class="modal fade" id="modalBerkas_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-berkas') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload Berkas
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">Upload</label>
                                        <div class="form-group" style="display: none;">
                                            <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                        </div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files" class="file-browserinput" style="display: none;" required>
                                            </label>
                                        </div>
                                        <div class="form-group coupon_question">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan" rows="3"></textarea>
                                        </div>
                                        @if(isset($dp->fileResumeBerkasPerkara))
                                            <div class="mt-2 text-success">
                                                <b>Last Uploaded:</b> {{ dateIndo($dp->fileResumeBerkasPerkara->created_at, true) }},
                                                <br>
                                                <b>Nama File:</b>
                                                <a href="/download-file/{{ helperEncrypt($dp->fileResumeBerkasPerkara->id) }}" target="_blank">
                                                    {{ $dp->fileResumeBerkasPerkara->original_name }}
                                                </a>
                                                <br>
                                                <b>Catatan:</b> {{ $dp->fileResumeBerkasPerkara->catatan }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- SPDP Modal --}}
@if(isset($dp->fileSpdp))
<div wire:ignore class="modal fade" id="editPenyidikByPerkara_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Penyidik
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <form method="post" action="{{ route('update-penyidik-by-perkara') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <h6>Pilih Penyidik</h6>
                                    <input type="text" value="{{$dp->id}}" name="perkara_id" style="display: none;">
                                    <div id="resp-table">
                                        <div id="resp-table-body">
                                            <div class="resp-table-row">
                                                <div class="table-body-cell">
                                                    
                                                </div>
                                                <div class="table-body-cell">
                                                    No
                                                </div>
                                                <div class="table-body-cell">
                                                    NRP
                                                </div>
                                                <div class="table-body-cell">
                                                    Name
                                                </div>
                                            </div>
                                            @forelse ($users as $i=>$user)
                                            <div class="resp-table-row">
                                                <div class="table-body-cell">
                                                    <input type="checkbox" value="{{$user->id}}" name="penyidik_id" required>
                                                </div>
                                                <div class="table-body-cell">
                                                    {{ $i + 1 }}
                                                </div>
                                                <div class="table-body-cell">
                                                    {{ $user->penyidik ? $user->penyidik->nrp : '-' }}
                                                </div>
                                                <div class="table-body-cell">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                            @empty
                                            {{-- data kosong --}}
                                            @endforelse
                                        </div>
                                    </div>
                                            
                                    <div class="form-group mt-5 float-end">
                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Save Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif