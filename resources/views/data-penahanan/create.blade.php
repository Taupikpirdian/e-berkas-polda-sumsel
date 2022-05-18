@extends('layout.app')
    @section('content')
    <div class="app-content hor-content">
        <div class="container">
            @if($fitur == 'pengadilan' || $fitur == 'kejaksaan')
            <livewire:data-penahanan.data-penahanan-update-modal :fitur="$fitur">
            @endif
        </div>
    </div>
    @endsection
@section('js')

@endsection