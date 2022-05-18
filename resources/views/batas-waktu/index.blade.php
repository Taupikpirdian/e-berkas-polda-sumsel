@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Batas Waktu Upload</h1>
            </div>
        </div>
        <!-- Row -->
        <div class="row row-sm">
			<livewire:batas-waktu.batas-waktu-modal>
        </div>
    </div>
</div>
@endsection