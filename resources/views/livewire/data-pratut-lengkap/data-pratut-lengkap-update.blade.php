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
                            Upload File Data Tahap II
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File Surat Pengantar Tahap II</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_pengantar' id="file_pengantar" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_pengantar')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_pengantar))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_pengantar['id']) }}">{{ $file_pengantar['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_pengantar" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_pengantar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_pengantar">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_pengantar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_pengantar" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File SPHAN</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_sphan' id="file_sphan" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_sphan')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_sphan))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_sphan['id']) }}">{{ $file_sphan['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_sphan" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_sphan" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_sphan">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_sphan" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_sphan" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File BAHAN</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_bahan' id="file_bahan" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_bahan')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_bahan))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_bahan['id']) }}">{{ $file_bahan['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_bahan" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_bahan" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_bahan">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_bahan" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_bahan" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File SPKAP</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_spkap' id="file_spkap" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_spkap')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_spkap))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_spkap['id']) }}">{{ $file_spkap['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_spkap" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_spkap" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_spkap">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_spkap" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_spkap" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File BAKAP</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_bakap' id="file_bakap" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_bakap')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_bakap))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_bakap['id']) }}">{{ $file_bakap['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_bakap" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_bakap" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_bakap">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_bakap" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_bakap" wire:ignore></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File FC KTP/KK</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose">
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model.lazy='file_ktp_kk' id="file_ktp_kk" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                        @error('file_ktp_kk')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(is_array($file_ktp_kk))
                                        <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a href="/download-file/{{ helperEncrypt($file_ktp_kk['id']) }}">{{ $file_ktp_kk['original_name'] }}</a></div>
                                        @endif
                                        <div class="progress mb-4 d-none" id="prepare_file_ktp_kk" wire:ignore>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file_ktp_kk" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                        </div>
                                        <div class="progress mb-4 d-none" id="progress_file_ktp_kk">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file_ktp_kk" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="badge badge-pill badge-success d-none" id="badge_file_ktp_kk" wire:ignore></span>
                                    </div>
                                </div>
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
                                    <a href="{{ route('data-prapenuntutan-lengkap.index') }}" class="btn btn-warning btn-icon text-white">
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

        // upload file_pengantar
        $('#file_pengantar').on('change', function () {
            let idForm = 'file_pengantar';
            // clear data
            $('#badge_file_pengantar').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                // prepare data ...
                $('#prepare_file_pengantar').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_pengantar').addClass('d-none');
                    $('#badge_file_pengantar').removeClass('d-none');
                    $('#badge_file_pengantar').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('error file_pengantar');
                }, (event) => {
                    console.log(event.detail);
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_pengantar').addClass('d-none');
                    $('#progress_file_pengantar').removeClass('d-none');
                    document.getElementById("loading_file_pengantar").style.width = `${event.detail.progress}%`;
                    $('#loading_file_pengantar').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file file_sphan
        $('#file_sphan').on('change', function () {
            let idForm = 'file_sphan';
            // clear data
            $('#badge_file_sphan').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_sphan').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_sphan').addClass('d-none');
                    $('#badge_file_sphan').removeClass('d-none');
                    $('#badge_file_sphan').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file_sphan error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_sphan').addClass('d-none');
                    $('#progress_file_sphan').removeClass('d-none');
                    document.getElementById("loading_file_sphan").style.width = `${event.detail.progress}%`;
                    $('#loading_file_sphan').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file_bahan
        $('#file_bahan').on('change', function () {
            let idForm = 'file_bahan';
            // clear data
            $('#badge_file_bahan').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_bahan').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_bahan').addClass('d-none');
                    $('#badge_file_bahan').removeClass('d-none');
                    $('#badge_file_bahan').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file_bahan error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_bahan').addClass('d-none');
                    $('#progress_file_bahan').removeClass('d-none');
                    document.getElementById("loading_file_bahan").style.width = `${event.detail.progress}%`;
                    $('#loading_file_bahan').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file file_spkap
        $('#file_spkap').on('change', function () {
            let idForm = 'file_spkap';
            // clear data
            $('#badge_file_spkap').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_spkap').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_spkap').addClass('d-none');
                    $('#badge_file_spkap').removeClass('d-none');
                    $('#badge_file_spkap').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file ba error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_spkap').addClass('d-none');
                    $('#progress_file_spkap').removeClass('d-none');
                    document.getElementById("loading_file_spkap").style.width = `${event.detail.progress}%`;
                    $('#loading_file_spkap').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file file_bakap
        $('#file_bakap').on('change', function () {
            let idForm = 'file_bakap';
            // clear data
            $('#badge_file_bakap').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_bakap').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_bakap').addClass('d-none');
                    $('#badge_file_bakap').removeClass('d-none');
                    $('#badge_file_bakap').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file ba error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_bakap').addClass('d-none');
                    $('#progress_file_bakap').removeClass('d-none');
                    document.getElementById("loading_file_bakap").style.width = `${event.detail.progress}%`;
                    $('#loading_file_bakap').html(`${event.detail.progress}%`);
                })
            }
        });
        // upload file file_ktp_kk
        $('#file_ktp_kk').on('change', function () {
            let idForm = 'file_ktp_kk';
            // clear data
            $('#badge_file_ktp_kk').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if(validate){
                $('#prepare_file_ktp_kk').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file_ktp_kk').addClass('d-none');
                    $('#badge_file_ktp_kk').removeClass('d-none');
                    $('#badge_file_ktp_kk').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('upload file ba error');
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file_ktp_kk').addClass('d-none');
                    $('#progress_file_ktp_kk').removeClass('d-none');
                    document.getElementById("loading_file_ktp_kk").style.width = `${event.detail.progress}%`;
                    $('#loading_file_ktp_kk').html(`${event.detail.progress}%`);
                })
            }
        });
    });
</script>
@endsection