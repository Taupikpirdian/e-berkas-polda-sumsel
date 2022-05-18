{{-- Start Assign Perkara Ke Pengadilan --}}
<div wire:ignore class="modal fade" id="modalAssignPengadilan_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('limpah-assign-pengadilan') }}" accept-charset="UTF-8"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Assign Pengadilan
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    <div class="form-group coupon_question" wire:ignore>
                                        <label class="form-label">List Pengadilan</label>
                                        <select name="pengadilan" class="form-control select-dua">
                                            @foreach($pengadilans as $p)
                                            <option value="{{ $p->user_id }}">{{ $p->user_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pengadilan')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File P31</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose"
                                                required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files"
                                                    class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Assign Perkara Ke Pengadilan --}}

{{-- Start Modal Upload File --}}
<div wire:ignore class="modal fade" id="modalUploadFileP31_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('upload-file-limpah') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P31
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    {{-- start wajib --}}
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="code_file" value="{{ \App\Constant::P31 }}">
                                    </div>
                                    {{-- end wajib --}}
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File P31</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose"
                                                required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files"
                                                    class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan"
                                            rows="3"></textarea>
                                    </div>
                                    @if(isset($dp->fileP31))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP31->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b>
                                            <a href="/download-file/{{ helperEncrypt($dp->fileP31->id) }}">
                                                {{ $dp->fileP31->original_name }}
                                            </a>
                                            <br>
                                            <b>Catatan:</b> {{ $dp->fileP31->catatan }}
                                        </div>
                                    @endif
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

<div wire:ignore class="modal fade" id="modalUploadFileP33_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('upload-file-limpah') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P33
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    {{-- start wajib --}}
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="code_file" value="{{ \App\Constant::P33 }}">
                                    </div>
                                    {{-- end wajib --}}
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File P33</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose"
                                                required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files"
                                                    class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan"
                                            rows="3"></textarea>
                                    </div>
                                    @if(isset($dp->fileP33))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP33->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b>
                                            <a href="/download-file/{{ helperEncrypt($dp->fileP33->id) }}">
                                                {{ $dp->fileP33->original_name }}
                                            </a>
                                            <br>
                                            <b>Catatan:</b> {{ $dp->fileP33->catatan }}
                                        </div>
                                    @endif
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

<div wire:ignore class="modal fade" id="modalUploadFileP34_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('upload-file-limpah') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload P34
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    {{-- start wajib --}}
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="code_file" value="{{ \App\Constant::P34 }}">
                                    </div>
                                    {{-- end wajib --}}
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File P34</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose"
                                                required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files"
                                                    class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan"
                                            rows="3"></textarea>
                                    </div>
                                    @if(isset($dp->fileP34))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileP34->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b>
                                            <a href="/download-file/{{ helperEncrypt($dp->fileP34->id) }}">
                                                {{ $dp->fileP34->original_name }}
                                            </a>
                                            <br>
                                            <b>Catatan:</b> {{ $dp->fileP34->catatan }}
                                        </div>
                                    @endif
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


<div wire:ignore class="modal fade" id="modalUploadFileRendak_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('upload-file-limpah') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload Rendak
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    {{-- start wajib --}}
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="code_file" value="{{ \App\Constant::FILE_RENDAK }}">
                                    </div>
                                    {{-- end wajib --}}
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Rendak</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose"
                                                required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files"
                                                    class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan"
                                            rows="3"></textarea>
                                    </div>
                                    @if(isset($dp->fileRendak))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileRendak->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b>
                                            <a href="/download-file/{{ helperEncrypt($dp->fileRendak->id) }}">
                                                {{ $dp->fileRendak->original_name }}
                                            </a>
                                            <br>
                                            <b>Catatan:</b> {{ $dp->fileRendak->catatan }}
                                        </div>
                                    @endif
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

{{-- END Modal Upload File --}}

{{-- start modal preview --}}
<div wire:ignore class="modal fade" id="modalPreviewFileP31_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P31
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    <label class="form-label form-label-required">Upload</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download"
                                                href="/download-file/{{ helperEncrypt($dp->fileP31 ? $dp->fileP31->id : '-')}}"><i
                                                    class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text"
                                            readonly>
                                    </div>
                                    @if(isset($dp->fileP31))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP31->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a
                                            href="/download-file/{{ helperEncrypt($dp->fileP31->id) }}">{{ $dp->fileP31->original_name }}</a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP31->catatan }}
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

<div wire:ignore class="modal fade" id="modalPreviewFileP33_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P33
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    <label class="form-label form-label-required">Upload</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download"
                                                href="/download-file/{{ helperEncrypt($dp->fileP33 ? $dp->fileP33->id : '-')}}"><i
                                                    class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text"
                                            readonly>
                                    </div>
                                    @if(isset($dp->fileP33))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP33->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a
                                            href="/download-file/{{ helperEncrypt($dp->fileP33->id) }}">{{ $dp->fileP33->original_name }}</a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP33->catatan }}
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

<div wire:ignore class="modal fade" id="modalPreviewFileP34_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File P34
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    <label class="form-label form-label-required">Upload</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download"
                                                href="/download-file/{{ helperEncrypt($dp->fileP34 ? $dp->fileP34->id : '-')}}"><i
                                                    class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text"
                                            readonly>
                                    </div>
                                    @if(isset($dp->fileP34))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileP34->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a
                                            href="/download-file/{{ helperEncrypt($dp->fileP34->id) }}">{{ $dp->fileP34->original_name }}</a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileP34->catatan }}
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

<div wire:ignore class="modal fade" id="modalPreviewFileRendak_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File Rendak
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    <label class="form-label form-label-required">Upload</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <a title="download"
                                                href="/download-file/{{ helperEncrypt($dp->fileRendak ? $dp->fileRendak->id : '-')}}"><i
                                                    class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                        </div>
                                        <input class="form-control form-control-sm" value="Download File" type="text"
                                            readonly>
                                    </div>
                                    @if(isset($dp->fileRendak))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dp->fileRendak->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a
                                            href="/download-file/{{ helperEncrypt($dp->fileRendak->id) }}">{{ $dp->fileRendak->original_name }}</a>
                                        <br>
                                        <b>Catatan:</b> {{ $dp->fileRendak->catatan }}
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
{{-- End Modal Preview --}}