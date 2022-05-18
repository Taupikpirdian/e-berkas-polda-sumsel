<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex">
                                <h4 class="d-flex align-items-center mb-2 number-font text-dark">Kejaksaan Tinggi Sumatera Selatan</h4>
                            </div>
                            <div class="col col-auto">
                                <img src="{{asset('images/icon/icon-kejaksaan-lg.png')}}" class="header-brand-img desktop-logo" style="height: 70px;" alt="logo">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="activity1">
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-balance-scale fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> SPDP </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataPranut }} Data Pranut</span>
                                            @if($countDataPranutOpen > 0)
                                            <span class="badge bg-danger text-white">{{ $countDataPranutOpen }} Menunggu P16</span>
                                            @endif
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/data-prapenuntutan/create')}}" class="badge bg-primary text-white" style="width: 55px">Tambah</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-calendar-check-o fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PERPANJANGAN PENAHANAN </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="{{URL::to('/perpanjangan-penahanan')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-book fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PENGIRIMAN BERKAS </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataBerkas }} Data Pranut</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/data-prapenuntutan?filter=berkas')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-comment fs-20"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> DISKUSI PERKARA </span></b>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/discussion')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex">
                                <h4 class="d-flex align-items-center mb-2 number-font text-dark">Pengadilan Negeri di Wilayah Sumatera Selatan</h4>
                            </div>
                            <div class="col col-auto">
                                <img src="{{asset('images/icon/icon-pengadilan.png')}}" class="header-brand-img desktop-logo" style="height: 70px;" alt="logo">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="activity1">
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-bars fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> IZIN SITA </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/izin-pengadilan/create?fitur=izin-sita')}}" class="badge bg-primary text-white" style="width: 55px">Tambah</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-bars fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> IZIN GELEDAH </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/izin-pengadilan/create?fitur=izin-geledah')}}" class="badge bg-primary text-white" style="width: 55px">Tambah</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-calendar-plus-o fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PENETAPAN SITA GELEDAH </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/izin-pengadilan/create?fitur=all')}}" class="modal-effect badge bg-primary text-white" data-bs-toggle="modal" data-bs-effect="effect-flip-horizontal" data-bs-target="#modaldemo8" style="width: 55px; cursor: pointer;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-table fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PERPANJANGAN PENAHANAN </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="#" class="badge bg-primary-transparent text-white" style="width: 55px">Tambah</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-calendar-plus-o fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> BACP TIPIRING </span></b>
                                            <span class="d-flex text-muted fs-11">{{$countDataBpacTipiring}} Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="{{URL::to('/bacp-tipiring')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-calendar-plus-o fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> DIVERSI </span></b>
                                            <span class="d-flex text-muted fs-11">{{$countDataDiversi}} Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="{{URL::to('/diversi')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-calendar-plus-o fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PERSETUJUAN SP HAN </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="#" class="badge bg-primary-transparent text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-globe fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> AMAR PUTUSAN </span></b>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('http://sipp.pn-palembang.go.id/')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-globe fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> JADWAL SIDANG </span></b>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('http://sipp.pn-palembang.go.id/list_jadwal_sidang')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex">
                                <h4 class="d-flex align-items-center mb-2 number-font text-dark">Lapas Sumatera Selatan</h4>
                            </div>
                            <div class="col col-auto">
                                <img src="{{asset('images/icon/icon-kemenkumham-lg.png')}}" class="header-brand-img desktop-logo" style="height: 70px;" alt="logo">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="activity1">
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-bars fs-20"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> RUMAH TAHANAN </span></b>
                                            <span class="d-flex text-muted fs-11">{{$countDataRumahTahanan}} Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/rumah-tahanan')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-bars fs-20"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> LIST DATA TAHANAN </span></b>
                                            <span class="d-flex text-muted fs-11">{{$countDataTahanan}} Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/tahanan')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    @include('livewire.dashboard.modal.modal-berkas')
</div>