<style>
    .modal-content-kejaksaan {
        margin-top: 5rem;
    }

    .card-body-content {
        height: 400px !important;
        overflow-y: auto;
    }
</style>

@hasanyrole('kepolisian|admin-kejaksaan|pengadilan')
<!-- modal assign perkara -->
<div class="modal " id="modal-jaksa{{$dp->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-kejaksaan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Assign Kasus
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <form method="post" action="{{ route('create-jaksa') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label form-label-required">No LP</label>
                                        <input class="form-control form-control-sm mb-4" value="{{$dp->no_lp ? $dp->no_lp : ''}}" placeholder="Masukan no lp" type="text" readonly>
                                        @error('no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal No LP</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" value="{{ date('d M Y', strtotime($dp->date_no_lp)) }}" placeholder="DD/MM/YYYY" type="text" readonly>
                                        </div>
                                        @error('date_no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">No SPDP</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <a title="download" href="/download-file/{{ helperEncrypt($dp->fileSpdp ? $dp->fileSpdp->id : '')}}"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                            </div>
                                            <input class="form-control form-control-sm" name="no_lp" value="{{ $dp->fileSpdp ? $dp->fileSpdp->no_berkas : '' }}" placeholder="Masukan no lp" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="custom-switch">
                                            <input onchange="valueChanged()" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" required>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Approve perkara</span>
                                        </label>
                                    </div>

                                    <div class="form-group" style="display: none;">
                                        <label class="form-label form-label-required">No LP</label>
                                        <input class="form-control form-control-sm mb-4" name="perkara_id" value="{{$dp ? $dp->id : ''}}" placeholder="Masukan no lp" type="text">
                                    </div>

                                    <div class="form-group coupon_question" style="display: none;" wire:ignore>
                                        <label class="form-label form-label-required">List Jaksa</label>
                                        <select name="jaksa[]" class="form-control select-dua" multiple="multiple" required>
                                            @foreach($jaksas as $jk)
                                            <option value="{{ $jk->jpu->id }}">{{ $jk->jpu->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('jaksa')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group coupon_question" style="display: none;" wire:ignore>
                                        <label class="form-label">List Operator</label>
                                        <select name="operator[]" class="form-control select-dua" multiple="multiple">
                                            @foreach($operators as $op)
                                            <option value="{{ $op->id }}">{{ $op->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('operator')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group coupon_question" style="display: none;">
                                        <label class="form-label form-label-required">File P16</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        <div class="mt-2 text-warning">
                                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> File P16 hanya bisa diakses oleh admin dan jaksa
                                        </div>
                                    </div>

                                    <div class="form-group coupon_question" style="display: none;">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan" rows="3"></textarea>
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal hentikan perkara -->
<div class="modal " id="modal_henti_{{$dp->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-kejaksaan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Hentikan Perkara
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <form method="post" action="{{ route('hentikan-perkara') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" style="display: none;">
                                        <input class="form-control form-control-sm mb-4" type="text" name="perkara_id" value="{{$dp->id}}">
                                    </div>
                                    
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">Status</label>
                                        <div class="input-group mb-4 file-browser">
                                            <select class="form-control" data-placeholder="Pilih Status" name="status" required>
                                                <optgroup label="Pilih Status">
                                                    <option value="7">RJ</option>
                                                    <option value="8">SP3</option>
                                                </optgroup> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Penghentian Perkara</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" name="files" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group coupon_question">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan" rows="3"></textarea>
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endhasanyrole

@hasanyrole('admin-kejaksaan')
<!-- modal assign perkara -->
<div class="modal " id="modal-edit-jaksa{{$dp->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-kejaksaan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Jaksa
                            </div>
                            <div class="card-body pt-2 card-body-content">
                                <form method="post" action="{{ route('edit-jaksa') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" value="{{$dp->id}}" name="perkara_id" style="display: none;">

                                    <div class="form-group coupon_question" wire:ignore>
                                        <label class="form-label form-label-required">List Jaksa</label>
                                        <select name="jaksa[]" class="form-control edit-jaksa" multiple="multiple" required>
                                            @foreach($jaksas as $jk)
                                            <option value="{{ $jk->jpu->id }}">{{ $jk->jpu->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('jaksa')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr />

                                    <div class="form-group float-end">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endhasanyrole

@hasanyrole('kejaksaan')
<!-- create file p17 -->
<div class="modal fade" id="createFileP17{{$dp->id}}" class="myModal">
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
                                <form method="post" action="{{ route('create-file') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label">No LP</label>
                                        <input class="form-control form-control-sm mb-4" name="no_lp" value="{{$dp->no_lp}}" placeholder="Masukan no lp" type="text" readonly>
                                        @error('no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanggal No LP</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" name="date_no_lp" value="{{ date('d M Y', strtotime($dp->date_no_lp)) }}" placeholder="DD/MM/YYYY" type="text" readonly>
                                        </div>
                                        @error('date_no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">No SPDP</label>
                                        <input class="form-control form-control-sm mb-4" name="no_lp" value="{{ $dp->perkara ? $dp->perkara->fileSpdp->no_berkas : '' }}" placeholder="Masukan no lp" type="text" readonly>
                                    </div>

                                    <div class="form-group" style="display: none;">
                                        <label class="form-label">No LP</label>
                                        <input class="form-control form-control-sm mb-4" name="perkara_id" value="{{$dp->id}}" placeholder="Masukan no lp" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">No SPDP</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <a title="download" href="/download-file/{{ $dp->perkara ? helperEncrypt($dp->perkara->fileSpdp->id) : '' }}"><i class="fa fa-download tx-16 lh-0 op-6"></i></a>
                                            </div>
                                            <input class="form-control form-control-sm" name="no_lp" value="{{ $dp->perkara ? $dp->perkara->fileSpdp->no_berkas : '' }}" placeholder="Masukan no lp" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">File P17</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" readonly>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" name="files" class="file-browserinput" style="display: none;" multiple>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Catatan</label>
                                        <textarea class="form-control form-control-sm mb-4" id="catatan" name="catatan" rows="3"></textarea>
                                    </div>


                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endhasanyrole