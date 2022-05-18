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
    <livewire:kepolisian.data-pranut.store>
</div>
@endsection

