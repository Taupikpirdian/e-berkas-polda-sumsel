@extends('layout.app')
    @section('content')
    <div class="app-content hor-content">
        <div class="container">
            <livewire:bpac-tipiring.bpac-tipiring-update :id="$id" :fitur="$fitur">
        </div>
    </div>
    @endsection
@section('js')

@endsection