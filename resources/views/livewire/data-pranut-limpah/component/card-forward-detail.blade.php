<div class="card">
    <div class="card-header">
        <b>Data Berkas</b>
    </div>
    <div class="card-body">
        <h4 class="mb-5">List Berkas</h4>
        <div class="table-responsive">
            <table class="table table-striped border table-bordered table-hover">
                <thead>
                    <tr class="border-top">
                        <th class="w-10" style="text-align: center">No</th>
                        <th class="w-15" style="text-align: center">Forward File</th>
                        <th class="w-5" style="text-align: center">No Berkas</th>
                        <th class="w-15" style="text-align: center">Jenis Berkas</th>
                        <th class="w-15" style="text-align: center">Original Name</th>
                        <th class="w-15" style="text-align: center">Diupload</th>
                        <th class="w-10" style="text-align: center">Oleh</th>
                        <th class="w-10" style="text-align: center">Catatan</th>
                        <th class="w-10" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $z = $filePerkara->currentPage() > 1 ? (10 * ($filePerkara->currentPage() - 1)) + 1 : 1; ?>
                    @foreach($filePerkara as $key=>$files)
                    <tr>
                        <td style="text-align: center;">{{ $z }}</td>
                        <td style="text-align: center;">
                            <div class="custom-control custom-checkbox">
                                {{-- get list id file perkara untuk nanti tidak di submit forward perkara ke pengadilan --}}
                                <input class="form-check-input position-static" type="checkbox" id="checkbox{{$key}}"
                                    name="file_is_forward[]" value="{{$files->id}}" title="1" @if ($files->is_forward)
                                checked
                                @endif
                                disabled
                                >
                        </td>
                        <td>{{ $files->no_berkas ? $files->no_berkas : '-' }}</td>
                        <td style="text-align: center;">
                            <span class="badge bg-success">{{ $files->masterFile ? $files->masterFile->name : '-' }}</span>
                        </td>
                        <td>{{ $files->original_name ? $files->original_name : '-' }}</td>
                        <td>{{ $files->uploadedBy ? dateTimeIndo($files->uploadedBy->created_at) : '-' }}</td>
                        <td>{{ $files->uploadedBy ? $files->uploadedBy->name : '-' }}</td>
                        <td>{{ $files->catatan ? $files->catatan : '-' }}</td>
                        <td style="text-align: center">
                            <a href="/download-file/{{ helperEncrypt($files->id) }}"
                                class="btn btn-info-light btn-square  br-50 m-1" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="download berkas"><i class="fe fe-download fs-13""></i> </a>
                            </td>
                        </tr>
                        <?php $z++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class=" col-sm-12 mt-3" style="text-align: left;">{{ $paginate_content_fileperkara }} </p>
            <div class="mt-5">
                <div class="row">
                    <div class="col-sm">
                        <a href="{{ route('data-prapenuntutan-limpah.index') }}" class="btn btn-warning btn-icon text-white">
                            <span>
                                <i class="fe fe-log-in"></i>
                            </span> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-5">
        {!! $filePerkara->appends(['fileperkara' => $filePerkara->currentPage()])->links("livewire::bootstrap") !!}
    </div>
</div>