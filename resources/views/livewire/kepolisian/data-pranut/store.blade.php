@section('css')
<style>
    .card-body-custom {
        bottom: 40px;
    }

    .card-custom {
        height: 680px;
    }

    .form-custom {
        width: 100%;
        padding: 8px;
        border: 1px solid #EAEDF1;
        border-radius: 4px;
        resize: vertical;
    }
    .card-header{
        font-weight: bold;
    }

    .color-red {
        color: red;
    }

    .badge {
        background-color: #3DDC97;
    }
</style>
{{-- class scroll: content-scroll-file --}}
@endsection
<div>
    @include('include.loading-target')
    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" wire:submit.prevent="validateData">
    @csrf
        <div class="container mt-5">
            <!-- Row File -->
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            Upload File Data Prapenuntutan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">No Spdp</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model.lazy='no_berkas_spdp' placeholder="Masukan No SPDP"/>
                                        @error('no_berkas_spdp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File SPDP</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_spdp' id="file_spdp" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_spdp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_spdp))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_spdp['id']) }}">{{ $file_spdp['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_spdp" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_spdp" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_spdp">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_spdp" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_spdp" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">No Sprint Sidik</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model.lazy='no_berkas_sidik' placeholder="Masukan No Sprint Sidik"/>
                                        @error('no_berkas_sidik')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File Sprint Sidik</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='sprint_sidik' id="sprint_sidik" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('sprint_sidik')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($sprint_sidik))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($sprint_sidik['id']) }}">{{ $sprint_sidik['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_sprint_sidik" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_sprint_sidik" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_sprint_sidik">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_sprint_sidik" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_sprint_sidik" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">Nomor LP</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model.lazy='no_lp' placeholder="Masukan No Lp"/>
                                        @error('no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File LP</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_lp' id="file_lp" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_lp))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_lp['id']) }}">{{ $file_lp['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_lp" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_lp" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_lp">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_lp" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_lp" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Nomor Lainnya</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model.lazy='no_file_lainnya' placeholder="Masukan No Berita Lainnya"/>
                                        @error('no_file_lainnya')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">File Lainnya</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_lainnya' id="file_lainnya" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_lainnya')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_lainnya))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_lainnya['id']) }}">{{ $file_lainnya['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_lainnya" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_lainnya" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_lainnya">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_lainnya" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_lainnya" wire:ignore></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row Data Pranut --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Tambah Data Perkara
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal No LP</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" type="text" wire:model='date_no_lp' id="date_no_lp" placeholder="DD/MM/YYYY" autocomplete="off">
                                        </div>
                                        @error('date_no_lp')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                
                                    <div class="form-group" wire:ignore>
                                        <label class="form-label form-label-required">Jenis Pidana</label>
                                        <select class="form-control select2-show-search" wire:model.lazy='jns_pidana_id' id="jns_pidana_id" data-placeholder="Pilih Jenis Pidana">
                                            <optgroup label="Pilih Jenis Pidana">
                                            @foreach($listJnsPidana as $jp)
                                            <option value="{{$jp->id}}">{{$jp->name}}</option>
                                            @endforeach
                                            </optgroup> 
                                        </select>
                                        @error('jns_pidana_id')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Kronologi</label>
                                        <textarea class="form-control form-control-sm mb-4" cols="30" rows="10" wire:model.lazy='kronologi' placeholder="Masukan Kronologi"></textarea>
                                        @error('kronologi')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Satuan Kerja</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model='satuan_kerja' readonly>
                                        @error('penyidik')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Penyidik</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model='penyidik' placeholder="Kosong" readonly>
                                        @if($penyidik == 'Kosong')
                                        <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Data profil user belum lengkap, klik <a href="/profiles">disini</a> untuk melengkapi</div>
                                        @endif
                                    </div>
                
                                    <div class="form-group">
                                        <label class="form-label">NRP</label>
                                        <input class="form-control form-control-sm mb-4" type="text" wire:model='nrp' placeholder="Kosong" readonly>
                                        @if($nrp == 'Kosong')
                                        <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Data profil user belum lengkap, klik <a target="_blank" href="/profiles">disini</a> untuk melengkapi</div>
                                        @endif
                                    </div>
                
                                    <div class="form-group">
                                        <label class="form-label">No Hp</label>
                                        <input class="form-control" type="text" wire:model='no_hp' maxlength="15" oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Kosong" readonly/>
                                        @if($no_hp == 'Kosong')
                                        <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Data profil user belum lengkap, klik <a target="_blank" href="/profiles">disini</a> untuk melengkapi</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row Tersangka --}}
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            Tambah Tersangka
                        </div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-sm-3 col-md-4 col-xl-3">
                                    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#scrollingmodal">Tambah</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="center-align">
                                            <th>No</th>
                                            <th class="text-nowrap align-middle">NIK</th>
                                            <th class="text-nowrap align-middle">Nama Tersangka</th>
                                            <th class="text-nowrap align-middle">Tempat Lahir</th>
                                            <th class="text-nowrap align-middle">Tanggal Lahir</th>
                                            <th class="text-nowrap align-middle">Jenis Kelamin</th>
                                            <th class="text-nowrap align-middle">Kebangsaan</th>
                                            <th class="text-nowrap align-middle">Alamat</th>
                                            <th class="text-nowrap align-middle">Agama</th>
                                            <th class="text-nowrap align-middle">Pekerjaan</th>
                                            <th class="text-nowrap align-middle">Pendidikan</th>
                                            <th class="text-nowrap align-middle">Pasal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($array_pelaku as $key=>$ap)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ap['nik'] ? $ap['nik'] : '-' }}</td>
                                            <td>{{ $ap['nama_tersangka'] ? $ap['nama_tersangka'] : '-' }}</td>
                                            <td>{{ $ap['tempat_lahir'] ? $ap['tempat_lahir'] : '-' }}</td>
                                            <td>{{ $ap['tanggal_lahir'] ? $ap['tanggal_lahir'] : '-' }}</td>
                                            <td>{{ $ap['jenis_kelamin'] ? $ap['jenis_kelamin'] : '-' }}</td>
                                            <td>{{ $ap['kebangsaan'] ? $ap['kebangsaan'] : '-' }}</td>
                                            <td>{{ $ap['alamat'] ? $ap['alamat'] : '-' }}</td>
                                            <td>{{ $ap['agama'] ? $ap['agama'] : '-' }}</td>
                                            <td>{{ $ap['pekerjaan'] ? $ap['pekerjaan'] : '-' }}</td>
                                            <td>{{ $ap['pendidikan'] ? $ap['pendidikan'] : '-' }}</td>
                                            <td>{{ $ap['pasal'] ? $ap['pasal'] : '-' }}</td>
                                            <td>
                                                <a type="button" wire:click.prevent="removePelaku({{ $key }})"><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="13">
                                                Data Kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row Submit -->
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm">
                                    <a href="{{ route('data-prapenuntutan.index') }}" class="btn btn-warning btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                        <div class="card-header">
                            <div class="row mt-2">
                                <div class="col-sm">
                                    <span class="error color-red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Terdapat kesalahan input data, harap cek kembali form isian!</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- modal -->
    @include('livewire.kepolisian.component.modal-pelaku')
    <!-- end modal  -->
</div>
@section('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // validasi form file
        var _validFileExtensions = ["pdf"];

        function validateFiles(file, idForm) {
            let extFile = true;
            extFile = isValidExtention(file.name);
            let sizeFile = file.size / 1024; // dalam kb

            if (sizeFile > 2024) {
                Swal.fire({
                    title: '<b>Error!</b>',
                    icon: 'error',
                    html: "Ukuran File tidak sesuai, Ukuran File yang diizinkan adalah maksimal 2MB<br><i>You are only allowed to upload file with max size of 2MB</i>"                });
                $(file).val(''); // for clearing with Jquery
                document.getElementById(idForm).value = null;
                window.livewire.emit('clearFormFile', idForm);

                return false;
            }
            
            if (!extFile) {
                Swal.fire({
                    title: '<b>Error!</b>',
                    icon: 'error',
                    html: "Format file tidak sesuai<br>File yang diizinkan adalah file dengan format pdf<br><i>You are only allowed to upload with pdf file format</i>"                });
                $(file).val(''); // for clearing with Jquery
                document.getElementById(idForm).value = null;
                window.livewire.emit('clearFormFile', idForm);

                return false;
            }

            return true;
        }

        function isValidExtention(name) {
            let ext = name.slice((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
            return _validFileExtensions.includes(ext) ? true : false;
        }

        // hide modal
        window.livewire.on('closeModal', ($modal) => {
            $($modal).modal('hide');
        });
        // show modal
        window.livewire.on('showModal', ($modal) => {
            $($modal).modal('show');
        });

        // date_no_lp
        $('#date_no_lp').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
        })
        $('#date_no_lp').on('change', function (e) {
            @this.set('date_no_lp', e.target.value);
        });

        // data select2 jenis_pidana
        $('#jns_pidana_id').on('change', function(e) {
            @this.set('jns_pidana_id', e.target.value);
        });
        // data select2 jenis_kelamin
        $('#jenis_kelamin').on('change', function(e) {
            @this.set('jenis_kelamin', e.target.value);
        });
        // data select2 kebangsaan
        $('#kebangsaan').on('change', function(e) {
            @this.set('kebangsaan', e.target.value);
        });
        // data select2 agama
        $('#agama').on('change', function(e) {
            @this.set('agama', e.target.value);
        });
        // data select2 pendidikan
        $('#pendidikan').on('change', function(e) {
            @this.set('pendidikan', e.target.value);
        });

        window.livewire.on('confirmSubmit', () => {
            setTimeout(function(){
                Swal.fire({
                title: 'Apakah Anda yakin akan menyimpan data ini?',
                text: "Harap cek kembali sampai Anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Simpan!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                cancelButtonText: 'Cek Dahulu',
                buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        window.livewire.emit('store');
                    }
                });

            }, 1000);
        });

        // upload file spdp
        $('#file_spdp').on('change', function () {
            let idForm = 'file_spdp';
            // clear data
            $('#badge_file_spdp').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                // prepare data ...
                $('#prepare_file_spdp').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_spdp').addClass('d-none');
                    $('#badge_file_spdp').removeClass('d-none');
                    $('#badge_file_spdp').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('error upload spdp');
                }, (event) => {
                    console.log(event.detail);
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_spdp').addClass('d-none');
                    $('#progress_file_spdp').removeClass('d-none');
                    document.getElementById("loading_file_spdp").style.width = `${event.detail.progress}%`;
                    $('#loading_file_spdp').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file sprint_sidik
        $('#sprint_sidik').on('change', function () {
            let idForm = 'sprint_sidik';
            // clear data
            $('#badge_sprint_sidik').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_sprint_sidik').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_sprint_sidik').addClass('d-none');
                    $('#badge_sprint_sidik').removeClass('d-none');
                    $('#badge_sprint_sidik').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload sprint sidik error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_sprint_sidik').addClass('d-none');
                    $('#progress_sprint_sidik').removeClass('d-none');
                    document.getElementById("loading_sprint_sidik").style.width = `${event.detail.progress}%`;
                    $('#loading_sprint_sidik').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file lp
        $('#file_lp').on('change', function () {
            let idForm = 'file_lp';
            // clear data
            $('#badge_file_lp').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_lp').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_lp').addClass('d-none');
                    $('#badge_file_lp').removeClass('d-none');
                    $('#badge_file_lp').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload sprint tugas error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_lp').addClass('d-none');
                    $('#progress_file_lp').removeClass('d-none');
                    document.getElementById("loading_file_lp").style.width = `${event.detail.progress}%`;
                    $('#loading_file_lp').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file file_lainnya
        $('#file_lainnya').on('change', function () {
            let idForm = 'file_lainnya';
            // clear data
            $('#badge_file_lainnya').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_lainnya').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_lainnya').addClass('d-none');
                    $('#badge_file_lainnya').removeClass('d-none');
                    $('#badge_file_lainnya').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file ba error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_lainnya').addClass('d-none');
                    $('#progress_file_lainnya').removeClass('d-none');
                    document.getElementById("loading_file_lainnya").style.width = `${event.detail.progress}%`;
                    $('#loading_file_lainnya').html(`${event.detail.progress}%`);
                })
            }
        });
    });
</script>
@endsection