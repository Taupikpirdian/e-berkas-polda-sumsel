{{-- P16 Only View --}}
@if(isset($dp->fileP16))
<div wire:ignore class="modal fade" id="modalP16_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P16
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P16</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP16 ? $dp->fileP16->id : '-')}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                </div>
                                @if(isset($dp->fileP16))
                                <div class="mt-2 text-success">
                                    <b>Uploaded:</b> {{ dateIndo($dp->fileP16->created_at, true) }},
                                    <br>
                                    <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP16->id) }}" target="_blank">{{ $dp->fileP16->original_name }}</a>
                                    <br>
                                    <b>Catatan:</b> {{ $dp->fileP16->catatan }}
                                </div>
                                @endif
                                <label class="form-label">List Jaksa Terpilih</label>
                                <div id="resp-table">
                                    <div id="resp-table-body">
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                No
                                            </div>
                                            <div class="table-body-cell">
                                                NIP
                                            </div>
                                            <div class="table-body-cell">
                                                Nama Jaksa
                                            </div>
                                        </div>
                                        @forelse($dp->perkaraJaksa as $key=>$pj)
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                {{ $key + 1 }}
                                            </div>
                                            <div class="table-body-cell">
                                                {{ $pj->masterJaksa ? $pj->masterJaksa->nip : '' }}
                                            </div>
                                            <div class="table-body-cell">
                                                {{ $pj->masterJaksa ? $pj->masterJaksa->name : '' }}
                                            </div>
                                        </div>
                                        @empty
                                        {{-- data kosong --}}
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Berkas Only View --}}
@if(isset($dp->fileP16) && isset($dp->fileResumeBerkasPerkara))
<div wire:ignore class="modal fade" id="modalBerkasView_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File Berkas
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">Berkas</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileResumeBerkasPerkara->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P17 Only View --}}
@if(isset($dp->fileP17))
<div wire:ignore class="modal fade" id="modalP17View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P17
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P17</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP17->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP17))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP17->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP17->id) }}" target="_blank">
                                            {{ $dp->fileP17->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP17->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- SOP Form 02 Only View --}}
@if(isset($dp->fileSop02))
<div wire:ignore class="modal fade" id="modalSop02View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File SOP Form 02
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">SOP Form 02</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileSop02->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileSop02))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileSop02->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileSop02->id) }}" target="_blank">
                                            {{ $dp->fileSop02->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileSop02->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P18 Only View --}}
@if(isset($dp->fileP18))
<div wire:ignore class="modal fade" id="modalP18View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P18
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P18</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP18->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP18))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP18->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP18->id) }}" target="_blank">
                                            {{ $dp->fileP18->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP18->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P19 Only View --}}
@if(isset($dp->fileP19))
<div wire:ignore class="modal fade" id="modalP19View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P19
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P19</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP19->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP19))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP19->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP19->id) }}" target="_blank">
                                            {{ $dp->fileP19->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP19->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P20 Only View --}}
@if(isset($dp->fileP20))
<div wire:ignore class="modal fade" id="modalP20View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P20
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P20</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP20->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP20))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP20->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP20->id) }}" target="_blank">
                                            {{ $dp->fileP20->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP20->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P21 Only View --}}
@if(isset($dp->fileP21))
<div wire:ignore class="modal fade" id="modalP21View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P21
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P21</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP21->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP21))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP21->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP21->id) }}" target="_blank">
                                            {{ $dp->fileP21->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP21->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- P21A Only View --}}
@if(isset($dp->fileP21A))
<div wire:ignore class="modal fade" id="modalP21AView_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P21A
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">P21A</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileP21A->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileP21A))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP21A->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileP21A->id) }}" target="_blank">
                                            {{ $dp->fileP21A->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP21A->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif

{{-- Berkas Kembali Only View --}}
@if(isset($dp->fileBerkasKembali))
<div wire:ignore class="modal fade" id="modalBerkasKembaliView_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File Berkas Kembali
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group">
                                    <label class="form-label">Berkas Kembali</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download" href="/download-file/{{ helperEncrypt($dp->fileBerkasKembali->id)}}" target="_blank"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                    </div>
                                    @if(isset($dp->fileBerkasKembali))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileBerkasKembali->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dp->fileBerkasKembali->id) }}" target="_blank">
                                            {{ $dp->fileBerkasKembali->original_name }}
                                        </a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileBerkasKembali->catatan }}
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
            </div>
        </div>
    </div>
</div>
@endif