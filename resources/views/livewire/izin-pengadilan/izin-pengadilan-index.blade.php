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
                  <input type="text" wire:model='query' class="form-control" placeholder="Cari berdasarkan nama tersangka ...">
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
                      <option value="pengajuan">Pengajuan</option>
                      <option value="balasan">Balasan</option>
                  </select>
                </fieldset>
              </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="center-align">
                            <th rowspan="2">No</th>
                            <th rowspan="2">Pengadilan</th>
                            <th rowspan="2">Tanggal Register</th>
                            <th rowspan="2">{{ $pihak }}</th>
                            <th colspan="2">File</th>
                            <th rowspan="2">Status</th>
                            <th rowspan="2">Updated By</th>
                            <th rowspan="2">Updated At</th>
                            <th class="text-center" rowspan="2">Aksi</th>
                        </tr>
                        <tr class="text-center">
                            <th>File Pengajuan</th>
                            <th>File Balasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $i=>$data)
                        @php
                            $class_span = 'bg-info';
                            $text_span = 'Pengajuan';
                            if($data->status){
                                if($data->status == 'balasan'){
                                    $class_span = 'bg-success';
                                    $text_span = 'Balasan';
                                }
                            }
                        @endphp
                        <tr>
                            <td class="text-nowrap align-middle">{{ $i + 1 }}</td>
                            <td class="text-nowrap align-middle">{{ $data->pengadilan ? $data->pengadilan->name : '-' }}</td>
                            <td class="text-nowrap align-middle">{{ dateIndo($data->created_at) }}</td>
                            <td class="text-nowrap align-middle">{{ $data->pihak ? $data->pihak->name : '-' }}</td>
                            @hasanyrole('kepolisian|kejaksaan')
                                @include('livewire.izin-pengadilan.component.td-kepolisian')
                            @endhasanyrole
                            @hasanyrole('pengadilan')
                                @include('livewire.izin-pengadilan.component.td-pengadilan')
                            @endhasanyrole
                            <td class="text-nowrap align-middle">
                                <span class="badge {{ $class_span }} text-white">{{ $text_span }}</span>
                            </td>
                            <td class="text-nowrap align-middle">{{ userById($data->updated_by) }}</td>
                            <td class="text-nowrap align-middle">{{ dateTimeIndo($data->updated_at) }}</td>
                            <td class="text-center align-middle">
                                <div class="dropup btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fe fe-list"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="izin-pengadilan/{{ helperEncrypt($data->id) }}?fitur={{ $fitur }}" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @include('livewire.izin-pengadilan.component.modal')
                        @include('livewire.izin-pengadilan.component.modal-view')
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
        {{ $datas->links("livewire::bootstrap") }}
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

        $('#status').on('change', function(e) {
            @this.set('status', e.target.value);
        });
    });
</script>
@endsection