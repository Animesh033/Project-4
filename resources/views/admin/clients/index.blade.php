@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Clients</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}">{{ __('Create Client') }}</a>
    @if(isset($clients) && count($clients) > 0)
        @foreach($clients as $client)
        <ul>
            <li>{{ $client->name }} 
                <i class="fas fa-edit"></i>
                <a href="{{ route('clients.edit',[$client->id]) }}">{{ __('Edit') }}</a>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a   
                href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this client?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('del_client_{{$client->id}}').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="del_client_{{$client->id}}" action="{{ route('clients.destroy',[$client->id]) }}" 
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