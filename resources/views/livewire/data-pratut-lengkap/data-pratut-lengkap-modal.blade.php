@section('css')
<style>
    .center-align {
        text-align: center;
    }

    .color-green {
        color: green;
    }

    .color-yellow {
        color: #F7BE00;
    }

    .color-blue {
        color: #23AEC8;
    }
</style>
@endsection

<div class="col-lg-12 pb-4">
    <div class="card">
        <div class="card-body">
            <div class="row pl-5 pr-5">
              <div class="col-4">
                <fieldset class="form-group">
                  <input type="text" wire:model='query' class="form-control" placeholder="Cari berdasarkan no lp atau nama tersangka ...">
                </fieldset>
              </div>

              <div class="col-4">
                <div class="form-group">
                    <div class="d-flex align-items-center">
                        <div class="input-group col-12 p-0">
                            <input type="text" class="form-control" name="query_daterange" id="query_daterange"/>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="height: 40px">
                                  <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-4">
                <fieldset class="form-group" wire:ignore>
                  <select wire:model='status' class="form-control select2-show-search" id="status">
                      <option value="">Status</option>
                      @foreach($statuses as $ss)
                        <option value="{{ $ss->id }}">{{ $ss->name }}</option>
                      @endforeach
                  </select>
                </fieldset>
              </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="center-align">
                            <th rowspan="2">No</th>
                            <th rowspan="2">No LP</th>
                            <th rowspan="2">Tanggal LP</th>
                            <th rowspan="2">Tersangka</th>
                            <th rowspan="2">JPU</th>
                            @hasanyrole('kejaksaan')
                            <th rowspan="2">Penyidik</th>
                            @endhasanyrole
                            <th rowspan="2">Status</th>
                            <th rowspan="2">Updated By</th>
                            <th rowspan="2">Updated At</th>
                            <th class="text-center" rowspan="2">Aksi</th>
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
                                }elseif($dp->statusBerkas->id == 5){
                                    $class_span = 'bg-danger';
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
                                        @hasanyrole('kepolisian')
                                            @if($jaksa->masterJaksa)
                                                <a target="_blank" href="discussion?data={{ helperEncrypt($jaksa->masterJaksa->user_id) }}">
                                                    <i class="fa fa-comments text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Konsultasi dengan jaksa {{ $jaksa->masterJaksa->name }}"></i>
                                                </a>
                                            @endif
                                        @endhasanyrole
                                        @if($countTersangka != $key + 1), @endif
                                    </p>
                                    @empty
                                    <span class="badge bg-danger text-white">Belum ada</span>
                                    @endforelse
                                </div>
                            </td>
                            @hasanyrole('kejaksaan')
                            <td class="text-nowrap align-middle">
                                {{ $dp->penyidik ? $dp->penyidik->name : '' }}
                                @if($dp->penyidik)
                                    <a target="_blank" href="discussion?data={{ helperEncrypt($dp->penyidik->user_id) }}">
                                        <i class="fa fa-comments text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Diskusi dengan penyidik {{ $dp->penyidik->name }}"></i>
                                    </a>
                                @endif
                            </td>
                            @endhasanyrole

                            <td class="text-nowrap align-middle">
                                <span class="badge {{ $class_span }} text-white">{{ $dp->statusBerkas ? $dp->statusBerkas->name : '' }}</span>
                            </td>

                            <td class="text-nowrap align-middle">{{ userById($dp->updated_by) }}</td>
                            <td class="text-nowrap align-middle">{{ dateTimeIndo($dp->updated_at) }}</td>
                            <td class="text-center align-middle">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fe fe-list"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" wire:click="$emit('detailModal', {{ $dp->id }}, 'detail-datapratut')"><i class="fe fe-eye"></i> Detail</a>
                                        @hasanyrole('kepolisian')
                                        <a href="data-prapenuntutan-lengkap/{{ helperEncrypt($dp->id) }}/edit" class="dropdown-item"><i class="fa fa-edit"></i> Lengkapi Berkas</a>
                                        @endhasanyrole
                                        <a>Br</a>
                                        <a>Br</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- modal  -->
                        @include('livewire.data-pratut-lengkap.component.modal.modal')
                        <!-- end modal  -->
                        @empty
                        <td class="center-align" colspan="18">
                            Data Kosong
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="col-sm-12 mt-3" style="text-align: left;">
                {{ $paginate_content }}
            </p>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-5">
        {{ $dataPrapenuntutans->links("livewire::bootstrap") }}
    </div>
    <br>
</div>

@section('js')
{{-- delete --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // date range
        $('#query_daterange').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            singleDatePicker: false,
        })
        $('#query_daterange').on('change', function (e) {
            @this.set('query_daterange', e.target.value);
        });
        
        window.livewire.on('deleteModal', (params) => {
            setTimeout(function() {
                Swal.fire({
                    title: 'Apakah Anda yakin akan menghapus data ini?',
                    text: "Data yang dihapus akan masuk ke Recycle Bin, dihapus permanen setelah 30 hari!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya Hapus!',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('delete', params);
                        Swal.fire({
                            icon: "success",
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            confirmButtonClass: 'btn btn-success',
                        })
                    }
                });

            }, 1000);
        });

        window.livewire.on('detailModal', (id, fitur, idModal = null) => {
            setTimeout(function() {
                Swal.fire({
                    title: 'Masukan PIN!',
                    text: "Masukan PIN Anda untuk bisa melihat detail data prapenuntutan!",
                    icon: 'warning',
                    input: 'password',
                    inputAttributes: {
                        required: true,
                        placeholder: 'Masukan PIN Anda',
                        autocapitalize: 'off',
                        maxlength: 6,
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Submit',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                }).then(function(result) {
                    let pinUser = result.value;
                    if (pinUser) {
                        if(fitur == "detail-datapratut"){
                            window.livewire.emit('authPin', id, pinUser);
                        }

                        if(fitur == "modal-berkas"){
                            window.livewire.emit('authPinModalBerkas', id, pinUser, idModal);
                        }
                    }
                });

            }, 1000);
        });

        window.livewire.on('sweetAlertWithRedirect', (param) => {
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

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                })
            }, 1000);
        });

        window.livewire.on('showModalBerkas', (param) => {
            $(param).modal('show');
        });

        $('#status').on('change', function(e) {
          @this.set('status', e.target.value);
        });

        window.livewire.on('selectDua', (params) => {
            $('.select-dua').select2({
                allowClear : true,
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
        });
    });
</script>
@endsection