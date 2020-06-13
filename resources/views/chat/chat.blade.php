@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <chat-component :user="{{ auth()->user() }}"></chat-component>
</div>
@endsection 