<div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Profile</div>
            <div class="card-options ms-auto">
                <a href="#" class="sidebar-icon text-end float-end me-1" data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tab-content">
                <div class="tab-pane active" id="side1">
                    <div class="card-body text-center">
                        <div class="dropdown user-pro-body">
                            <div class="">
                                <img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="../../assets/images/faces/6.jpg"><span class="avatar-status profile-status bg-green"></span>
                            </div>
                            <div class="user-info mg-t-20">
                                <h6 class="fw-semibold  mt-2 mb-0">{{ Auth::user()->name }}</h6>
                                <span class="mb-0 text-muted fs-12">{{ transRoleOperator()[Auth::user()->roles->pluck('name')[0]] }}</span>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-item d-flex border-bottom border-top" href="{{URL::to('/profiles')}}">
                        <div class="d-flex"><i class="fe fe-user me-3 tx-20 text-muted"></i>
                            <div class="pt-1">
                                <h6 class="mb-0">My Profile</h6>
                                <p class="tx-12 mb-0 text-muted">Data Profil User</p>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex border-bottom" href="{{URL::to('/clear-cache')}}">
                        <div class="d-flex"><i class="fe fe-trash me-3 tx-20 text-muted"></i>
                            <div class="pt-1">
                                <h6 class="mb-0">Clear Cache</h6>
                                <p class="tx-12 mb-0 text-muted">Membersihkan Cache</p>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex border-bottom" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-flex"><i class="fe fe-power me-3 tx-20 text-muted"></i>
                            <div class="pt-1">
                                <h6 class="mb-0">Sign Out</h6>
                                <p class="tx-12 mb-0 text-muted">Keluar dari Aplikasi</p>
                            </div>
                        </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>