<div>
    <div class="page-header row">
        <div class="col-sm">
            <h1 class="page-title">List Perkara</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Perkara</li>
            </ol>
        </div>
        <div class="col-sm d-flex justify-content-end">
            <input class="form-header" wire:model='query' placeholder="Cari berdasarkan nama polres" type="text">
            <!-- <button class="ms-3 btn-header">Filter <i class="fa fa-sort-amount-desc"></i></button> -->
        </div>
    </div>
    <div class="row">
        @forelse($list_polres as $key=>$item)
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 list-polres">
                <a href="/list-perkara-kepolisian/{{$item->id}}">
                    <div class="card card-list__polri">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm">
                                    <h6>{{ $item->kategori }} - {{ $item->name }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @svg('images/cloud.svg', 'Cloud')
                                </div>
                                <div class="col-sm d-flex align-items-center justify-content-end">
                                    <h3 class="fw-bold">{{ $item->total }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm text-center" style="margin-bottom: -20px">
                                    <hr>
                                    <i class="fa fa-file-pdf-o mb-2 text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-12">
                <div class="card card-list__polri">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm text-center">
                                <h6>Data Kosong</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
