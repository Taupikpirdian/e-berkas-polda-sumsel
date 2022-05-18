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

    .ribbon {
        position: absolute;
        right: -18px;
        top: -36px;
        z-index: 1;
        overflow: hidden;
        width: 75px;
        height: 75px;
        text-align: right;
    }

    .ribbon span {
        background: rgba(255, 0, 0, 0.5);
    }

    .arrow-toggle.collapsed .fa-angle-down
    {
        display: none;
    }

    .arrow-toggle .fa-angle-down
    {
        display: inline-block;
    }

    .arrow-toggle.collapsed .fa-angle-up
    {
        display: inline-block;
    }

    .arrow-toggle .fa-angle-up
    {
        display: none;
    }

    .show-entries{
        position: relative;
        right: 28px;
    }
</style>

@endsection
<div class="row">
    @include('include.loading-delay')
    <div class="col-lg-2 pb-4">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Tampilkan</p>
                <form id="filterForm">
                    <input type="checkbox" id="all" name="f_column" value="f_all">
                    <label for="all"> Semua</label><br>
                    <hr>
                    <input type="checkbox" id="f_tersangka" name="f_column" value="f_tersangka">
                    <label for="f_tersangka"> Tersangka</label><br>
                    <input type="checkbox" id="f_jpu" name="f_column" value="f_jpu">
                    <label for="f_jpu"> JPU</label><br>
                    <input type="checkbox" id="f_spdp" name="f_column" value="f_spdp">
                    <label for="f_spdp"> SPDP</label><br>
                    <input type="checkbox" id="f_p16" name="f_column" value="f_p16">
                    <label for="f_p16"> P16</label><br>
                    <input type="checkbox" id="f_berkas" name="f_column" value="f_berkas">
                    <label for="f_berkas"> Berkas</label><br>
                    <input type="checkbox" id="f_p17" name="f_column" value="f_p17">
                    <label for="f_p17"> P17</label><br>
                    <input type="checkbox" id="f_sop" name="f_column" value="f_sop">
                    <label for="f_sop"> SOP 02</label><br>
                    <input type="checkbox" id="f_p18" name="f_column" value="f_p18">
                    <label for="f_p18"> P18</label><br>
                    <input type="checkbox" id="f_p19" name="f_column" value="f_p19">
                    <label for="f_p19"> P19</label><br>
                    <input type="checkbox" id="f_p20" name="f_column" value="f_p20">
                    <label for="f_p20"> P20</label><br>
                    <input type="checkbox" id="f_p21" name="f_column" value="f_p21">
                    <label for="f_p21"> P21</label><br>
                    <input type="checkbox" id="f_p21a" name="f_column" value="f_p21a">
                    <label for="f_p21a"> P21A</label><br>
                    <input type="checkbox" id="f_b_kembali" name="f_column" value="f_b_kembali">
                    <label for="f_b_kembali" style="font-size: 12px"> Berkas Kembali</label><br>
                    <hr>
                    <input class="btn btn-success" type="button" onclick="filterData()" value="Filter">
                    {{-- <button class="btn btn-success" id="submit">Filter</button> --}}
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-10 pb-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <label for="show-entries">Show:</label>
                    <select wire:model='perPage' id="show-entries">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    <label for="show-entries">entries</label>
                </div>

                <div class="table-responsive mt-2">
                    <table class="table table-bordered">
                        <thead style="background-color: #F2F3F9">
                            <tr class="center-align">
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SPDP</th>
                                <th rowspan="2">Tanggal SPDP</th>
                                <th rowspan="2" class="v_tersangka">Tersangka</th>
                                <th rowspan="2" class="v_jpu">JPU</th>
                                <th rowspan="2">Penyidik</th>
                                <th colspan="11" id="t_file">File</th>
                                <th rowspan="2">Status</th>
                                <th rowspan="2">Updated By</th>
                                <th rowspan="2">Updated At</th>
                                <th class="text-center" rowspan="2">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <th class="v_spdp">SPDP</th>
                                <th class="v_p16">P16</th>
                                <th class="v_berkas">Berkas</th>
                                <th class="v_p17">P17</th>
                                <th class="v_sop">SOP 02</th>
                                <th class="v_p18">P18</th>
                                <th class="v_p19">P19</th>
                                <th class="v_p20">P20</th>
                                <th class="v_p21">P21</th>
                                <th class="v_p21a">P21a</th>
                                <th class="v_b_kembali">Berkas Kembali</th>
                            </tr>
                            <tr class="center-align">
                                <th class="text-center">
                                    <button class="btn btn-light" wire:click="resetFilter"><i class="fa fa-refresh" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Reset Filter"></i></button>
                                </th>
                                <th>
                                    <input type="text" wire:model='query_spdp' class="form-control" autocomplete="off">
                                </th>
                                <th>
                                    <input type="text" class="form-control" name="query_daterange" id="query_daterange"/>
                                </th>
                                <th class="v_tersangka">
                                    <input type="text" wire:model='query_tersangka' class="form-control" autocomplete="off">
                                </th>
                                <th class="v_jpu">
                                    <input type="text" wire:model='query_jpu' class="form-control" autocomplete="off">
                                </th>
                                <th>
                                    <input type="text" wire:model='query_penyidik' class="form-control" autocomplete="off">
                                </th>
                                <th class="v_spdp"></th>
                                <th class="v_p16"></th>
                                <th class="v_berkas"></th>
                                <th class="v_p17"></th>
                                <th class="v_sop"></th>
                                <th class="v_p18"></th>
                                <th class="v_p19"></th>
                                <th class="v_p20"></th>
                                <th class="v_p21"></th>
                                <th class="v_p21a"></th>
                                <th class="v_b_kembali"></th>
                                <th wire:ignore>
                                    <select wire:model='status' class="form-control select2-show-search" id="status">
                                        <option value="">Status</option>
                                        @foreach($statuses as $ss)
                                          <option value="{{ $ss->id }}">{{ $ss->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPrapenuntutans as $i=>$dp)
                                @php
                                $dateNow = date('Y-m-d H:i:s');
                                $class_span_date_line = 'bg-info';
                                $text_date_line = $dp->dead_line_upload_berkas ? dateTimeIndo($dp->dead_line_upload_berkas) : '-';
                                $class_span_date_line_jaksa = 'bg-info';
                                $text_date_line_jaksa = $dp->dead_line_response_jaksa ? dateTimeIndo($dp->dead_line_response_jaksa) : '-';
        
                                $class_span = 'bg-info';
                                if($dp->statusBerkas){
                                if($dp->statusBerkas->id == 1){
                                    $class_span = 'bg-warning';
                                }elseif($dp->statusBerkas->id == 2){
                                    $class_span = 'bg-info';
                                }elseif($dp->statusBerkas->id == 5 || $dp->statusBerkas->id == 7 || $dp->statusBerkas->id == 8){
                                    $class_span = 'bg-danger';
                                }else{
                                    $class_span = 'bg-success';
                                }
                                }
        
                                $countTersangka = count($dp->perkaraTersangka);
        
                                // deadline upload berkas
                                if($dp->dead_line_upload_berkas < $dateNow){
                                    $class_span_date_line = 'bg-danger';
                                    $text_date_line = 'Penyidik Harap Segera Upload!';
                                }
                                // deadline respon jaksa
                                if($dp->dead_line_response_jaksa < $dateNow){
                                    $class_span_date_line_jaksa = 'bg-danger';
                                    $text_date_line_jaksa = 'Jaksa Harap Segera Respon!';
                                }
                                @endphp
                                <tr>
                                    <td class="align-middle">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="text-nowrap align-middle">
                                        <div class="card shadow-none border-0">
                                            {{ $dp->fileSpdpFirst ? $dp->fileSpdpFirst->no_berkas : '' }}
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ dateIndo($dp->fileSpdpFirst ? $dp->fileSpdpFirst->tgl_berkas : '') }}</td>
                                    <td class="text-nowrap align-middle v_tersangka">
                                        <div style="height: 50px;  overflow-y: scroll">
                                            @forelse($dp->perkaraTersangka as $key=>$tersangka)
                                            <p> Tersangka {{ $key + 1 }}: 
                                                @if($tersangka->is_proses == 1)
                                                    {{ $tersangka->name }}
                                                @else
                                                    <s>{{ $tersangka->name }}</s>
                                                @endif
                                                @if($countTersangka != $key + 1), @endif
                                            </p> 
                                            @empty
                                            <span class="badge bg-danger text-white">Belum ada</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="text-nowrap align-middle v_jpu">
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
                                    <td class="text-nowrap align-middle">
                                        {{ $dp->penyidik ? $dp->penyidik->name : '' }}
                                        @hasanyrole('kejaksaan')
                                        @if($dp->penyidik)
                                            <a target="_blank" href="discussion?data={{ helperEncrypt($dp->penyidik->user_id) }}">
                                                <i class="fa fa-comments text-success" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Diskusi dengan penyidik {{ $dp->penyidik->name }}"></i>
                                            </a>
                                        @endif
                                        @endhasanyrole
                                    </td>
                                    {{-- file spdp --}}
                                    <td class="text-nowrap align-middle v_spdp">
                                        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSpdp_{{$dp->id}}">
                                            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i>
                                        </a>
                                    </td>
                                    {{-- td kepolisian --}}
                                    @hasanyrole('kepolisian')
                                        @include('livewire.datatable.component.td-kepolisian')
                                    @endhasanyrole
                                    {{-- td admin-kejaksaan --}}
                                    @hasanyrole('admin-kejaksaan')
                                        @include('livewire.datatable.component.td-admin-kejaksaan')
                                    @endhasanyrole
                                    {{-- td admin-kepolisian --}}
                                    @hasanyrole('admin-kepolisian')
                                        @include('livewire.datatable.component.td-admin-kepolisian')
                                    @endhasanyrole
                                    {{-- td kejaksaan --}}
                                    @hasanyrole('kejaksaan')
                                        @include('livewire.datatable.component.td-kejaksaan')
                                    @endhasanyrole
                                    {{-- td operator --}}
                                    @hasanyrole('operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')
                                        @include('livewire.datatable.component.td-operator')
                                    @endhasanyrole
                                    {{-- td admin-master --}}
                                    @hasanyrole('admin-master')
                                        @include('livewire.datatable.component.td-admin-master')
                                    @endhasanyrole
        
                                    <td class="text-nowrap align-middle">
                                        <span class="badge {{ $class_span }} text-white">{{ $dp->statusBerkas ? $dp->statusBerkas->name : '' }}</span>
                                    </td>
                                    <td class="align-middle">{{ userById($dp->updated_by) }}</td>
                                    <td class="align-middle">{{ dateTimeIndo($dp->updated_at) }}</td>
                                    <td class="text-center align-middle">
                                        <div class="dropup btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fe fe-list"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" wire:click="$emit('detailModal', {{ $dp->id }}, 'detail-datapratut')"><i class="fe fe-eye"></i> Detail</a>
                                                @hasanyrole('admin-kepolisian')
                                                @if($dp->status == 1 || $dp->status == 2 || $dp->status == 3 || $dp->status == 4 ||  $dp->status == 5 || $dp->status == 6)
                                                <a class="dropdown-item" wire:click="$emit('detailModal', {{ $dp->id }}, 'edit-penyidik', '#editPenyidikByPerkara_{{$dp->id}}')"><i class="fa fa-edit"></i> Edit Penyidik</a>
                                                @endif
                                                @endhasanyrole
                                                @hasanyrole('kepolisian')
                                                @if($dp->status == 1 || $dp->status == 2)
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_henti_{{$dp->id}}"><i class="fe fe-x-circle"></i> Hentikan Perkara</a>
                                                <a href="data-prapenuntutan/{{ helperEncrypt($dp->id) }}/edit" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                                    @if(isset($dp->fileP18) || isset($dp->fileP19) || isset($dp->fileP20))
                                                        <a href="split-tersangka/{{ helperEncrypt($dp->id) }}" class="dropdown-item"><i class="fa fa-user"></i> Update Berkas atau Split Perkara</a>
                                                    @endif
                                                @endif
                                                <a class="dropdown-item" wire:click="$emit('deleteModal', {{ $dp->id }})"><i class="fe fe-trash"></i> Hapus</a>
                                                @endhasanyrole
                                                @hasanyrole('admin-kejaksaan')
                                                @if($dp->status == 1)
                                                <a class="dropdown-item" wire:click="$emit('selectDua', {{ $dp->id }})" data-bs-toggle="modal" data-bs-target="#modal-jaksa{{$dp->id}}"><i class="fe fe-user-plus"></i> Pilih Jaksa</a>
                                                @endif
                                                @if(isset($dp->perkaraJaksa) && $dp->status != 1)
                                                <a class="dropdown-item" wire:click="$emit('detailModal', {{ $dp->id }}, 'edit-jaksa', '#modal-edit-jaksa{{$dp->id}}')"><i class="fa fa-edit"></i> Edit Jaksa</a>
                                                @endif
                                                @endhasanyrole
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- table split --}}
                                @if($dp->is_split == 1)
                                    <tr>
                                        <td colspan="19" class="hiddenRow">
                                            <span data-toggle="collapse" data-target="#split_{{ $dp->id }}" class="arrow-toggle collapsed accordion-toggle">
                                                Detail Split Perkara
                                                <span type="button" class="fa fa-angle-down"></span>
                                                <span type="button" class="fa fa-angle-up"></span>
                                            </span>
                                            <div class="accordian-body collapse mt-3" id="split_{{ $dp->id }}">
                                                <table class="table table-side side-custom col-md-12">
                                                    <thead>
                                                        <tr class="info">
                                                            <th>No</th>
                                                            <th>No SPDP</th>
                                                            <th>Tanggal SPDP</th>
                                                            <th>Tersangka</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dp->fileSpdpSplit as $key=>$spdpSplit)
                                                        <tr data-toggle="collapse" class="accordion-toggle">
                                                            <td> {{ $key+1 }}</td>
                                                            <td> {{ $spdpSplit->no_berkas ? $spdpSplit->no_berkas : '-' }}</td>
                                                            <td> {{ $spdpSplit->tgl_berkas ? dateIndo($spdpSplit->tgl_berkas) : '-' }}</td>
                                                            <td> {{ $spdpSplit->tersangka ? $spdpSplit->tersangka->name : '' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                                <!-- modal  -->
                                @include('shared.file-datatable.file-modal')
                                @include('shared.kejaksaan.modal')
                                @include('shared.modal')
        
                                @include('shared.file-datatable.file-only-view-modal')
                                @hasanyrole('kejaksaan|operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')
                                    @include('shared.file-datatable.file-kejaksaan-modal')
                                @endhasanyrole
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
</div>

@section('js')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function hideData(){
        // hide
        $('#t_tersangka').addClass('d-none');
        $('.v_tersangka').addClass('d-none');
        $('#t_jpu').addClass('d-none');
        $('.v_jpu').addClass('d-none');

        // file
        $('#t_file').addClass('d-none');
        $('#t_spdp').addClass('d-none');
        $('#t_p16').addClass('d-none');
        $('#t_berkas').addClass('d-none');
        $('#t_p17').addClass('d-none');
        $('#t_sop').addClass('d-none');
        $('#t_p18').addClass('d-none');
        $('#t_p19').addClass('d-none');
        $('#t_p20').addClass('d-none');
        $('#t_p21').addClass('d-none');
        $('#t_p21a').addClass('d-none');
        $('#t_b_kembali').addClass('d-none');

        // isi file
        $('.v_spdp').addClass('d-none');
        $('.v_p16').addClass('d-none');
        $('.v_berkas').addClass('d-none');
        $('.v_p17').addClass('d-none');
        $('.v_sop').addClass('d-none');
        $('.v_p18').addClass('d-none');
        $('.v_p19').addClass('d-none');
        $('.v_p20').addClass('d-none');
        $('.v_p21').addClass('d-none');
        $('.v_p21a').addClass('d-none');
        $('.v_b_kembali').addClass('d-none');
    }

    function filterData() {
        let f_filter = []; // make an array
        f_filter.f_tersangka = $("#f_tersangka").is(":checked");
        f_filter.f_jpu = $("#f_jpu").is(":checked");
        f_filter.f_spdp = $("#f_spdp").is(":checked");
        f_filter.f_p16 = $("#f_p16").is(":checked");
        f_filter.f_berkas = $("#f_berkas").is(":checked");
        f_filter.f_p17 = $("#f_p17").is(":checked");
        f_filter.f_sop = $("#f_sop").is(":checked");
        f_filter.f_p18 = $("#f_p18").is(":checked");
        f_filter.f_p19 = $("#f_p19").is(":checked");
        f_filter.f_p20 = $("#f_p20").is(":checked");
        f_filter.f_p21 = $("#f_p21").is(":checked");
        f_filter.f_p21a = $("#f_p21a").is(":checked");
        f_filter.f_b_kembali = $("#f_b_kembali").is(":checked");

        // tersangka
        if(f_filter.f_tersangka){
            $('.v_tersangka').removeClass('d-none');
        }else{
            $('.v_tersangka').addClass('d-none');
        }
        // jpu
        if(f_filter.f_jpu){
            $('.v_jpu').removeClass('d-none');
        }else{
            $('.v_jpu').addClass('d-none');
        }
        
        if(f_filter.f_spdp || f_filter.f_p16 || f_filter.f_berkas || f_filter.f_p17 || f_filter.f_sop || f_filter.f_p18 || f_filter.f_p19 || f_filter.f_p20 || f_filter.f_p21 || f_filter.f_p21a || f_filter.f_b_kembali){
            $('#t_file').removeClass('d-none');
            const arr = [f_filter.f_spdp, f_filter.f_p16, f_filter.f_berkas, f_filter.f_p17, f_filter.f_sop, f_filter.f_p18, f_filter.f_p19, f_filter.f_p20, f_filter.f_p21, f_filter.f_p21a, f_filter.f_b_kembali];
            const count = arr.filter(Boolean).length;
            document.getElementById("t_file").colSpan = count;
        }else{
            $('#t_file').addClass('d-none');
        }

        // spdp
        if(f_filter.f_spdp){
            $('.v_spdp').removeClass('d-none');
        }else{
            $('.v_spdp').addClass('d-none');
        }
        // p16
        if(f_filter.f_p16){
            $('.v_p16').removeClass('d-none');
        }else{
            $('.v_p16').addClass('d-none');
        }
        // f_berkas
        if(f_filter.f_berkas){
            $('.v_berkas').removeClass('d-none');
        }else{
            $('.v_berkas').addClass('d-none');
        }
        // f_p17
        if(f_filter.f_p17){
            $('.v_p17').removeClass('d-none');
        }else{
            $('.v_p17').addClass('d-none');
        }
        // f_sop
        if(f_filter.f_sop){
            $('.v_sop').removeClass('d-none');
        }else{
            $('.v_sop').addClass('d-none');
        }
        // f_p18
        if(f_filter.f_p18){
            $('.v_p18').removeClass('d-none');
        }else{
            $('.v_p18').addClass('d-none');
        }
        // f_p19
        if(f_filter.f_p19){
            $('.v_p19').removeClass('d-none');
        }else{
            $('.v_p19').addClass('d-none');
        }
        // f_p20
        if(f_filter.f_p20){
            $('.v_p20').removeClass('d-none');
        }else{
            $('.v_p20').addClass('d-none');
        }
        // f_p21
        if(f_filter.f_p21){
            $('.v_p21').removeClass('d-none');
        }else{
            $('.v_p21').addClass('d-none');
        }
        // f_p21a
        if(f_filter.f_p21a){
            $('.v_p21a').removeClass('d-none');
        }else{
            $('.v_p21a').addClass('d-none');
        }
        // f_b_kembali
        if(f_filter.f_b_kembali){
            $('.v_b_kembali').removeClass('d-none');
        }else{
            $('.v_b_kembali').addClass('d-none');
        }
    }

    // Listen for click on toggle checkbox
    $('#all').click(function(event) { 
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    }); 

    document.addEventListener('DOMContentLoaded', function() {
        hideData();
        // date range
        $('#query_daterange').daterangepicker({
            // autoUpdateInput: false,
            singleDatePicker: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
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

            var text;
            switch(fitur) {
                case "detail-datapratut":
                    text = "Masukan PIN anda untuk bisa melihat detail data prapenuntutan!";
                    break;
                case "modal-berkas":
                    text = "Masukan PIN anda untuk bisa melihat detail berkas!";
                    break;
                case "edit-penyidik":
                    text = "Masukan PIN anda untuk bisa edit penyidik!";
                    break;
                case "edit-jaksa":
                    text = "Masukan PIN anda untuk bisa edit jaksa!";
                    break;
                default:
                    text = "Fitur anda tidak ada";
                    break;
            }

            setTimeout(function() {
                Swal.fire({
                    title: 'Masukan PIN!',
                    text: text,
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
                        switch(fitur) {
                            case "detail-datapratut":
                                window.livewire.emit('authPin', id, pinUser);
                                break;
                            case "modal-berkas":
                            case "edit-penyidik":
                            case "edit-jaksa":
                                window.livewire.emit('authPinModalBerkas', id, pinUser, idModal);
                                break;
                            default:
                                text = "Fitur anda tidak ada";
                                break;
                        }
                    }
                });

            }, 1000);

            // checkbox one data 
            $("input:checkbox").on('click', function() {
            var $box = $(this);
                if ($box.is(":checked")) {
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });

            // selec2 data 
            $('.edit-jaksa').select2({
                allowClear : true,
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
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

        window.livewire.on('callAgainJs', (params) => {
            hideData();
            filterData();
        });
    });
</script>
@endsection