<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex">
                                <h4 class="d-flex align-items-center mb-2 number-font text-dark">Kepolisian Sumatera Selatan</h4>
                            </div>
                            <div class="col col-auto">
                                <img src="{{asset('images/icon/icon.png')}}" class="header-brand-img desktop-logo" style="height: 70px;" alt="logo">
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
                                            <b><span class="text-dark"> LIST PENERIMAAN SPDP </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataPranut }} Data</span>
                                            @if($countDataPranutWithoutBerkas > 0)
                                            <span class="badge bg-danger text-white">{{ $countDataPranutWithoutBerkas }} Data SPDP Kembali</span>
                                            @endif
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a target="_blank" href="{{URL::to('/data-prapenuntutan')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-book fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PENERIMAAN BERKAS PERKARA </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataBerkas }} Data Pranut</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/data-prapenuntutan?filter=berkas')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-table fs-20"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> DATA P21 </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataP21 }} Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="{{URL::to('/data-prapenuntutan?filter=p21')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-book fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> TAHAP II </span></b>
                                            <span class="d-flex text-muted fs-11">{{ $countDataBerkasTahapII }} Data Pranut</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('/data-prapenuntutan-lengkap')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-info-transparent text-info">
                                        <i class="fa fa-comment fs-20"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> KOLOM DISKUSI </span></b>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a target="_blank" href="{{URL::to('/discussion')}}" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
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
                                <h4 class="d-flex align-items-center mb-2 number-font text-dark">Pengadilan Tinggi Sumatera Selatan</h4>
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
                                        <i class="fa fa-paper-plane fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> PENGIRIMAN BERKAS PERKARA </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="#" class="badge bg-primary-transparent text-white" style="width: 55px">Kirim</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-danger-transparent text-danger">
                                        <i class="fa fa-bars fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> LIST TANDA TERIMA BERKAS PERKARA </span></b>
                                            <span class="d-flex text-muted fs-11">0 Data</span>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold disabled">
                                            <a href="#" class="badge bg-primary-transparent text-white" style="width: 55px">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-blog">
                                    <div class="activity-img brround bg-success-transparent text-success">
                                        <i class="fa fa-bars fs-20 mt-1"></i>
                                    </div>
                                    <div class="activity-details d-flex">
                                        <div>
                                            <b><span class="text-dark"> LIST PENUNJUKAN HAKIM </span></b>
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
                                            <b><span class="text-dark"> JADWAL SIDANG </span></b>
                                        </div>
                                        <div class="ms-auto fs-13 text-dark fw-semibold">
                                            <a href="{{URL::to('http://sipp.pn-palembang.go.id/list_jadwal_sidang')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
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
                                            <a href="{{URL::to('http://www.pn-palembang.go.id/')}}" target="_blank" class="badge bg-primary text-white" style="width: 55px">Lihat</a>
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
</div>