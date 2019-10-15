@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">City</li>
            <li class="breadcrumb-item active" aria-current="page">Create City</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>City</h4>
            <form method="POST" action="{{ route('cities.store') }}">
                @csrf
                <div class="form-group">
                    <label for="cityName">City Name</label>
                    <input type="text" class="form-control" name="cityName" id="cityName" aria-describedby="cityName" placeholder="Enter city name">
                  </div>
                  <div class="form-group">
                      <select class="form-control" name="cityState" id="cityState">
                        @if(isset($states) && count($states) > 0)
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        @endif
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-8">
        
        </div>
    </div>
</div>

@endsection