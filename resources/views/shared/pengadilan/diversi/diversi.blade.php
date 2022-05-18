{{-- P17 Modal --}}
<div wire:ignore class="modal fade" id="modalUploadBalasan_{{$diversi->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-diversi') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm mb-4" type="text" name="diversi_id" value="{{$diversi->id}}">
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
                                        @if(isset($diversi->fileDiversiPengaju))
                                        <div class="mt-2 text-success">
                                            <b>Last Uploaded:</b> {{ dateIndo($diversi->fileDiversiPengaju->created_at, true) }},
                                            <br>
                                            <b>Nama File:</b> <a href="/download-diversi/{{ helperEncrypt($diversi->fileDiversiPengaju->id) }}">{{ $diversi->fileDiversiPengaju->name }}</a>
                                            <br>
                                            <b>Catatan:</b> {{ $diversi->fileDiversiPengaju->catatan }}
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