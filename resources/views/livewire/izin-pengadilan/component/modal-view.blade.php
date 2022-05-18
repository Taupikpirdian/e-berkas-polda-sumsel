{{-- Pengajuan Modal --}}
<div wire:ignore class="modal fade" id="modalPengajuanIzinSitaView_{{$data->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File Pengajuan Izin Sita
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    @if(isset($data->filePengajuan))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($data->filePengajuan->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a href="/download-file-izin-pengadilan/{{ helperEncrypt($data->filePengajuan->id) }}" target="_blank">{{ $data->filePengajuan->original_name }}</a>
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
        </div>
    </div>
</div>

{{-- Balasan --}}
<div wire:ignore class="modal fade" id="modalBalasanIzinSitaView_{{$data->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                File Balasan Izin Sita
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <div class="form-group coupon_question">
                                    @if(isset($data->fileBalasan))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($data->fileBalasan->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a href="/download-file-izin-pengadilan/{{ helperEncrypt($data->fileBalasan->id) }}" target="_blank">{{ $data->fileBalasan->original_name }}</a>
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
        </div>
    </div>
</div>