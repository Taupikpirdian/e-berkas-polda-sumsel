<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Tambah Data {{ $label }}
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label form-label-required">Jenis Penetapan</label>
                            <select class="form-control select2-show-search" wire:model='jns_penetapan_id' id="jns_penetapan_id" data-placeholder="Pilih Jenis Penetapan">
                                <option value="">Pilih</option>
                                @foreach($jenisPenetapans as $key=>$jp)
                                <option value="{{ $jp->id }}">{{ $jp->name }}</option>
                                @endforeach
                            </select>
                            @error('jns_penetapan_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Surat Permohonan Penyidik</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tgl_surat_permohonan' id="tgl_surat_permohonan" placeholder="DD/MM/YYYY" autocomplete="off">
                            </div>
                            @error('tgl_surat_permohonan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Surat Perintah Penggeledahan</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tgl_surat_perintah' id="tgl_surat_perintah" placeholder="DD/MM/YYYY" autocomplete="off">
                            </div>
                            @error('tgl_surat_perintah')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Laporan Polisi</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tgl_lapor' id="tgl_lapor" placeholder="DD/MM/YYYY" autocomplete="off">
                            </div>
                            @error('tgl_lapor')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Berita Acara Penggeledahan</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tgl_ba' id="tgl_ba" placeholder="DD/MM/YYYY" autocomplete="off">
                            </div>
                            @error('tgl_ba')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Penggeledahan Terhadap</label>
                            <select class="form-control select2-show-search" wire:model='penggeledahan_terhadap_id' id="penggeledahan_terhadap_id" data-placeholder="Pilih Penggeledahan Terhadap">
                                <option value="">Pilih</option>
                                @foreach($penggeledahanTerhadaps as $key=>$pt)
                                <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                @endforeach
                            </select>
                            @error('penggeledahan_terhadap_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-label">Satuan Kerja</label>
                                    <input class="form-control form-control-sm" type="text" wire:model='satker' readonly>
                                </div>
                                @hasanyrole('kepolisian')
                                <div class="col-sm">
                                    <label class="form-label">Penyidik</label>
                                    <input class="form-control form-control-sm" type="text" wire:model='penyidik' readonly>
                                </div>
                                @endhasanyrole
                                @hasanyrole('kejaksaan')
                                <div class="col-sm">
                                    <label class="form-label">Jaksa Penuntut Umum</label>
                                    <input class="form-control form-control-sm" type="text" wire:model='jpu' readonly>
                                </div>
                                @endhasanyrole

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Surat Permohonan Penyidik</label>
                            <input class="form-control form-control-sm mb-4" type="text" wire:model='no_surat_permohonan'>
                            @error('no_surat_permohonan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Surat Perintah Penggeledahan</label>
                            <input class="form-control form-control-sm mb-4" type="text" wire:model='no_surat_perintah'>
                            @error('no_surat_perintah')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Lapor Polisi</label>
                            <input class="form-control form-control-sm mb-4" type="text" wire:model='no_lapor'>
                            @error('no_lapor')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Berita Acara Penggeledahan</label>
                            <input class="form-control form-control-sm mb-4" type="text" wire:model='no_ba'>
                            @error('no_ba')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Lokasi</label>
                            <input class="form-control form-control-sm mb-4" type="text" wire:model='lokasi'>
                            @error('lokasi')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>