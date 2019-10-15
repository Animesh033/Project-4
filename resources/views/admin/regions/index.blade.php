@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Regions</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <h1>Regions</h1>
    <a href="{{ route('regions.create') }}">{{ __('Create Regions') }}</a>
    @if(isset($regions) && count($regions) > 0)
        @foreach($regions as $region)
        <ul>
            <li>{{ $region->name }} 
                <i class="fas fa-edit"></i>
                <a href="{{ route('regions.edit',[$region->id]) }}">{{ __('Edit') }}</a>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a   
                href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this region?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('del_region_{{$region->id}}').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="del_region_{{$region->id}}" action="{{ route('regions.destroy',[$region->id]) }}" 
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