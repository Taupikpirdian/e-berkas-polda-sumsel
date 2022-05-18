<div wire:ignore.self class="modal fade"  id="modalBerkasDashboard" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Upload Berkas</b></h5>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-5">
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
                        {{ $paginate_content_modal_berkas }}
                    </p>
                    <div class="d-flex justify-content-end mb-5">
                        {{ $dataPrapenuntutans->links("livewire::bootstrap") }}
                    </div>
                </div>
                {{-- upload berkas --}}
                @if($dataPranutById)
                <div class="card-body">
                    <div class="media-heading">
                        <h5><strong>Data Prapenuntutan</strong></h5>
                    </div>
                    <hr>
                    <div class="table-responsive ">
                        <table class="table row table-borderless">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><strong>No LP :</strong> {{ $dataPranutById->no_lp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal LP :</strong> {{ dateIndo($dataPranutById->date_no_lp) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tersangka :</strong> 
                                        @foreach($dataPranutById->perkaraTersangka as $data)
                                            {{ $data->name }}, 
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><strong>JPU :</strong> 
                                        @foreach($dataPranutById->perkaraJaksa as $data)
                                        {{ $data->masterJaksa ? $data->masterJaksa->name : '' }}, 
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status :</strong> {{ $dataPranutById->statusBerkas ? $dataPranutById->statusBerkas->name : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="post" action="{{ route('store-berkas') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                        <div class="row profie-img">
                            <div class="col-md-12">
                                <div class="media-heading">
                                    <h5><strong>Berkas</strong></h5>
                                </div>
                                <div class="input-group mb-4 file-browser">
                                    <input type="text" class="form-control d-none" name="perkara_id" value="{{ $dataPranutById->id }}">
                                </div>
                                <div class="input-group mb-4 file-browser">
                                    <input type="text" class="form-control browse-file" placeholder="Choose">
                                    <label class="input-group-text btn btn-primary">
                                        Browse <input type="file" accept="application/pdf" name="files" class="file-browserinput" style="display: none;" required>
                                    </label>
                                </div>
                                @if(isset($dataPranutById->fileResumeBerkasPerkara))
                                    <div class="mt-2 mb-2 text-success">
                                        <b>Last Uploaded:</b> {{ dateIndo($dataPranutById->fileResumeBerkasPerkara->created_at, true) }},
                                        <br>
                                        <b>Nama File:</b>
                                        <a href="/download-file/{{ helperEncrypt($dataPranutById->fileResumeBerkasPerkara->id) }}">
                                            {{ $dataPranutById->fileResumeBerkasPerkara->original_name }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>