{{-- P17 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP17_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p17') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P17
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
                                        @if(isset($dp->fileP17))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP17->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP17->id) }}" target="_blank">{{ $dp->fileP17->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SOP 02 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadSop02_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-sop-02') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload SOP Form 02
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
                                        @if(isset($dp->fileSop02))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileSop02->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileSop02->id) }}" target="_blank">{{ $dp->fileSop02->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- P18 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP18_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p18') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P18
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
                                        @if(isset($dp->fileP18))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP18->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP18->id) }}" target="_blank">{{ $dp->fileP18->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- P19 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP19_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p19') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P19
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
                                        @if(isset($dp->fileP19))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP19->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP19->id) }}" target="_blank">{{ $dp->fileP19->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- P20 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP20_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p20') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P20
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
                                        @if(isset($dp->fileP20))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP20->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP20->id) }}" target="_blank">{{ $dp->fileP20->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- P21 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP21_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p21') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P21
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
                                        @if(isset($dp->fileP21))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP21->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP21->id) }}" target="_blank">{{ $dp->fileP21->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- P21A Modal --}}
<div wire:ignore class="modal fade" id="modalUploadP21A_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-p21a') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P21A
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
                                        @if(isset($dp->fileP21A))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP21A->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileP21A->id) }}" target="_blank">{{ $dp->fileP21A->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Berkas Kembali Modal --}}
<div wire:ignore class="modal fade" id="modalUploadBerkasKembali_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-berkas-kembali') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload Berkas Kembali
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
                                        @if(isset($dp->fileBerkasKembali))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileBerkasKembali->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileBerkasKembali->id) }}" target="_blank">{{ $dp->fileBerkasKembali->original_name }}</a>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>