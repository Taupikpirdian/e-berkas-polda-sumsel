<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Diskusi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Diskusi</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-3">
            <div class="card">
                <div class="list-group list-group-transparent mt-2 mb-0 mail-inbox pb-3">
                    <a href="#" class="list-group-item d-flex align-items-center active ms-4 me-4">
                        <span class="icons"><i class="ri-mail-line"></i></span> Inbox <span class="ms-auto badge bg-success">14</span>
                    </a>
                </div>
                <div class="card-body border-top">
                    <div class="list-group list-group-transparent mb-0 mail-inbox ms-4 me-4">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center px-0 py-2">
                            <span class="w-3 h-3 brround bg-warning me-2"></span> Open
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center px-0 py-2">
                            <span class="w-3 h-3 brround bg-info me-2"></span> Progress
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center px-0 py-2">
                            <span class="w-3 h-3 brround bg-success me-2"></span> Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body p-6">
                    <div class="inbox-body">
                        <div class="mail-option">
                            <div class="chk-all">
                                <div class="btn-group">
                                    <a data-bs-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                        All
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a wire:click="refreshData()" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            
                            <ul class="unstyled inbox-pagination">
                                <li>
                                    <input class="form-control form-control-sm" wire:model='query' placeholder="Cari berdasarkan no lp ..." type="text" style="width:100%">
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-inbox table-hover text-nowrap mb-0">
                                <tbody>
                                    @forelse ($datas as $i=>$data)
                                    <tr class="">
                                        <td class="view-message dont-show fw-semibold"><a href="{{URL::to('/discussion/'.$data->id)}}">{{ $data->no_lp }}</a></td>
                                        <td class="view-message">{{ $data->diskusiDetail ? $data->diskusiDetail->text : 'belum ada diskusi ...' }}</td>
                                        <td class="view-message text-end fw-semibold">{{ dateIndo($data->date_no_lp) }}</td>
                                    </tr>
                                    @empty
                                    <tr class="">
                                        <td colspan="3" class="view-message">Data Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pagination mb-4">
                {{ $datas->links("livewire::bootstrap") }}
            </ul>
        </div>
    </div>
</div>
