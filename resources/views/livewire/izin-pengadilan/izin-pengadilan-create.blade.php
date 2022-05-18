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
                    Jenis Pihak
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label form-label-required">Pengadilan</label>
                                <select class="form-control" wire:model='pengadilan_id' id="pengadilan_id" data-placeholder="Pilih Pengadilan">
                                    <option value="">Pilih Jenis Pengadilan</option>
                                    @foreach($pengadilans as $pg)
                                    <option value="{{ $pg->kategoribagian_id }}">{{ $pg->name_kategori_bagian }}</option>
                                    @endforeach
                                </select>
                                @error('pengadilan_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label form-label-required">Jenis Pihak</label>
                                <select class="form-control" wire:model='jns_pihak' id="jns_pihak" data-placeholder="Pilih Jenis Pihak">
                                    <option value="">Pilih Jenis Pihak</option>
                                    <option value="tersangka">Tersangka</option>
                                    <option value="korban">Korban</option>
                                    <option value="pihak-lain">Pihak Lain</option>
                                </select>
                                @error('jns_pihak')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($jns_pihak == "tersangka")
                                <div class="form-group">
                                    <label class="form-label">Pilih Perkara</label>
                                    <label class="custom-switch">
                                        <input type="checkbox" wire:model='switch_pihak' class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Input Manual Pihak Terkait</span>
                                    </label>

                                    @if($switch_pihak == false)
                                        <div class="input-group mb-5 mt-3">
                                            <input type="text" class="form-control" wire:model='query' placeholder="Cari berdasarkan no lp ...">
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
                                                        <th class="text-center">No LP</th>
                                                        <th class="text-center">Tanggal LP</th>
                                                        <th class="text-center">Tersangka</th>
                                                        <th class="text-center">JPU</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($dataPrapenuntutans as $i=>$dp)
                                                    @php
                                                    $class_span = 'bg-info';
                                                    if($dp->statusBerkas){
                                                    if($dp->statusBerkas->id == 1){
                                                    $class_span = 'bg-warning';
                                                    }elseif($dp->statusBerkas->id == 2){
                                                    $class_span = 'bg-info';
                                                    }else{
                                                    $class_span = 'bg-success';
                                                    }
                                                    }
                            
                                                    $countTersangka = count($dp->perkaraTersangka);
                                                    @endphp
                            
                                                    <tr>
                                                        <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                                                        <td class="text-nowrap align-middle">{{ $dp->no_lp }}</td>
                                                        <td class="text-nowrap align-middle">{{ dateIndo($dp->date_no_lp) }}</td>
                                                        <td class="text-nowrap align-middle">
                                                            <div style="height: 50px;  overflow-y: scroll">
                                                                @forelse($dp->perkaraTersangka as $key=>$tersangka)
                                                                <p> Tersangka {{ $key + 1 }}: {{ $tersangka->name }}@if($countTersangka != $key + 1), </p> @endif
                                                                @empty
                                                                <span class="badge bg-danger text-white">Belum ada</span>
                                                                @endforelse
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap align-middle">
                                                            <div style="height: 50px;  overflow-y: scroll">
                                                                @forelse($dp->perkaraJaksa as $key=>$jaksa)
                                                                <p> Jaksa {{ $key + 1 }}: {{ $jaksa->masterJaksa ? $jaksa->masterJaksa->name : '' }} 
                                                                    @if($countTersangka != $key + 1), @endif
                                                                </p>
                                                                @empty
                                                                <span class="badge bg-danger text-white">Belum ada</span>
                                                                @endforelse
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap align-middle">
                                                            <span class="badge {{ $class_span }} text-white">{{ $dp->statusBerkas ? $dp->statusBerkas->name : '' }}</span>
                                                        </td>
                                                        <td class="text-nowrap align-middle text-center">
                                                            <a class="choose-lp" id="choose-lp-{{ $dp->id }}" type="button" wire:click="selectData({{ $dp->id }})" wire:ignore>
                                                                <span class="badge bg-success text-white">Pilih</span>
                                                            </a>
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
                                                {{ $paginate_content_modal_berkas }}
                                            </p>
                                            <div class="d-flex justify-content-end mb-5">
                                                {{ $dataPrapenuntutans->links("livewire::bootstrap") }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if(
                                $is_selected == true && 
                                $switch_pihak == false && 
                                $jns_pihak == "tersangka"
                            )
                                <div class="form-group">
                                    <label class="form-label">Pilih Tersangka</label>
                                    {{-- table --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="center-align">
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Tempat Lahir</th>
                                                    <th class="text-center">Tanggal Lahir</th>
                                                    <th class="text-center">Alamat</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($dataTersangkas as $i=>$dt)
                                                <tr>
                                                    <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dt->name }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dt->tempat_lahir }}</td>
                                                    <td class="text-nowrap align-middle">{{ dateIndo($dt->tgl_lahir) }}</td>
                                                    <td class="text-nowrap align-middle">{{ $dt->alamat }}</td>
                                                    <td class="text-nowrap align-middle text-center">
                                                        <a class="choose-suspect" type="button" id="choose-suspect-{{ $dt->id }}" wire:click="selectTersangka({{ $dt->id }})" wire:ignore>
                                                            <span class="badge bg-success text-white">Pilih</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <td class="center-align" colspan="18">
                                                    Data Kosong
                                                </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if( 
        ($jns_pihak == "tersangka" && $is_selected == true && $is_tersangka == true) || 
        ($jns_pihak != "tersangka" && $jns_pihak) || 
        $switch_pihak == true
    )
        <!-- Row Pihak Terkait -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Data Pihak Terkait
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label form-label-required">Nama</label>
                                    <input class="form-control form-control-sm" type="text" wire:model.lazy='name' placeholder="Nama Pihak Terkait" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") readonly @else @endif>
                                    @error('name')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label form-label-required">Tempat Tinggal</label>
                                    <input class="form-control form-control-sm" type="text" wire:model.lazy='alamat' placeholder="Tempat Tinggal" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") readonly @else @endif>
                                    @error('alamat')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label form-label-required">Tempat Lahir</label>
                                    <input class="form-control form-control-sm" type="text" wire:model.lazy='tempat_lahir' placeholder="Tempat Lahir" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") readonly @else @endif>
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
                                        <input class="form-control" type="text" wire:model='tgl_lahir' id="tgl_lahir" placeholder="DD/MM/YYYY" autocomplete="off" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") readonly @else @endif>
                                    </div>
                                    @error('tgl_lahir')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label form-label-required">Jenis Kelamin</label>
                                    <select class="form-control select2-show-search" wire:model='jk' id="jk" data-placeholder="Pilih Jenis Kelamin" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") disabled="true" @else @endif>
                                        <option value="">Pilih</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('jk')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label form-label-required">Agama</label>
                                    <select class="form-control select2-show-search" wire:model='agama' id="agama" data-placeholder="Pilih Agama" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") disabled="true" @else @endif>
                                        <option value="">Pilih</option>
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

                                <div class="form-group">
                                    <label class="form-label form-label-required">Kebangsaan</label>
                                    <select class="form-control select2-show-search" wire:model='kebangsaan' id="kebangsaan" data-placeholder="Pilih Kebangsaan" @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") disabled="true" @else @endif>
                                        <option value="">Pilih</option>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                    @error('kebangsaan')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label form-label-required">Pekerjaan</label>
                                    <input class="form-control form-control-sm" type="text" wire:model='pekerjaan' @if($is_selected == true && $switch_pihak == false && $jns_pihak == "tersangka") readonly @else @endif>
                                    @error('pekerjaan')
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
                        Upload File Data {{ $label }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label form-label-required">File Izin</label>
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

        {{-- Row Data Izin --}}
        @if($fitur == "izin-sita")
            @include('livewire.izin-pengadilan.component.form-izin-sita')
        @else
            @include('livewire.izin-pengadilan.component.form-izin-geledah')
        @endif

        <!-- Row Submit -->
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ url('/izin-pengadilan?fitur='.$fitur) }}" class="btn btn-warning btn-icon text-white">
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
    // function chooseLp(id){
    //     $('#choose-lp-'+id).empty();
    //     $("#choose-lp-"+id).append(
    //         `<span class="badge bg-success text-white">Dipilih</span>`
    //     );
    // }

    document.addEventListener('DOMContentLoaded', function () {
        // data select2 pengadilan_id
        $('#pengadilan_id').select2();
        $('#pengadilan_id').on('change', function(e) {
            @this.set('pengadilan_id', e.target.value);
        });

        // data select2 jns_pihak
        $('#jns_pihak').select2();
        $('#jns_pihak').on('change', function(e) {
            @this.set('jns_pihak', e.target.value);
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
            $('#pengadilan_id').select2();
            $('#pengadilan_id').on('change', function(e) {
                @this.set('pengadilan_id', e.target.value);
            });

            // data select2 jns_pihak
            $('#jns_pihak').select2();
            $('#jns_pihak').on('change', function(e) {
                @this.set('jns_pihak', e.target.value);
            });

            // data select2 jk
            $('#jk').select2();
            $('#jk').on('change', function(e) {
                @this.set('jk', e.target.value);
            });

            // tgl_lahir
            $("#tgl_lahir").bootstrapdatepicker({ 
                dateFormat: 'dd-mm-yy' 
            });
            $('#tgl_lahir').on('change', function (e) {
                @this.set('tgl_lahir', e.target.value);
            });

            // tgl_surat_permohonan
            $("#tgl_surat_permohonan").bootstrapdatepicker({ 
                dateFormat: 'dd-mm-yy' 
            });
            $('#tgl_surat_permohonan').on('change', function (e) {
                @this.set('tgl_surat_permohonan', e.target.value);
            });

            // tgl_surat_permohonan
            $("#tgl_surat_perintah").bootstrapdatepicker({ 
                dateFormat: 'dd-mm-yy' 
            });
            $('#tgl_surat_perintah').on('change', function (e) {
                @this.set('tgl_surat_perintah', e.target.value);
            });

            // tgl_lapor
            $("#tgl_lapor").bootstrapdatepicker({ 
                dateFormat: 'dd-mm-yy' 
            });
            $('#tgl_lapor').on('change', function (e) {
                @this.set('tgl_lapor', e.target.value);
            });

            // tgl_ba
            $("#tgl_ba").bootstrapdatepicker({ 
                dateFormat: 'dd-mm-yy' 
            });
            $('#tgl_ba').on('change', function (e) {
                @this.set('tgl_ba', e.target.value);
            });

            // data select2 agama
            $('#agama').select2();
            $('#agama').on('change', function(e) {
                @this.set('agama', e.target.value);
            });
    
            // data select2 kebangsaan
            $('#kebangsaan').select2();
            $('#kebangsaan').on('change', function(e) {
                @this.set('kebangsaan', e.target.value);
            });

            // data select2 jns_penetapan_id
            $('#jns_penetapan_id').select2();
            $('#jns_penetapan_id').on('change', function(e) {
                @this.set('jns_penetapan_id', e.target.value);
            });

            // data select2 penggeledahan_terhadap_id
            $('#penggeledahan_terhadap_id').select2();
            $('#penggeledahan_terhadap_id').on('change', function(e) {
                @this.set('penggeledahan_terhadap_id', e.target.value);
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

        window.livewire.on('chooseLp', (id) => {
            // reset content
            $('.choose-lp').empty();
            $(".choose-lp").append(
                `<span class="badge bg-success text-white">Pilih</span>`
            );
            if(id){
                // change content
                $('#choose-lp-'+id).empty();
                $("#choose-lp-"+id).append(
                    `<span class="badge bg-warning text-white">Dipilih</span>`
                );
            }
        });

        window.livewire.on('chooseSuspect', (id) => {
            // reset content
            $('.choose-suspect').empty();
            $(".choose-suspect").append(
                `<span class="badge bg-success text-white">Pilih</span>`
            );
            if(id){
                // change content
                $('#choose-suspect-'+id).empty();
                $("#choose-suspect-"+id).append(
                    `<span class="badge bg-warning text-white">Dipilih</span>`
                );
            }
        });
    });
</script>
@endsection