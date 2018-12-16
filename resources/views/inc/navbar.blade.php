<nav class="navbar navbar-expand-md navbar-light bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'GistMed') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/blogs">Blogs</a>
                    </li>

                    @if (Auth::guard('expert')->check())
                    {{-- User is authenticated as expert --}}
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle"  id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Threads</a>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                <a class="dropdown-item text-success" href="/threads/create">New Threads</a>
                                <a class="dropdown-item text-success" href="/threads">All Threads</a>
                                <a class="dropdown-item text-success" href="/threads?popular=1">Popular Threads</a>
                                <a class="dropdown-item text-success" href="/threads?by={{Auth::guard('expert')->user()->last_name}}+{{Auth::guard('expert')->user()->first_name}}&whose={{Auth::guard('expert')->user()->id}}">MyThreads</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle"  id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                @foreach ($channels as $channel)
                                    <a class="dropdown-item text-success" href="/threads/{{$channel->slug}}">{{$channel->channel}}</a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                                
                            </div>
                        </div>
                    </li>

                   
                    @elseif(Auth::guard('web')->check())
                    {{-- User is authenticated as user --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/gists/create">Ask a Question</a>
                    </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto ">
                    <!-- Authentication Links -->
                  @if (Auth::guard('expert')->check())
                     {{-- User is authenticated as expert --}}
                     <li class="nav-item">
                        <a class="nav-link" href="/blogs/create">Write an Article</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('expert')->user()->last_name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a class="dropdown-item" href="{{ route('expert.dashboard') }}">Dashboard</a>

                        <a class="dropdown-item" href="/profile/{{Auth::guard('expert')->id()}}">My Profile</a>
                            
                            <a class="dropdown-item" href="{{ route('expert.logout') }}">
                                {{ __('Logout') }}
                            </a>                        
                        </div>                            
                    </li>

                  @elseif(Auth::guard('web')->check())
                    <li class="nav-item dropdown">
                        {{-- User is authenticated as user --}}
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('web')->user()->alias }}</span>
                        </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                
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

                  @else
                  {{-- User is not authenticated in as either expert or user --}}
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                
                    <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('expert.login') }}">{{ __('Medical Professional?') }}</a>
                    </li>    
                  @endif
        
                </ul>
            </div>
        </div>
    </nav>