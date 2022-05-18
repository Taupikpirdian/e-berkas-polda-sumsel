@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Limpah Perkara</h1>
            </div>
        </div>
        <!-- Row -->
        <div class="row row-sm">
			<livewire:data-pranut-limpah.data-pranut-limpah-modal>
        </div>
    </div>
</div>
@endsection