

            @extends('admin.layouts.admin_app')

            @section('admins_content')
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">State</li>
                        <li class="breadcrumb-item active" aria-current="page">Create State</li>
                    </ol>
                </nav>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    @include('inc.status.err_success')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>User</h4>
                        <form method="POST" action="{{ route('users.update', [$user->id]) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name" class="">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus placeholder="Enter name">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required placeholder="Enter email address">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="password" class="">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter new password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="role" class="">{{ __('Role') }}</label>
                                        <select class="form-control" name="roleName" id="roleName">
                                          @if(isset($roles) && count($roles) > 0)
                                              @foreach($roles as $role)
                                                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                                              @endforeach
                                          @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-top: 2em">
                                        {{-- <label for="" class="">{{ __('Submit') }}</label> --}}
                                        <button type="submit" class="btn btn-primary form-control">
                                            {{ __('Update user') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            @endsection