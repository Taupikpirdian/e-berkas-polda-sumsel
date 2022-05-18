<div wire:ignore class="modal fade" id="modalUploadBalasan_{{$bpacTipiring->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('store-file-bacp-tipiring') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm mb-4" type="text" name="bpac_tipiring_id" value="{{$bpacTipiring->id}}">
                                        </div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="file" class="file-browserinput" style="display: none;" required>
                                            </label>
                                        </div>
                                        @if ($bpacTipiring->fileBpacTipiring)
                                            @if ($bpacTipiring->fileBpacTipiring->code == 2 && $bpacTipiring->fileBpacTipiring->code != 1)
                                                <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a
                                                        href="/download-file-bacp-tipiring/{{ helperEncrypt($bpacTipiring->fileBpacTipiring) }}/{{$bpacTipiring->fileBpacTipiring->code}}">{{ $bpacTipiring->fileBpacTipiring->name }}</a>
                                                </div>
                                            @endif
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