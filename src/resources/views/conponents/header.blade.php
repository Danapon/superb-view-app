<header class="header">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
              {{ config('app.name', 'Laravel') }}
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav me-auto">

              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ms-auto">
                  <!-- Authentication Links -->
                  @auth  
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('superb_views.create') }}" style="font-weight: bold;">絶景を投稿</a>
                  </li>
                  @endauth

                  @guest
                      @if (Route::has('login'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                      @endif

                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else


                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>
                        
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('users.destroy', Auth::user()) }}"
                                    onclick="delete_alert(event); return false;">
                                    {{ __('Quit') }}
                                </a>

                                <form action="{{ route('users.destroy', Auth::user()) }}" method="POST" class="d-none" name="deleteform">
                                    @csrf
                                    @method('delete')
                                </form>
                            </li>
                          </ul>
                      </li>
                  @endguest

                      <li class="ms-3">
                        <form method="GET" action="{{ route('superb_views.index') }}" style="display:inline-flex">
                          <div class="form-group">
                            <input class="form-control" type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                          </div>
                            <button class="btn btn-outline-success ms-1" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
                        </form>
                      </li>

              </ul>
          </div>
      </div>
  </nav>
</header>