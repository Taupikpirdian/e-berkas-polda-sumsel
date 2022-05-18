@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">List {{ $label }}</h1>
            </div>
            @if($fitur)
                @hasanyrole('kepolisian|kejaksaan')
                <div class="ms-auto pageheader-btn">
                    <a href="{{URL::to('/izin-pengadilan/create?fitur='.$fitur)}}" class="btn btn-primary btn-icon text-white me-2"><i class="fe fe-plus"></i>Tambah Data</a>
                </div>
                @endhasanyrole
            @endif
        </div>
        <!-- Row -->
        <div class="row row-sm">
            <livewire:izin-pengadilan.izin-pengadilan-index :fitur="$fitur">
        </div>
    </div>
</div>
@endsection