@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Data Prapenuntutan</h1>
            </div>
            @hasanyrole('kepolisian')
            <div class="ms-auto pageheader-btn">
                <a href="{{URL::to('/data-prapenuntutan/create')}}" class="btn btn-primary btn-icon text-white me-2"><i class="fe fe-plus"></i>Tambah Data</a>
            </div>
            @endhasanyrole
        </div>
        <!-- Row -->
        <livewire:datatable.data-pranut :filter="$filter">
    </div>
</div>
<script>
    function valueChanged(){
        
        if($('.custom-switch-input').is(":checked"))   
            $(".coupon_question").show();
        else
            $(".coupon_question").hide();
    }
</script>
@endsection