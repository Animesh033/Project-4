@extends('admin.layouts.admin_app')

@section('admins_content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Region</li>
            <li class="breadcrumb-item active" aria-current="page">Create Region</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('inc.status.err_success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Region</h4>
            <form method="POST" action="{{ route('regions.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                                            <label for="regionName">Region Name</label>
                                            <input type="text" class="form-control" name="regionName" id="regionName" aria-describedby="regionName" placeholder="Enter region name">
                                          </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stateName">State Name</label>
                            <select class="form-control" name="stateName" id="stateName">
                              <option value="">Select State</option>
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
                            <label for="cityName">City Name</label>
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
                    <div class="col-md-1">
                        <label for="submit"></label>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <label>Clickable optgroup:</label>
            <select id="regionCity" class="form-control form-control-chosen-optgroup" title="regionCity" data-placeholder="Please select..." multiple>
              <optgroup label="Label A">
                <option>Option One</option>
                <option>Option Two</option>
                <option>Option Three</option>
                <option>Option Four</option>
              </optgroup>
              <optgroup label="Label B">
                <option>Option Five</option>
                <option>Option Six</option>
                <option>Option Seven</option>
                <option>Option Eight</option>
              </optgroup>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-4 mb-5">
      <label>Multiple:</label>
      <select id="multiple" class="form-control form-control-chosen" data-placeholder="Please select..." multiple>
        <option></option>
        <option>Option One</option>
        <option>Option Two</option>
        <option>Option Three</option>
        <option>Option Four</option>
        <option>Option Five</option>
        <option>Option Six</option>
        <option>Option Seven</option>
        <option>Option Eight</option>
      </select>
    </div>
</div>
@push('admin_scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> --}}
    <script>

      $('.form-control-chosen').chosen({
        allow_single_deselect: true,
        width: '100%'
      });
      
        $('.form-control-chosen-optgroup').chosen({
          width: '100%'
        });

        $(function() {
          $('[title="regionCity"]').addClass('chosen-container-optgroup-clickable');
        });
        $(document).on('click', '[title="regionCity"] .group-result', function() {
          var unselected = $(this).nextUntil('.group-result').not('.result-selected');
          if(unselected.length) {
            unselected.trigger('mouseup');
          } else {
            $(this).nextUntil('.group-result').each(function() {
              $('a.search-choice-close[data-option-array-index="' + $(this).data('option-array-index') + '"]').trigger('click');
            });
          }
        });
    </script>
@endpush

@endsection