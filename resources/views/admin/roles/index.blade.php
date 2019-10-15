@extends('admin.layouts.admin_app')
@section('admins_content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page">Admin</li>
        <li class="breadcrumb-item active" aria-current="page">Role</li>
    </ol>
</nav>
<div class="row justify-content-center">
    <div class="col-md-12">
    @include('inc.status.err_success')
    </div>
</div>
<a href="{{ route('roles.create') }}">{{ __('Create Roles') }}</a>
@if(isset($roles) && count($roles) > 0)
	@foreach($roles as $role)
	<ul>
	    <li>{{ $role->name }} 
	    	<i class="fas fa-edit"></i>
	    	<a href="{{ route('roles.edit',[$role->id]) }}">{{ __('Edit') }}</a>
		    <i class="fa fa-power-off" aria-hidden="true"></i>
		    <a   
		    href="#"
		        onclick="
		        var result = confirm('Are you sure you wish to delete this role?');
		            if( result ){
		                    event.preventDefault();
		                    document.getElementById('del_role_{{$role->id}}').submit();
		            }
		                "
		                >
		        Delete
		    </a>

		    <form id="del_role_{{$role->id}}" action="{{ route('roles.destroy',[$role->id]) }}" 
		      method="POST" style="display: none;">
		              <input type="hidden" name="_method" value="delete">
		              {{ csrf_field() }}
		    </form>
		</li>
	</ul>
	@endforeach
@endif
@endsection