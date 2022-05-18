<style>
    .modal-chache {
        margin-top: -15rem !important;
    }
    .card {
        cursor: pointer;
        border-radius: 10px;
        color: black;
    }
    .card:hover {
        box-shadow: 0px 7px 38px rgba(0, 0, 0, 0.15);
    }
</style>

<!-- MODAL EFFECTS -->
<div class="modal fade"  id="exampleModal">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo modal-chache">
            <div class="modal-header">
                <h6 class="modal-title">Pilih Kategori Data</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <a href="/dashboard">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="text-success fs-40"><i class="ion-folder"/></i></div>
                                        <p class="mb-0"><span class="dot-label bg-secondary me-2"></span>Asisten Bidang Tindak Pidana Umum (ASPIDUM)</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <a href="/dashboard">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget text-center">
                                        <div class=" text-success fs-40"><i class="ion-folder"></i></div>
                                        <p class="mb-0"><span class="dot-label bg-success me-2"></span>Asisten Bidang Tindak Pidana Khusus (ASPIDSUS)</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- COL END -->
                </div>
            </div>
        </div>
    </div>
</div>