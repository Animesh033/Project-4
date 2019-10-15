@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">States</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <h1>States</h1>
    <a href="{{ route('states.create') }}">{{ __('Create State') }}</a>
    @if(isset($states) && count($states) > 0)
        @foreach($states as $state)
        <ul>
            <li>{{ $state->name }} 
                <i class="fas fa-edit"></i>
                <a href="{{ route('states.edit',[$state->id]) }}">{{ __('Edit') }}</a>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a   
                href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this state?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('del_state_{{$state->id}}').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="del_state_{{$state->id}}" action="{{ route('states.destroy',[$state->id]) }}" 
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