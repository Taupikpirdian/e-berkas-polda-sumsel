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
               <div class="card mt-5">
                  <div class="card-header">
                     Tambah Barang Bukti Narkotika
                  </div>
                  <div class="card-body">
                     <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
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
                                                         <a type="button" wire:click="selectData({{ $dp->id }})"><span class="badge bg-success text-white">Pilih</span></a>
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
                                             {{ $pagination }}
                                          </p>
                                          <div class="d-flex justify-content-end mb-5">
                                             {{ $dataPrapenuntutans->links("livewire::bootstrap") }}
                                          </div>
                                    </div>
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
      
      @if($is_selected == true)
      <!-- Row File -->
      <div class="row">
         <div class="col-sm">
               <div class="card">
                  <div class="card-header">
                     Data Permohonan LP
                  </div>
                  <div class="card-body">
                     <div class="row">
                        @foreach($datafileperkara as $datafile)
                           @if($datafile->code_id == Constant::SPDP || $datafile->code_id == Constant::SPRINT_SIDIK || $datafile->code_id == Constant::FILE_LP)
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="form-label form-label-required">{{ CjsHelper::getNameFile($datafile->code_id)->name }}</label>
                                 <input class="form-control form-control-sm" type="text" value="{{$datafile->name}}" readonly>
                              </div>
                           </div>
                           @endif
                        @endforeach

                        <div class="form-group">
                           <label class="form-label form-label-required">Kejaksaan</label>
                           <select class="form-control select2-show-search" wire:model='kejaksaan_id' id="kejaksaan_id" data-placeholder="Pilih Kejaksaan">
                                 <option value="">Pilih</option>
                                 @if($tipe_lembaga == Constant::TYPE_LEMBAGA_DIREKTORAT_POLDA || $tipe_lembaga == Constant::TYPE_LEMBAGA_POLDA)
                                    @foreach($list_jaksas as $list_jaksa)
                                        <option value="{{$list_jaksa->kategoribagian_id}}">{{$list_jaksa->name_kategori_bagian}}</option>
                                    @endforeach
                                 @else
                                    @foreach($list_jaksas as $list_jaksa)
                                        <option value="{{$list_jaksa->id}}">{{$list_jaksa->name}}</option>
                                    @endforeach
                                 @endif
                           </select>
                           @error('kejaksaan_id')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="form-group">
                           <label class="form-label form-label-required">Nomor Surat Permohonan</label>
                           <input class="form-control form-control-sm" type="text" wire:model.lazy='nomor_surat_permohonan' placeholder="Nomor Surat Permohonan">
                           @error('nomor_surat_permohonan')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        
                        <div class="form-group">
                           <label class="form-label form-label-required">File Permohonan</label>
                           <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                           <div class="input-group mb-4 file-browser">
                                 <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
                                 <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='file_permohonan' id="file_permohonan" class="file-browserinput" style="display: none;">
                                 </label>
                           </div>
                           @error('file_permohonan')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="form-group">
                           <label class="form-label form-label-required">Berkas SP SITA</label>
                           <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                           <div class="input-group mb-4 file-browser">
                                 <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
                                 <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='berkas_sp_sita' id="file_sp" class="file-browserinput" style="display: none;">
                                 </label>
                           </div>
                           @error('berkas_sp_sita')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="form-group">
                           <label class="form-label form-label-required">Berkas BA SITA</label>
                           <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                           <div class="input-group mb-4 file-browser">
                                 <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
                                 <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='berkas_ba_sita' id="file_ba" class="file-browserinput" style="display: none;">
                                 </label>
                           </div>
                           @error('berkas_ba_sita')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="form-group">
                           <label class="form-label form-label-required">Berkas BA CC</label>
                           <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                           <div class="input-group mb-4 file-browser">
                                 <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
                                 <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='berkas_ba_cc' id="berkas_ba_cc" class="file-browserinput" style="display: none;">
                                 </label>
                           </div>
                           @error('berkas_ba_cc')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        
                        <div class="form-group">
                           <label class="form-label form-label-required">Berkas Resume</label>
                           <div class="mt-2 text-info">format yang digunakan: pdf, maks 2Mb</div>
                           <div class="input-group mb-4 file-browser">
                                 <input type="text" class="form-control browse-file" id="value_file" placeholder="Choose">
                                 <label class="input-group-text btn btn-primary">
                                    Browse <input type="file" accept="application/pdf" wire:model.lazy='berkas_resume' id="file_resume" class="file-browserinput" style="display: none;">
                                 </label>
                           </div>
                           @error('berkas_resume')
                           <div class="mt-2 text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                     </div>
                  </div>
               </div>
         </div>
      </div>
      @endif
      
      <!-- Row Submit -->
      <div class="row">
         <div class="col-sm">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                           <div class="col-sm">
                              <a href="{{ url('/titipan-penahanan') }}" class="btn btn-warning btn-icon text-white">
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

            $('#file_permohonan').on('change', function () {
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

            $('#file_sp').on('change', function () {
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

            $('#file_ba').on('change', function () {
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

            $('#file_ba_cc').on('change', function () {
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

            $('#file_resume').on('change', function () {
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

            // data select2 type penahanan
            $('#kejaksaan_id').select2();
            $('#kejaksaan_id').on('change', function(e) {
                @this.set('kejaksaan_id', e.target.value);
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