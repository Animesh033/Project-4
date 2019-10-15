@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Citty</li>
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
            <form method="POST" action="{{ route('clients.update',[$client->id]) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <input type="text" class="form-control" name="clientName" value="{{ $client->name }}" id="clientName" aria-describedby="clientName" placeholder="Enter client name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="siteName">Client Site</label>
                            <input type="text" class="form-control" name="siteName" value="{{ $client->site }}" id="siteName" aria-describedby="siteName" placeholder="Enter site name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="stateName">Site State</label>
                          <select class="form-control" name="stateName" id="stateName">
                            @if(isset($states) && count($states) > 0)
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ ($state->id == $client->state_id)  ? 'selected' : ''}}>{{ $state->name }}</option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="cityName">Site City</label>
                          <select class="form-control" name="cityName" id="cityName">
                            @if(isset($cities) && count($cities) > 0)
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ ($city->id == $client->city_id)  ? 'selected' : ''}}>{{ $city->name }}</option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="regionName">Region Name</label>
                          <select class="form-control" name="regionName" id="regionName">
                            @if(isset($region) && count($region) > 0)
                                {{-- @foreach($regions as $region) --}}
                                    <option value="{{ $region->id }}" {{-- {{ ($region->id == $client->region_id)  ? 'selected' : ''}} --}}>{{ $region->name }}</option>
                                {{-- @endforeach --}}
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="attendanceCycle"> Attendance Cycle</label>
                            <input type="text" class="form-control" name="attendanceCycle" value="{{ $client->attendance_cycle }}" id="attendanceCycle" aria-describedby="attendanceCycle" placeholder="Enter attendance cycle">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="siteIncharge">Site Incharge</label>
                            <input type="text" class="form-control" name="siteIncharge" value="{{ $client->incharge }}" id="siteIncharge" aria-describedby="siteIncharge" placeholder="Enter site incharge">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="remarks">Remarks </label>
                            <input type="text" class="form-control" name="remarks" value="{{ $client->remarks }}" id="remarks" aria-describedby="remarks" placeholder="Enter remarks name">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-md-8">
        
        </div>
    </div>
</div>

@endsection