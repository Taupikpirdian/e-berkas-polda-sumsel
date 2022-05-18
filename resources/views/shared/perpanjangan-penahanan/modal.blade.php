<style>
    .card-body-content {
        height: 400px !important;
        overflow-y: auto;
    }
</style>
<!-- detail perpanjangan penahanan -->
<div class="modal fade" id="detailPerpanjangan{{$perpanjanganPenahanans->datapenahanan_id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Detail Perpanjangan Penahanan
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                @if(isset($perpanjanganPenahanans->perpanjanganPenahanan))
                                <form accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Nomor t4</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->nomor_t4 : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanggal T4</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? dateindo($perpanjanganPenahanans->perpanjanganPenahanan->tanggal_t4) : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Nomor Permintaan Perpanjangan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->nomor_permintaan_perpanjangan : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanggal Permintaan Perpanjangan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? dateindo($perpanjanganPenahanans->perpanjanganPenahanan->tanggal_permintaan_perpanjangan) : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Uraian Kejadian</label>
                                        <div class="input-group">
                                            <textarea name="" id="" cols="30" rows="5" class="form-control" readonly>{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->nomor_permintaan_perpanjangan : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Lama Perpanjangan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->lama_perpanjangan : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanggal Perpanjangan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? dateindo($perpanjanganPenahanans->perpanjanganPenahanan->tanggal_perpanjangan_penahanan) : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Rumah Tahanan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->rumahTahanan->name : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanda Tangan</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" value="{{ $perpanjanganPenahanans->perpanjanganPenahanan ? $perpanjanganPenahanans->perpanjanganPenahanan->tandaTangan->name : '' }}" type="text" readonly>
                                        </div>
                                    </div>

                                    @if(isset($perpanjanganPenahanans->perpanjanganPenahanan->filePerpanjanganPenahanan))
                                    <div class="mt-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($perpanjanganPenahanans->perpanjanganPenahanan->filePerpanjanganPenahanan->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b> <a href="/download-perpanjangan-penahanan/{{ helperEncrypt($perpanjanganPenahanans->perpanjanganPenahanan->filePerpanjanganPenahanan->id) }}">{{ $perpanjanganPenahanans->perpanjanganPenahanan->filePerpanjanganPenahanan->original_name }}</a>
                                        <br>
                                    </div>
                                    @endif
                                </form>
                                @else
                                <div class="row">
                                    <div class="col-sm text-center">
                                    <p class="mt-5">Perpanjangan Penahanan Anda Kosong</p>
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