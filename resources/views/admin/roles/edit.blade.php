@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Role</h4>
            <form method="POST" action="{{ route('roles.update',[$role->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="roleName">Enter Role Name</label>
                    <input type="text" class="form-control" name="roleName" value="{{ $role->name }}" id="roleName" aria-describedby="roleName" placeholder="{{ $role->name }}">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-8">
        
        </div>
    </div>
</div>

@endsection