@extends('layout.app')
@section('content')
<style>
    .content-scroll {
        height: 32rem !important;
        overflow: auto;
    }

    .content-scroll-file {
        height: 24rem !important;
        overflow: auto;
    }

    .dropify-wrapper input {
        width: 20000px !important;
    }
</style>

<div class="app-content hor-content">
    <livewire:data-pratut-lengkap.data-pratut-lengkap-update :id="$id">
</div>
@endsection

