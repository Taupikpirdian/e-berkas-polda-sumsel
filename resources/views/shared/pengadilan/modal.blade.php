<style>
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
<div class="modal fade"  id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Persetujuan sita geledah</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <a href="{{URL::to('/master-pengadilan?fitur=izin-sita')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="text-success fs-40"><i class="ion-folder"/></i></div>
                                        <p class="mb-0"><span class="dot-label bg-secondary me-2"></span>Izin sita</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <a href="{{URL::to('/master-pengadilan?fitur=izin-geledah')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget text-center">
                                        <div class=" text-success fs-40"><i class="ion-folder"></i></div>
                                        <p class="mb-0"><span class="dot-label bg-success me-2"></span>Izin geledah</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- COL END -->
                </div>
            </div>
            <!-- <div class="modal-footer"> -->
                <!-- <button class="btn btn-primary" >Save changes</button> <button class="btn btn-light" data-bs-dismiss="modal" >Close</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>