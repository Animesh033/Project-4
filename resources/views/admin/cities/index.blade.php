@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Cities</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <h1>Cities</h1>
    <a href="{{ route('cities.create') }}">{{ __('Create city') }}</a>
    @if(isset($cities) && count($cities) > 0)
        @foreach($cities as $city)
        <ul>
            <li>{{ $city->name }} 
                <i class="fas fa-edit"></i>
                <a href="{{ route('cities.edit',[$city->id]) }}">{{ __('Edit') }}</a>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a   
                href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this city?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('del_city_{{$city->id}}').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="del_city_{{$city->id}}" action="{{ route('cities.destroy',[$city->id]) }}" 
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