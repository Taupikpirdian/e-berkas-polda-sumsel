@extends('layout.app')
@section('content')
<div class="app-content hor-content">
	<div class="container">
        <livewire:general.conversation.index :dataParam="$dataParam">
    </div>
</div>
@endsection
@section('js')

@endsection