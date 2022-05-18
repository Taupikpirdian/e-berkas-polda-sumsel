<style>
    .card-body-content {
        height: 400px !important;
        overflow-y: auto;
    }
</style>
<!-- detail perpanjangan penahanan -->
<div class="modal fade" id="barangBuktiNarkotika{{$dataBukti->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Detail Barang Bukti Narkotika
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                @if(isset($dataBukti))
                                <form accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Nomor Surat Permohonan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{$dataBukti->nosurat_permohonan}}" type="text" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">File Surat Permohonan</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->filePengaju->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->filePengaju ? Crypt::encrypt($dataBukti->filePengaju->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas SPDP</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->perkara->fileSpdp->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->perkara->fileSpdp ? Crypt::encrypt($dataBukti->perkara->fileSpdp->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas SPDIK</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->perkara->fileSprintSidik->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->perkara->fileSprintSidik ? Crypt::encrypt($dataBukti->perkara->fileSprintSidik->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas LP</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->perkara->fileLp->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->perkara->fileLp ? Crypt::encrypt($dataBukti->perkara->fileLp->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas SP Sita</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->fileSpSita->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->fileSpSita ? Crypt::encrypt($dataBukti->fileSpSita->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas BA SITA</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->fileBaCc->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->fileBaCc ? Crypt::encrypt($dataBukti->fileBaCc->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas BA CC</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->fileBaSita->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->fileBaSita ? Crypt::encrypt($dataBukti->fileBaSita->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Berkas Resume</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" value="{{$dataBukti->fileResume->original_name}}" placeholder="Choose">
                                            <a href="/download-barang-bukti-narkotika/{{ $dataBukti->fileResume ? Crypt::encrypt($dataBukti->fileResume->id) : '' }}" class="input-group-text btn btn-primary">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="row">
                                    <div class="col-sm text-center">
                                    <p class="mt-5">Data Anda Kosong</p>
                                    </div>
                                </div>
                                @endif
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

<div wire:ignore class="modal fade" id="modalUploadBalasan_{{$dataBukti->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-data-bukti-narkotika') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Upload Balasan
                                </div>
                                <div class="card-body pt-2 card-body-content">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">Upload</label>
                                        <div class="form-group" style="display: none;">
                                            <input class="form-control form-control-sm mb-4" type="text" name="databukti_id" value="{{$dataBukti->id}}">
                                        </div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file" class="file-browserinput" style="display: none;" required>
                                            </label>
                                        </div>
                                        <div class="form-group coupon_question">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan" rows="3"></textarea>
                                        </div>
                                        @if(isset($dataBukti->filePengaju))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($dataBukti->filePengaju->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-barang-bukti-narkotika/{{ helperEncrypt($dataBukti->filePengaju->id) }}">{{ $dataBukti->filePengaju->name }}</a>
                                            <br>
                                            <b>Catatan:</b> {{ $dataBukti->filePengaju->catatan }}
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