<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                Tambah Izin Geledah
            </div>
            <div class="card-body pt-2">
                <form method="post" action="{{ route('izin-pengadilan.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="display: none">
                        <label class="form-label">Mode :</label>
                        <input class="form-control form-control-sm mb-4" name="fitur" type="text" value="{{ request()->fitur }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">User Pengirim :</label>
                        <input class="form-control form-control-sm mb-4" type="text" value="{{Auth::user()->name}}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No LP <label style="color:red">*</label></label>
                        <input class="form-control form-control-sm mb-4" name="no_lp" value="{{old('no_lp')}}" placeholder="Masukan no lp" type="text" required>
                        @error('no_lp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal No LP <label style="color:red">*</label></label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                            <input class="form-control" id="datepicker-date" name="date_no_lp" value="{{old('date_no_lp')}}" placeholder="DD/MM/YYYY" type="text" required>
                        </div>
                        @error('date_no_lp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Penyidik <label style="color:red">*</label></label>
                        <input class="form-control form-control-sm mb-4" name="penyidik" value="{{old('penyidik')}}" placeholder="Masukan Penyidik" type="text" required>
                        @error('penyidik')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">NRP <label style="color:red">*</label></label>
                        <input class="form-control form-control-sm mb-4" name="nrp" value="{{old('nrp')}}" placeholder="Masukan NRP" type="text" required>
                        @error('nrp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">No Hp <label style="color:red">*</label></label>
                        <input placeholder="Masukan no hp" class="form-control" maxlength="15" type="text" name="no_hp" oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*)\./g, '$1');" required/>
                        @error('no_hp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Surat Permohonan </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="surat_permohonan" value="{{old('surat_permohonan')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('surat_permohonan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Resume/Lapju </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="resume_lapju" value="{{old('resume_lapju')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('resume_lapju')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File SPDP </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="spdp" value="{{old('spdp')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('spdp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Surat Perintah Penyidikan </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="penyidikan" value="{{old('penyidikan')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('penyidikan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Surat Perintah Penyelidikan </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="penyelidikan" value="{{old('penyelidikan')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('penyelidikan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Surat Perintah Penggeledahan </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="penggeledahan" value="{{old('penggeledahan')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('penggeledahan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Berita Acara Penggeledahan </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="ba_penggeledahan" value="{{old('ba_penggeledahan')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('ba_penggeledahan')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Berita Acara Keterangan Saksi/Tersangka </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="ba_saksi" value="{{old('ba_saksi')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('ba_saksi')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Surat Tanda Penerimaan Barang Bukti </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="surat_penerimaan_barang_bukti" value="{{old('surat_penerimaan_barang_bukti')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('surat_penerimaan_barang_bukti')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Laporan Polisi </label>
                        <div class="row mb-5 container-field">
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                <input type="file" class="dropify" name="laporan_polisi" value="{{old('laporan_polisi')}}" data-bs-height="180"/>
                            </div>
                        </div>
                        @error('laporan_polisi')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="/laporan-perkara" class="btn btn-warning btn-icon text-white" wire:click="indexLaporanPerkara">
                            <span>
                                <i class="fe fe-log-in"></i>
                            </span> Kembali
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                    </div>

                    <!-- modal -->
                    @include('shared.kepolisian.create-modal-perkara')
                    <!-- end modal  -->
                </form>
            </div>
        </div>
    </div>
</div>