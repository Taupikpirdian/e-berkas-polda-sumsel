<div class="container">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>

    @if(Auth::user()->change_pw == 0)
        <div class="alert alert-warning" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
            <span class="alert-inner--text"><strong>Info!</strong> Untuk keamanan akun Anda, mohon untuk ubah password <a target="_blank" href="{{URL::to('/profiles')}}">disini</a>!</span>
        </div>
    @endif

    @hasanyrole('kepolisian')
        @if($is_complete_penyidik == false)
            <div class="alert alert-warning" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"><strong>Info!</strong> Data profil belum lengkap, Harap untuk melengkapi data profil <a target="_blank" href="{{URL::to('/profiles')}}">disini</a>!</span>
            </div>
        @endif

        @if($is_akses_penyidik == false)
            <div class="alert alert-warning" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"><strong>Info!</strong> Mohon maaf, Anda belum memiliki Akses ke Satuan Kerja manapun, mohon untuk menghubungi Admin!</span>
            </div>
        @endif
    @endhasanyrole

    @hasanyrole('kejaksaan')
        @if($activeJaksa == false)
            <div class="alert alert-warning" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"><strong>Warning!</strong> User ini belum diarahkan ke data Jaksa Penuntut Umum, Harap untuk menghubungi Admin Master!</span>
            </div>
        @endif
    @endhasanyrole
    
    <!-- PAGE-HEADER END -->		
    <!-- ROW-1 -->
    @hasanyrole('kepolisian')
        @include('livewire.dashboard.component.row-kepolisian')
    @endhasanyrole
    <!-- ROW-2 -->
    @hasanyrole('admin-kejaksaan|admin|admin-master')
        @include('livewire.dashboard.component.row-admin-kejaksaan')
    @endhasanyrole
    {{-- ROW 3 --}}
    @hasanyrole('kejaksaan')
        @include('livewire.dashboard.component.row-kejaksaan')
    @endhasanyrole
    <!-- ROW-4 -->
    @hasanyrole('pengadilan')
        @include('livewire.dashboard.component.row-pengadilan')
    @endhasanyrole
    <!-- ROW-5 -->
    @hasanyrole('admin-lapas|lapas')
        @include('livewire.dashboard.component.row-lapas')
    @endhasanyrole
    <!-- ROW-6 -->
    @hasanyrole('operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')
        @include('livewire.dashboard.component.row-operator')
    @endhasanyrole
    <!-- ROW-7 -->
    @hasanyrole('admin-kepolisian')
    @include('livewire.dashboard.component.row-admin-kepolisian')
    @endhasanyrole
</div>