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
            <h1 class="page-title">BACP Tipiring</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/bacp-tipiring')}}">BACP Tipiring</a></li>
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
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Pelimpahan</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" wire:model='tanggal_pelimpahan'
                                    id="tanggal_pelimpahan" placeholder="DD-MM-YYYY" autocomplete="off">
                            </div>
                            @error('tanggal_pelimpahan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Register</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                                <input class="form-control" type="text" value="{{ dateIndo(date('Y-m-d')) }}"
                                    id="tanggal_register" placeholder="DD-MM-YYYY" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Penyidik</label>
                            <input class="form-control" type="text" wire:model='penyidik' placeholder="Kosong" readonly>
                            @if($penyidik == 'Kosong')
                            <div class="mt-2 text-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                Data profil user belum lengkap, klik <a href="{{ route('profile') }}">disini</a> untuk
                                melengkapi</div>
                            @endif
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
                            @if (isset($data->fileBpacTipiring))
                                <div class="mt-2 text-success" wire:ignore><b>Last Uploaded:</b> <a
                                        href="/download-file-bacp-tipiring/{{ helperEncrypt($uid) }}/{{$data->fileBpacTipiring->code}}">{{ $data->fileBpacTipiring->name }}</a>
                                </div>
                            @endif
                            <div class="progress mb-4 d-none" id="prepare_file" wire:ignore>
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    id="prepare_loading_file" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%">menyiapkan data ...
                                </div>
                            </div>
                            <div class="progress mb-4 d-none" id="progress_file">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id="loading_file"
                                    role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="badge badge-pill badge-success d-none" id="badge_file" wire:ignore></span>
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Assign Pengadilan</label>
                            <select class="form-control select2-show-search" wire:model.lazy='pengadilan_id'
                                id="pengadilan_id" data-placeholder="Pilih Pengadilan">
                                <optgroup label="Pilih Assign Pengadilan">
                                    @foreach($listPengadilan as $pengadilan)
                                    <option value="{{$pengadilan->user_id}}">{{$pengadilan->user_name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('pengadilan_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-header">
                                            Tambah Tersangka
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-5">
                                                <div class="col-sm-3 col-md-4 col-xl-3">
                                                    <button type="button" class="btn btn-danger mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#scrollingmodal">Tambah</button>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="center-align">
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
                                                            <th class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($array_tersangka as $key=>$ap)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $ap['nik'] ? $ap['nik'] : '-' }}</td>
                                                            <td>{{ $ap['name'] ? $ap['name'] : '-' }}</td>
                                                            <td>{{ $ap['tempat_lahir'] ? $ap['tempat_lahir'] : '-' }}
                                                            </td>
                                                            <td>{{ $ap['tgl_lahir'] ? $ap['tgl_lahir'] : '-' }}</td>
                                                            <td>{{ $ap['jk'] ? $ap['jk'] : '-' }}</td>
                                                            <td>{{ $ap['kebangsaan'] ? $ap['kebangsaan'] : '-' }}
                                                            </td>
                                                            <td>{{ $ap['alamat'] ? $ap['alamat'] : '-' }}</td>
                                                            <td>{{ $ap['agama'] ? $ap['agama'] : '-' }}</td>
                                                            <td>{{ $ap['pekerjaan'] ? $ap['pekerjaan'] : '-' }}</td>
                                                            <td>{{ $ap['pendidikan'] ? $ap['pendidikan'] : '-' }}
                                                            </td>
                                                            <td>{{ $ap['pasal'] ? $ap['pasal'] : '-' }}</td>
                                                            <td>
                                                                <a type="button"
                                                                    wire:click.prevent="removeTersangka({{ $key }})"><i
                                                                        style="color:red" class="fa fa-trash"
                                                                        aria-hidden="true"></i></a>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="12">
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

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i
                                    class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('bacp-tipiring.index') }}" class="btn btn-warning btn-icon text-white">
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
    <!-- modal -->
    @include('livewire.bpac-tipiring.component.modal-tersangka')
    <!-- end modal  -->
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

        // tanggal_pelimpahan
        $("#tanggal_pelimpahan").bootstrapdatepicker({
            dateFormat: 'dd-mm-yy'
        });
        $('#tanggal_pelimpahan').on('change', function (e) {
            @this.set('tanggal_pelimpahan', e.target.value);
        });

        // tanggal_register
        // $("#tanggal_register").bootstrapdatepicker({
        //     dateFormat: 'dd-mm-yy'
        // });
        // $('#tanggal_register').on('change', function (e) {
        //     @this.set('tanggal_register', e.target.value);
        // });

        // start modal tersangka

        $('#jk').on('change', function (e) {
            @this.set('jk', e.target.value);
        });

        $('#kebangsaan').on('change', function (e) {
            @this.set('kebangsaan', e.target.value);
        });

        $('#agama').on('change', function (e) {
            @this.set('agama', e.target.value);
        });

        $('#pendidikan').on('change', function (e) {
            @this.set('pendidikan', e.target.value);
        });

        //

        // data select2 penyidik
        $('#pengadilan_id').on('change', function (e) {
            @this.set('pengadilan_id', e.target.value);
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

        // hide modal
        window.livewire.on('closeModal', ($modal) => {
            $($modal).modal('hide');
        });
    });

</script>
@endsection
