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
<!-- detail berita acara -->
<div class="modal fade" id="detailBeritaAcara{{$beritaAcaras->id}}" class="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Detail
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <label class="form-label">Formil</label>
                                <div id="resp-table">
                                    <div id="resp-table-body">
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                No
                                            </div>
                                            <div class="table-body-cell">
                                                Name
                                            </div>
                                        </div>
                                        @forelse($beritaAcaras->formil as $key=>$pj)
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                {{ $key + 1 }}
                                            </div>
                                            <div class="table-body-cell">
                                                {{ $pj->name ? $pj->name : '' }}
                                            </div>
                                        </div>
                                        @empty
                                        {{-- data kosong --}}
                                        @endforelse
                                    </div>
                                </div>
                                <label class="form-label">Materil</label>
                                <div id="resp-table">
                                    <div id="resp-table-body">
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                No
                                            </div>
                                            <div class="table-body-cell">
                                                Name
                                            </div>
                                        </div>
                                        @forelse($beritaAcaras->materil as $key=>$pj)
                                        <div class="resp-table-row">
                                            <div class="table-body-cell">
                                                {{ $key + 1 }}
                                            </div>
                                            <div class="table-body-cell">
                                                {{ $pj->name ? $pj->name : '' }}
                                            </div>
                                        </div>
                                        @empty
                                        {{-- data kosong --}}
                                        @endforelse
                                    </div>
                                </div>
                                <label class="form-label">Surat Perintah</label>
                                <textarea name="" id="" rows="5" class="form-control" readonly>{{$beritaAcaras->surat_perintah}}</textarea>
                                <label class="form-label">Tanggal Surat Perintah</label>
                                <input class="form-control form-control-sm" type="text"value="{{dateIndo($beritaAcaras->tanggal, false, false)}}" readonly>
                                <label class="form-label">Alamat</label>
                                <textarea name="" id="" rows="5" class="form-control" readonly>{{$beritaAcaras->alamat}}</textarea>
                                <label class="form-label">Kesimpulan</label>
                                <textarea name="" id="" rows="5" class="form-control" readonly>{{$beritaAcaras->kesimpulan}}</textarea>
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