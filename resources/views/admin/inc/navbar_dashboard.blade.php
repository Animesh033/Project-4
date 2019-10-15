<nav class="navbar navbar-expand-lg sticky-top navbar-light navbar-laravel">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('img/logo.png')}}" width="90" height="90" class="d-inline-block align-top img-thumbnail rounded-circle" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                     @auth
@if(Auth::user()->can('isVerified', App\Models\Admin\Admin::class))
                         <ul class="navbar-nav mr-auto">
                    @if (Auth::user()->can('isSuperAdmin', App\models\Admin::class))
                         <!-- The Current User Can Create Posts -->
                             {{-- <a class="btn m-2 btn-outline-success" href="{{ route('audits.index') }}">{{ __('Audit Schedule') }}</a> --}}
                             <a class="btn m-2 btn-outline-success" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                             <a class="btn m-2 btn-outline-success" href="{{ route('states.index') }}">{{ __('States') }}</a>
                             <a class="btn m-2 btn-outline-success" href="{{ route('cities.index') }}">{{ __('Cities') }}</a>
                            {{--  <a class="btn m-2 btn-outline-success" href="{{ route('clients.index') }}">{{ __('Clients') }}</a> --}}
                             <a class="btn m-2 btn-outline-success" href="{{ route('regions.index') }}">{{ __('Regions') }}</a>
                             <a class="btn m-2 btn-outline-success" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                         
                      @endif
                     @if (Auth::user()->can('isAdmin', App\models\Admin::class) || Auth::user()->can('isSuperAdmin', App\models\Admin::class) )

                         <a class="btn m-2 btn-outline-success" href="{{ route('clients.index') }}">{{ __('Clients') }}</a>
                     @endif
                     @if (Auth::user()->can('isEditor', App\models\Admin::class))
                         <a class="btn m-2 btn-outline-success" href="{{ route('audits.index') }}">{{ __('Audit Schedule') }}</a>
                     @endif
                     </ul>

                @endif
                     <ul class="navbar-nav ml-auto">
                         
                         <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ Auth::user()->name }} <span class="caret"></span>
                             </a>

                             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                             </div>
                         </li>
                     </ul>
                     @endauth
                {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </nav>