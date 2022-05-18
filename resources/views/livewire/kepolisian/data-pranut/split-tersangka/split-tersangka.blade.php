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
@endsection
<div>
    @include('include.loading-target')
    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" wire:submit.prevent="validateData">
        @csrf
        <div class="row mt-5">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Update Berkas
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Split Tersangka</label>
                                    <label class="custom-switch">
                                        <input type="checkbox" wire:model='switch_tersangka' class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Pilih Tersangka Secara Manual</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if( ($switch_tersangka == true) )
            <!-- Row Pihak Terkait -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Pilih Data Tersangka Manual
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{-- table --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="center-align">
                                                        <th></th>
                                                        <th>No</th>
                                                        <th class="text-nowrap align-middle">NIK</th>
                                                        <th class="text-nowrap align-middle">Tersangka</th>
                                                        <th class="text-nowrap align-middle">Tempat Lahir</th>
                                                        <th class="text-nowrap align-middle">Tanggal Lahir</th>
                                                        <th class="text-nowrap align-middle">Jenis Kelamin</th>
                                                        <th class="text-nowrap align-middle">Kebangsaan</th>
                                                        <th class="text-nowrap align-middle">Alamat</th>
                                                        <th class="text-nowrap align-middle">Agama</th>
                                                        <th class="text-nowrap align-middle">Pekerjaan</th>
                                                        <th class="text-nowrap align-middle">Pendidikan</th>
                                                        <th class="text-nowrap align-middle">Pasal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data_tersangka as $i=>$tersangka)
                                                    <tr>
                                                        <td><input class="splite-tersangka" wire:model="checkbox.{{$tersangka->id}}" type="checkbox" type="checkbox"></td>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $tersangka->nik }}</td>
                                                        <td>{{ $tersangka->name }}</td>
                                                        <td>{{ $tersangka->tempat_lahir }}</td>
                                                        <td>{{ dateindo($tersangka->tgl_lahir) }}</td>
                                                        <td>{{ $tersangka->jk }}</td>
                                                        <td>{{ $tersangka->kebangsaan }}</td>
                                                        <td>{{ $tersangka->alamat }}</td>
                                                        <td>{{ $tersangka->agama }}</td>
                                                        <td>{{ $tersangka->pekerjaan }}</td>
                                                        <td>{{ $tersangka->pendidikan }}</td>
                                                        <td>{{ $tersangka->pasal }}</td>
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
                    </div>
                </div>
            </div>
        @endif

        @if( ($switch_tersangka == false) )
        <!-- Row File -->
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Upload File Data
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label form-label-required">File Perkara</label>
                                    <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                    <div class="input-group mb-4 file-browser">
                                        <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose" required>
                                        <label class="input-group-text btn btn-primary">
                                            Browse <input type="file" accept="application/pdf" wire:model.lazy='file' id="file" class="file-browserinput" style="display: none;">
                                        </label>
                                    </div>
                                    @error('file')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="progress mb-4 d-none" id="prepare_file" wire:ignore>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="prepare_loading_file" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                                    </div>
                                    <div class="progress mb-4 d-none" id="progress_file">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="badge badge-pill badge-success d-none" id="badge_file" wire:ignore></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Row File -->
            @foreach($checkbox as $key=>$form)
            <div class="row" class="">
                <div class="col-sm">
                    @if($form == true)
                    <div class="card">
                        <div class="card-header">
                            Upload File SPDP Tersangka {{ CjsHelper::listNamaTersangka($key)->name }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Spdp</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model="file_spdp.{{$key}}" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Sprint Sidik</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model="sprint_sidik.{{$key}}" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Lp</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model="file_lp.{{$key}}" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group coupon_question">
                                        <label class="form-label form-label-required">File Berkas Perkara</label>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" placeholder="Choose" required>
                                            <label class="input-group-text btn btn-primary">
                                                Browse <input type="file" accept="application/pdf" wire:model="file_berkas_perkara.{{$key}}" class="file-browserinput" style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif

        <!-- Row Submit -->
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ url('/izin-pengadilan?fitur=') }}" class="btn btn-warning btn-icon text-white">
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
                    html: "Ukuran File tidak sesuai, Ukuran File yang diizinkan adalah maksimal 25MB<br><i>You are only allowed to upload file with max size of 25MB</i>"
                });
                $(file).val(''); // for clearing with Jquery
                document.getElementById(idForm).value = null;
                window.livewire.emit('clearFormFile', idForm);

                return false;
            }

            if (!extFile) {
                Swal.fire({
                    title: '<b>Error!</b>',
                    icon: 'error',
                    html: "Format file tidak sesuai<br>File yang diizinkan adalah file dengan format pdf<br><i>You are only allowed to upload with pdf file format</i>"
                });
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
        
        // upload file spdp
        $('#file').on('change', function () {
            let idForm = 'file';
            // clear data
            $('#badge_file').addClass('d-none');
            window.livewire.emit('clearFormFile', idForm);

            let file = document.querySelector(`#${idForm}`).files[0];
            let validate = validateFiles(file, idForm);
            if (validate) {
                // prepare data ...
                $('#prepare_file').removeClass('d-none');
                // Upload a file:
                @this.upload(idForm, file, (uploadedFilename) => {
                    // Success callback.
                    $('#progress_file').addClass('d-none');
                    $('#badge_file').removeClass('d-none');
                    $('#badge_file').html("Berhasil upload file");
                }, () => {
                    // Error callback.
                    console.log('error upload file');
                }, (event) => {
                    console.log(event.detail);
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    $('#prepare_file').addClass('d-none');
                    $('#progress_file').removeClass('d-none');
                    document.getElementById("loading_file").style.width =
                        `${event.detail.progress}%`;
                    $('#loading_file').html(`${event.detail.progress}%`);
                })
            }
        });

        window.livewire.on('refreshJs', (params) => {
            //Input file-browser
            $(document).on('change', '.file-browserinput', function() {
                var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
            });// We can watch for our custom `fileselect` event like this

            //______File Upload
            $('.file-browserinput').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }
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

        });
    });
</script>
@endsection