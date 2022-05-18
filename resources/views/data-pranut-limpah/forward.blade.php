@extends('layout.app')
@section('content')
<div class="app-content hor-content">
    <div class="row row-sm">
        <livewire:data-pranut-limpah.data-pranut-limpah-forward :id="$id" :fitur="$fitur">
    </div>
</div>
@endsection