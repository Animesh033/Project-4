@extends('layouts.app')
@section('navbar')
@include('auth.inc.navbar-dashboard')
@endsection
@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
        @include('inc.status.err_success')

        </div>
    </div>
</div>
@endsection