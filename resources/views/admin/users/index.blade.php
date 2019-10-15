@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Users</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <h1>Users</h1>
    <a href="{{ route('users.create') }}">{{ __('Create User') }}</a>
    @if(isset($users) && count($users) > 0)
        @foreach($users as $user)
        <ul>
            <li>{{ $user->name }} 
                <i class="fas fa-edit"></i>
                <a href="{{ route('users.edit',[$user->id]) }}">{{ __('Edit') }}</a>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a   
                href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this user?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('del_state_{{$user->id}}').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="del_state_{{$user->id}}" action="{{ route('users.destroy',[$user->id]) }}" 
                  method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                </form>
            </li>
        </ul>
        @endforeach
    @endif
</div>

@endsection