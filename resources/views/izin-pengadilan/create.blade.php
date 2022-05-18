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
        @if(request()->fitur == 'izin-geledah' || request()->fitur == 'izin-sita')
            <div class="page-header">
                <div>
                    <h1 class="page-title">Form @if(request()->fitur == 'izin-geledah') Izin Geledah @else Izin Sita @endif</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/izin-pengadilan?fitur='.request()->fitur)}}">Izin Pengadilan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah @if(request()->fitur == 'izin-geledah') Izin Geledah @else Izin Sita @endif</li>
                    </ol>
                </div>
            </div>
        @endif
        <!-- PAGE-HEADER END -->
        <!-- Row -->
        @if($fitur == "izin-sita" || $fitur == "izin-geledah")
            <livewire:izin-pengadilan.izin-pengadilan-create :fitur="$fitur">
        @endif
        <!-- End Row -->
    </div>
</div>
@endsection
