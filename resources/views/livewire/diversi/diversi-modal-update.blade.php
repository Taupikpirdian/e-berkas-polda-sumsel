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

    .card-header {
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
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Diversi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/diversi')}}">Diversi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $breadcrumb }}</h3>
                </div>
                <form action="#" method="post" wire:submit.prevent="addData" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Satuan Kerja</label>
                                    <input class="form-control form-control-sm mb-4" type="text"
                                        wire:model='satuan_kerja' readonly>
                                    @error('penyidik')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Penyidik</label>
                                    <input class="form-control form-control-sm mb-4" type="text" wire:model='penyidik'
                                        placeholder="Kosong" readonly>
                                    @if($penyidik == 'Kosong')
                                    <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle"
                                            aria-hidden="true"></i> Data profil user belum lengkap, klik <a
                                            href="{{ route('profile') }}">disini</a> untuk melengkapi</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">NRP</label>
                                    <input class="form-control form-control-sm mb-4" type="text" wire:model='nrp'
                                        placeholder="Kosong" readonly>
                                    @if($nrp == 'Kosong')
                                    <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle"
                                            aria-hidden="true"></i> Data profil user belum lengkap, klik <a
                                            target="_blank" href="{{ route('profile') }}">disini</a> untuk melengkapi
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label">No Hp</label>
                                    <input class="form-control" type="text" wire:model='no_hp' maxlength="15"
                                        oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Kosong" readonly />
                                    @if($no_hp == 'Kosong')
                                    <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle"
                                            aria-hidden="true"></i> Data profil user belum lengkap, klik <a
                                            target="_blank" href="{{ route('profile') }}">disini</a> untuk melengkapi
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Pilih Pengadilan</label>
                            <select wire:model='pengadilan_id' class="form-control select2-show-search"
                                id="pengadilan_id">
                                <option value="">Pilih Pengadilan</option>
                                @foreach($pengadilan_data as $pengadilan)
                                <option value="{{ $pengadilan->kategoribagian_id }}">{{ $pengadilan->name_kategori_bagian }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Register</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" value="{{ dateIndo(date('Y-m-d')) }}" id=""
                                    placeholder="DD-MM-YYYY" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Register</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='nomor_register'
                                placeholder="Masukan Nomor Register" type="text">
                            @error('nomor_register')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-custom" wire:model='nik' placeholder="Masukan NIK Tersangka">
                            @error('nik')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div> -->

                        <div class="form-group">
                            <label class="form-label form-label-required">Nama Tersangka</label>
                            <input type="text" class="form-custom" wire:model='nama_tersangka'
                                placeholder="Masukan Nama">
                            @error('nama_tersangka')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-custom" wire:model='tempat_lahir'
                                placeholder="Masukan Tempat Lahir">
                            @error('tempat_lahir')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-labe">Tanggal Lahir</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tgl_lahir' id="tgl_lahir"
                                    placeholder="DD-MM-YYYY" autocomplete="off">
                            </div>
                            @error('tgl_lahir')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control select2-show-search" wire:model='jk' id="jk"
                                data-placeholder="Pilih Jenis Kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Kebangsaan</label>
                            <select class="form-control select2-show-search" wire:model='kebangsaan' id="kebangsaan"
                                data-placeholder="Pilih Kebangsaan">
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                            @error('kebangsaan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea type="text" class="form-custom mb-2" wire:model='alamat'
                                placeholder="Masukan Alamat"></textarea>
                            @error('alamat')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Agama</label>
                            <select class="form-control select2-show-search" wire:model='agama' id="agama"
                                data-placeholder="Pilih Agama">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('agama')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" class="form-custom mb-2" wire:model='pekerjaan'
                                placeholder="Masukan Pekerjaan">
                            @error('pekerjaan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Pendidikan</label>
                            <select class="form-control select2-show-search" wire:model='pendidikan' id="pendidikan"
                                data-placeholder="Pilih Pendidikan">
                                <option value="">Pilih Pendidikan</option>
                                <option value="S3">S3</option>
                                <option value="S2">S2</option>
                                <option value="S1">S1</option>
                                <option value="SMA">SMA</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('pendidikan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Pasal</label>
                            <input type="text" class="form-custom mb-2" wire:model='pasal'
                                placeholder="Masukan Pasal">
                            @error('pasal')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Berkas</label>
                            <div class="mt-2 text-info">format yang digunakan: pdf, maks 25Mb</div>
                            <div class="input-group mb-4 file-browser">
                                <input type="text" class="form-control browse-file" placeholder="Choose">
                                <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='file' id="file"
                                        class="file-browserinput" style="display: none;">
                                </label>
                            </div>
                            @error('file')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            @if($uid)
                            @if ($data->name)
                            <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a
                                    href="/download-file-bacp-tipiring/{{ helperEncrypt($uid) }}">{{ $data->name }}</a>
                            </div>
                            @endif
                            @endif
                            <div class="progress mb-4 d-none" id="prepare_file" wire:ignore>
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    id="prepare_loading_file" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%">menyiapkan data ...</div>
                            </div>
                            <div class="progress mb-4 d-none" id="progress_file">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file"
                                    role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="badge badge-pill badge-success d-none" id="badge_file" wire:ignore></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i
                                    class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('diversi.index') }}" class="btn btn-warning btn-icon text-white">
                                <span>
                                    <i class="fe fe-log-in"></i>
                                </span> Cancel
                            </a>
                        </div>

                        @if (count($errors) > 0)
                        <div class="card-header">
                            <div class="row mt-2">
                                <div class="col-sm">
                                    <span class="error color-red"><i class="fa fa-exclamation-triangle"
                                            aria-hidden="true"></i> Terdapat kesalahan input data, harap cek kembali
                                        form isian!</span>
                                    <span>{{ $errors }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
@section('js')
<script>
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

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                }).then(function () {
                    window.location = param.url_redirect;
                });
            }, 1000);
        });

        // tanggal_register
        $('#tanggal_register').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
            setDate: new Date(),
        })
        $('#tanggal_register').on('change', function (e) {
            @this.set('tanggal_register', e.target.value);
        });

        // data select2 pengaju
        $('#pengadilan_id').on('change', function (e) {
            @this.set('pengadilan_id', e.target.value);
        });

        // data select2 pengaju
        $('#jk').on('change', function (e) {
            @this.set('jk', e.target.value);
        });

        // data select2 pengaju
        $('#agama').on('change', function (e) {
            @this.set('agama', e.target.value);
        });

        $('#kebangsaan').on('change', function (e) {
            @this.set('kebangsaan', e.target.value);
        });

        $('#pendidikan').on('change', function (e) {
            @this.set('pendidikan', e.target.value);
        });

        // tgl_lahir
        $('#tgl_lahir').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
        })
        $('#tgl_lahir').on('change', function (e) {
            @this.set('tgl_lahir', e.target.value);
        });

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
    });

</script>
@endsection
