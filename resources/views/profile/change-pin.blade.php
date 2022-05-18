@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <livewire:profile.profile-update-pin :id="$id">
    </div>
</div>
@endsection
@section('js')

@endsection