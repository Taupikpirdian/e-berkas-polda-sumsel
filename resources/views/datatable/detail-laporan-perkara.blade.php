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

    .ff_fileupload_wrap .ff_fileupload_dropzone {
        height: 180px !important;
    }
</style>

<div class="app-content hor-content">
    <livewire:kepolisian.data-pranut.show :id="$id">
</div>
@endsection