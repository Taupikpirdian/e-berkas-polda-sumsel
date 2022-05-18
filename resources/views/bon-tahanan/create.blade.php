@extends('layout.app')
@section('content')

<style>
    .modal .form-control {
        text-align: center !important;
        border-top : none !important;
        border-left : none !important;
        border-right : none !important;
        border-radius: 0px !important;
    }
</style>

<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Form Bon Tahanan</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/bon-tahanan')}}">Bon Tahanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Bon Tahanan</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- Row -->
        <livewire:bon-tahanan.bon-tahanan-update>
        <!-- End Row -->
    </div>
</div>
@endsection