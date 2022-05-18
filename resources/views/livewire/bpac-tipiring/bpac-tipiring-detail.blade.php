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
                                    id="tanggal_pelimpahan" placeholder="DD-MM-YYYY" autocomplete="off" readonly>
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
                            <label class="form-label form-label-required">Berkas Pengajuan</label>
                            @if ($data->filePengajuan)
                                <div class="mt-2 text-success" wire:ignore>
                                    <a href="/download-file-bacp-tipiring/{{ helperEncrypt($uid) }}/{{$data->filePengajuan->code}}">{{ $data->filePengajuan->name }}</a>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label form-label-required">Berkas Balasan</label>
                            @if ($data->fileBalasan)
                                <div class="mt-2 text-success" wire:ignore>
                                    <a href="/download-file-bacp-tipiring/{{ helperEncrypt($uid) }}/{{$data->fileBalasan->code}}">{{ $data->fileBalasan->name }}</a>
                                </div>
                            @endif
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label form-label-required">Assign Pengadilan</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="{{$data->pengadilan->name}}" readonly>
                            </div>
                            @error('pengadilan_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-header">
                                            Tersangka
                                        </div>
                                        <div class="card-body">
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
                            <a href="{{ route('bacp-tipiring.index') }}" class="btn btn-warning btn-icon text-white">
                                <span>
                                    <i class="fe fe-log-in"></i>
                                </span> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
