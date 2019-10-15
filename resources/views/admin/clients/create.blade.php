@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Client</li>
            <li class="breadcrumb-item active" aria-current="page">Create Client</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Client</h4>
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <input type="text" class="form-control" name="clientName" id="clientName" aria-describedby="clientName" placeholder="Enter client name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="siteName">Client Site</label>
                            <input type="text" class="form-control" name="siteName" id="siteName" aria-describedby="siteName" placeholder="Enter site name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="stateName">Site State</label>
                          <select class="form-control" name="stateName" id="stateName">
                            <option value="">Select state </option>
                            @if(isset($states) && count($states) > 0)
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="cityName">Site City</label>
                          <select class="form-control" name="cityName" id="cityName">
                            <option value="">Select state first</option>
                            {{-- @if(isset($cities) && count($cities) > 0)
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @endif --}}
                          </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="regionName">Region Name</label>
                          <select class="form-control" name="regionName" id="regionName">
                            <option value="">Select city first</option>
                            {{-- @if(isset($regions) && count($regions) > 0)
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            @endif --}}
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="attendanceCycle"> Attendance Cycle</label>
                            <input type="text" class="form-control" name="attendanceCycle" id="attendanceCycle" aria-describedby="attendanceCycle" placeholder="Enter attendance cycle">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="siteIncharge">Site Incharge</label>
                            <input type="text" class="form-control" name="siteIncharge" id="siteIncharge" aria-describedby="siteIncharge" placeholder="Enter site incharge">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="remarks">Remarks </label>
                            <input type="text" class="form-control" name="remarks" id="remarks" aria-describedby="remarks" placeholder="Enter remarks name">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12">
        
        </div>
    </div>
</div>

@endsection