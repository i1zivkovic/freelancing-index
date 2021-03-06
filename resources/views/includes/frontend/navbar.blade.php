<!-- Header Section Start -->
<header id="home" class="hero-area">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar top-nav-collapse">
        <div class="container">
            <div class="theme-header clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
                        aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="/" class="navbar-brand"><img src="{{asset('img')}}/logo.png" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="fas fa-home mr-2"></i> Home
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-users"></i> Community
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('frontend.getUsers')}}">Users</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.showFollowing')}}">Following</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.showFollowers')}}">My Followers</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-user-tie mr-2"></i> Work
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('frontend.jobs.index')}}">Find A Job</a></li>
                              {{--   <li><a class="dropdown-item" href="browse-categories.html">Browse Categories</a></li> --}}
                                <li><a class="dropdown-item" href="{{route('frontend.getUserApplications')}}">My
                                        Applications</a></li>
                                 @guest
                                 <li><a class="dropdown-item" href="{{route('login')}}">My
                                    Ratings</a></li>
                                 @else
                                <li><a class="dropdown-item" href="{{route('frontend.user-ratings.show', ['slug' => Auth::user()->slug])}}">My
                                        Ratings</a></li>
                                @endguest

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-handshake mr-2"></i> Employ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('frontend.jobs.create')}}">Post A Job Ad</a></li>
                                @guest
                                <li><a class="dropdown-item" href="{{route('login')}}">My Job Ads</a></li>
                                {{-- <li><a class="dropdown-item" href="{{route('login')}}">My Jobs</a></li> --}}
                                @else
                                <li><a class="dropdown-item" href="{{route('frontend.myJobs',['slug' => Auth::user()->slug])}}">My
                                        Job Ads</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.getManageApplications')}}">Manage
                                        Applications</a></li>
                                @endguest

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-newspaper mr-2"></i> Posts
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('frontend.posts.create')}}">Create New Post</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.posts.index')}}">Feed</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.posts.explore')}}">Explore</a></li>
                                @guest
                                <li><a class="dropdown-item" href="{{route('login')}}">My Posts</a></li>
                                @else
                                <li><a class="dropdown-item" href="{{route('frontend.myPosts',['slug' => Auth::user()->slug])}}">My
                                        Posts</a></li>
                                @endguest
                            </ul>
                        </li>
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-user mr-2"></i>{{ Auth::user()->username}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('frontend.user.show',['slug' => Auth::user()->slug])}}">My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.profileEdit', ['slug' => Auth::user()->slug])}}">Edit
                                        Profile</a></li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="{{asset('img')}}/logo-mobile.png"></div>
    </nav>
    <!-- Navbar End -->
    {{-- <ul>


</header>
<!-- Header Section End -->
