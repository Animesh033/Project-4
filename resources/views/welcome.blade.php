@extends('layouts.app')
@section('navbar')
@include('navbar-welcome')
@endsection
@section('content-slider')
    {{-- @include('inc.slider')         --}}
    @admin
		<h1>You are a super admin!</h1>
	@else
		<h4>You are a user</h4>
    @endadmin
@endsection

@section('content')
    {{-- @include('inc.welcome')      --}}
@endsection