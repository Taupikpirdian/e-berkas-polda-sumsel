<div wire:ignore class="modal fade" id="modalUploadTahap2_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-tahap-2') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload Tahap II
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    <div class="form-group coupon_question">
                                        <div class="form-group" style="display: none;">
                                            <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                        </div>

                                        <label class="form-label">Berkas Perkara</label>
                                        @if(isset($dp->fileResumeBerkasPerkara))
                                            <div class="mt-2 text-success">
                                                <b>Last Uploaded:</b> {{ dateIndo($dp->fileResumeBerkasPerkara->created_at, true) }},
                                                <br>
                                                <b>Nama File:</b> {{ $dp->fileResumeBerkasPerkara->original_name }} <a href="/download-file/{{ helperEncrypt($dp->fileResumeBerkasPerkara->id) }}" title="download"><i class="fe fe-download"></i></a>
                                                <br>
                                                <b>Catatan:</b> {{ $dp->fileResumeBerkasPerkara->catatan }}
                                            </div>
                                        @endif

                                        <label class="form-label form-label-required">Surat Pengantar Tahap II</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_surat_pengantar" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>

                                        <label class="form-label form-label-required">SPHAN</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_sphan" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>

                                        <label class="form-label form-label-required">BAHAN</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_bahan" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>

                                        <label class="form-label form-label-required">SPKAP</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_spkap" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>

                                        <label class="form-label form-label-required">BAKAP</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_bakap" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>

                                        <label class="form-label form-label-required">FC KTP/KK Tersangka</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file_ktp" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        
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

<div wire:ignore class="modal fade" id="modalUploadTahap2View_{{$dp->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Tahap II
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">Upload</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <a title="download" href="/download-file/{{ helperEncrypt($dp->fileTahapII ? $dp->fileTahapII->id : '-')}}"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                            </div>
                                            <input class="form-control form-control-sm" value="Download File" type="text" readonly>
                                        </div>
                                        @if(isset($dp->fileTahapII))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dp->fileTahapII->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-file/{{ helperEncrypt($dp->fileTahapII->id) }}">{{ $dp->fileTahapII->original_name }}</a>
                                            <br>
                                            <b>Catatan:</b> {{ $dp->fileTahapII->catatan }}
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