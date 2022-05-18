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
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Lapas dan Tahanan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label form-label-required">Lapas</label>
                                    <select class="form-control" wire:model='lapas_id' id="lapas_id" data-placeholder="Pilih Lapas">
                                        <option value="">Pilih Lapas</option>
                                        @foreach($lapasDatas as $ld)
                                        <option value="{{ $ld->id }}">{{ $ld->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lapas_id')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if($lapas_id)
                                    <div class="form-group">
                                        <label class="form-label">Pilih Tahanan</label>
                                        <div class="input-group mb-5 mt-3">
                                            <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan no registrasi instansi atau nama tahanan ...">
                                            <div class="input-group-text btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        {{-- table --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="center-align">
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">No Reg Instansi</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Alamat</th>
                                                        <th class="text-center">Tanggal Lahir</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($dataTahanan as $i=>$dt)
                                                    <tr>
                                                        <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                                                        <td class="text-nowrap align-middle">{{ $dt->no_reg_instansi }}</td>
                                                        <td class="text-nowrap align-middle">{{ $dt->name }}</td>
                                                        <td class="text-nowrap align-middle">{{ $dt->alamat }}</td>
                                                        <td class="text-nowrap align-middle">{{ dateIndo($dt->tanggal_lahir) }}</td>
                                                        <td class="text-nowrap align-middle text-center">
                                                            <a type="button" wire:click="selectData({{ $dt->id }})"><span class="badge bg-success text-white">Pilih</span></a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <td class="center-align" colspan="18">
                                                        Data Kosong
                                                    </td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <p class="col-sm-12 mt-3" style="text-align: left;">
                                                {{ $paginate_content }}
                                            </p>
                                            <div class="d-flex justify-content-end mb-5">
                                                {{ $dataTahanan->links("livewire::bootstrap") }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($selectTahanan == true)
            <!-- Row Tahanan -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Data Tahanan
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">Nama</label>
                                        <input class="form-control form-control-sm" type="text" wire:model.lazy='name' readonly>
                                        @error('name')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Alamat</label>
                                        <input class="form-control form-control-sm" type="text" wire:model.lazy='alamat' readonly>
                                        @error('alamat')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tempat Lahir</label>
                                        <input class="form-control form-control-sm" type="text" wire:model.lazy='tempat_lahir' readonly>
                                        @error('tempat_lahir')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" type="text" wire:model='tanggal_lahir' id="tanggal_lahir" readonly>
                                        </div>
                                        @error('tanggal_lahir')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">No Reg Instansi</label>
                                        <input class="form-control form-control-sm" type="text" wire:model.lazy='no_reg_instansi' readonly>
                                        @error('no_reg_instansi')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal Ekspirasi</label>
                                        <input class="form-control" type="text" wire:model='tanggal_ekspirasi' id="tanggal_ekspirasi" readonly>
                                        @error('tanggal_ekspirasi')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal Bebas</label>
                                        <input class="form-control" type="text" wire:model='tanggal_bebas' id="tanggal_bebas" readonly>
                                        @error('tanggal_bebas')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label form-label-required">Keterangan</label>
                                        <input class="form-control" type="text" wire:model='keterangan' id="keterangan" readonly>
                                        @error('keterangan')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Row File -->
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            Upload File
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">File Bon Tahanan</label>
                                        <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                                        <div class="input-group mb-4 file-browser">
                                            <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
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

            {{-- Row Data Input --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Tambah Data Bon Tahanan
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">Tanggal dan Waktu Peminjaman</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" type="text" wire:model='range_date_pinjaman' id="range_date_pinjaman" placeholder="DD/MM/YYYY" autocomplete="off">
                                        </div>
                                        @error('range_date_pinjaman')
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
            
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label form-label-required">Keterangan</label>
                                        <textarea class="form-control form-control-sm mb-4" rows="7" cols="50" wire:model='keterangan'>
                                        @error('keterangan')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
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
        @endif

    </form>
</div>

@section('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // data select2 pengadilan_id
        $('#lapas_id').select2();
        $('#lapas_id').on('change', function(e) {
            @this.set('lapas_id', e.target.value);
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

            $('#file').on('change', function () {
                console.log('mau');
                let idForm = 'file';
                // clear data
                $('#badge_file').addClass('d-none');
                window.livewire.emit('clearFormFile', idForm);
    
                let file = document.querySelector(`#${idForm}`).files[0];
                let validate = validateFiles(file, idForm);
                if(validate){
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
                        console.log('error upload spdp');
                    }, (event) => {
                        console.log(event.detail);
                        // Progress callback.
                        // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                        $('#prepare_file').addClass('d-none');
                        $('#progress_file').removeClass('d-none');
                        document.getElementById("loading_file").style.width = `${event.detail.progress}%`;
                        $('#loading_file').html(`${event.detail.progress}%`);
                    })
                }
            });

            // data select2 pengadilan_id
            $('#lapas_id').select2();
            $('#lapas_id').on('change', function(e) {
                @this.set('lapas_id', e.target.value);
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