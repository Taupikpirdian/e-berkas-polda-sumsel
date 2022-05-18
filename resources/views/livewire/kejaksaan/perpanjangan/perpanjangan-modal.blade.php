<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Perpanjangan Penahanan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/perpanjangan-penahanan')}}">Perpanjangan Penahanan</a></li>
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
                <div class="card-body pt-2">
                    @if($perpanjangan_penahanan)
                        <form action="#" method="post" wire:submit.prevent="update">
                            @csrf
                            <div class="form-group" style="display: none;">
                                <label class="form-label form-label-required">Tersangka</label>
                                <input type="text" class="form-control" wire:model="id_tersangka" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Tersangka</label>
                                <input type="text" class="form-control" wire:model="nama_tersangka" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Nomor T-4</label>
                                <input class="form-control form-control-sm  mb-4" value="{{ $perpanjangan_penahanan->nomor_t4 }}" placeholder="Masukan no t4" type="text" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Tanggal T-4</label>
                                <input type="text" class="form-control" value="{{ dateindo($perpanjangan_penahanan->tanggal_t4) }}" placeholder="DD/MM/YYYY" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Nomor Permintaan Perpanjangan</label>
                                <input type="text" class="form-control" value="{{ $perpanjangan_penahanan->nomor_permintaan_perpanjangan }}" placeholder="Masukan No Permintaan Perpanjangan" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Tanggal Permintaan Perpanjangan</label>
                                <input type="text" value="{{ dateindo($perpanjangan_penahanan->tanggal_permintaan_perpanjangan) }}" placeholder="DD/MM/YYYY" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Uraian Kejadian</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="5" readonly>{{ $perpanjangan_penahanan->uraian_kejadian }}</textarea>
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="form-label">Lama Perpanjangan</label>
                                <input type="text" class="form-control" value="{{ $perpanjangan_penahanan->lama_perpanjangan }}" placeholder="Masukan No Permintaan Perpanjangan" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label form-label-required">Tanggal Perpanjangan</label>
                                <input type="text" value="{{ dateindo($perpanjangan_penahanan->tanggal_perpanjangan_penahanan) }}" placeholder="DD/MM/YYYY" class="form-control" readonly>
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="form-label">Rumah Tahanan</label>
                                <input type="text" class="form-control" value="{{ $perpanjangan_penahanan->rumahTahanan->name }}" placeholder="Masukan No Permintaan Perpanjangan" readonly>
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="form-label">Tanda Tangan</label>
                                <input type="text" class="form-control" value="{{ $perpanjangan_penahanan->tandaTangan->name }}" placeholder="Masukan No Permintaan Perpanjangan" readonly>
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
                                <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                                <a href="{{ route('perpanjangan-penahanan.index') }}" class="btn btn-warning btn-icon text-white">
                                    <span>
                                        <i class="fe fe-log-in"></i>
                                    </span> Cancel
                                </a>
                            </div>
                        </form>
                    @else
                    <form action="#" method="post" wire:submit.prevent="addData">
                        @csrf
                        <div class="form-group" style="display: none;">
                            <label class="form-label form-label-required">Tersangka</label>
                            <input type="text" class="form-control" wire:model="id_tersangka" readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tersangka</label>
                            <input type="text" class="form-control" wire:model="nama_tersangka" readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor T-4</label>
                            <input class="form-control form-control-sm  mb-4" wire:model='nomor_t4' placeholder="Masukan no t4" type="text">
                            @error('nomor_t4')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal T-4</label>
                            <input type="text" class="form-control" id="tanggal_t4" wire:model='tanggal_t4' placeholder="DD/MM/YYYY">
                            @error('tanggal_t4')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Nomor Permintaan Perpanjangan</label>
                            <input type="text" class="form-control" wire:model='nomor_permintaan' placeholder="Masukan No Permintaan Perpanjangan">
                            @error('nomor_permintaan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Permintaan Perpanjangan</label>
                            <input type="text" id="tanggal_permintaan_perpanjangan" placeholder="DD/MM/YYYY" class="form-control" wire:model='tanggal_permintaan_perpanjangan'>
                            @error('tanggal_permintaan_perpanjangan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Uraian Kejadian</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5" wire:model="uraian_kejadian"></textarea>
                            @error('uraian_kejadian')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Lama Perpanjangan</label>
                            <select class="form-control select2-show-search" id="lama_perpanjangan" wire:model='lama_perpanjangan'>
                                <option value="">-- Pilih Lama Perpanjangan --</option>
                                @for($x = 1; $x <= 100; $x++) <option value="{{$x}}-hari">{{ $x }} Hari</option>
                                    @endfor
                            </select>
                            @error('lama_perpanjangan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-required">Tanggal Perpanjangan</label>
                            <input type="text" id="tanggal_perpanjangan" placeholder="DD/MM/YYYY" class="form-control" wire:model='tanggal_perpanjangan'>
                            @error('tanggal_perpanjangan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Rumah Tahanan</label>
                            <select class="form-control select2-show-search" id="rumah_tahanan" wire:model='rumah_tahanan'>
                                <option value="">-- Pilih Rumah Tahanan --</option>
                                @foreach ($rumah_tahanans as $rt)
                                <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                                @endforeach
                            </select>
                            @error('rumah_tahanan')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label class="form-label">Tanda Tangan</label>
                            <select class="form-control select2-show-search" wire:model.lazy='tanda_tangan' id="tanda_tangan" data-placeholder="Pilih Tanda Tangan">
                                @foreach ($tanda_tangans as $tt)
                                <option value="{{ $tt->id }}">{{ $tt->name }}</option>
                                @endforeach
                            </select>
                            @error('tanda_tangan')
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
                            <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                            <a href="{{ route('perpanjangan-penahanan.index') }}" class="btn btn-warning btn-icon text-white">
                                <span>
                                    <i class="fe fe-log-in"></i>
                                </span> Cancel
                            </a>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @if($perpanjangan_penahanan)
        {{-- ROW OPEN --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <b>Data Berkas</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped border table-bordered table-hover">
                                <thead>
                                    <tr class="border-top">
                                        <th class="w-15" style="text-align: center">Original Name</th>
                                        <th class="w-10" style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($file_perpanjangan_penahanan as $data)
                                    <tr>
                                        <td  style="text-align: center">
                                            {{$data->original_name}}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="/download-perpanjangan-penahanan/{{ helperEncrypt($data->id) }}" class="btn btn-info-light btn-square  br-50 m-1" data-bs-toggle="tooltip" title="" data-bs-original-title="download berkas" ><i class="fe fe-download fs-13""></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ROW CLOSED --}}
    @endif
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // tanggal_register
        $('#tanggal_t4').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
            setDate: new Date(),
        });
        $('#tanggal_t4').on('change', function (e) {
            @this.set('tanggal_t4', e.target.value);
        });

        // tanggal_register
        $('#tanggal_permintaan_perpanjangan').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
            setDate: new Date(),
        })
        $('#tanggal_permintaan_perpanjangan').on('change', function (e) {
            @this.set('tanggal_permintaan_perpanjangan', e.target.value);
        });

        // tanggal_register
        $('#tanggal_perpanjangan').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
            setDate: new Date(),
        })
        $('#tanggal_perpanjangan').on('change', function (e) {
            @this.set('tanggal_perpanjangan', e.target.value);
        });


        // data select2 
        $('#lama_perpanjangan').on('change', function(e) {
            @this.set('lama_perpanjangan', e.target.value);
        });

        $('#rumah_tahanan').on('change', function(e) {
            @this.set('rumah_tahanan', e.target.value);
        });

        $('#tanda_tangan').on('change', function(e) {
            @this.set('tanda_tangan', e.target.value);
        });
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
            setTimeout(function() {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                }).then(function() {
                    window.location = param.url_redirect;
                });
            }, 1000);
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