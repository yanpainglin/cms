<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>TheSaaS — Blog with sidebar</title>

    <!-- Styles -->
    <link href="{{'css/page.css'}}" rel="stylesheet">
    <link href="{{'css/style.scss'}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
</head>

<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
    <div class="container">

        <div class="navbar-left">
            <button class="navbar-toggler" type="button">&#9776;</button>
            <a class="navbar-brand" href="../index.html">
                <img class="logo-dark" src="{{asset('logo/logo-dark.png')}}" alt="logo">
                <img class="logo-light" src="{{asset('logo/logo-light.png')}}" alt="logo">
            </a>
        </div>


        {{--  right side of navbar--}}
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link login-button btn btn-xs btn-round btn-success " href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-xs btn-round btn-success " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-large btn-round btn-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item btn btn-xs btn-round btn-success" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>



    </div>
</nav><!-- /.navbar -->




<!-- Header -->
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
    <div class="container">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h1>Latest Blog Posts</h1>
                <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress</p>

            </div>
        </div>

    </div>
</header><!-- /.header -->


<!-- Main Content -->
<main class="main-content">
    <div class="section bg-gray">
        <div class="container">
            <div class="row">


                <div class="col-md-8 col-xl-9">
                    <div class="row gap-y">

                        @foreach($posts as $post)
                            <div class="col-md-6">
                                <div class="card border hover-shadow-6 mb-6 d-block">
                                    <a href="#"><img class="card-img-top" src="{{asset('storage/'.$post->image)}}" alt="Card image cap"></a>
                                    <div class="p-6 text-center">
                                        <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{$post->title}}</a></p>
                                        <h5 class="mb-0"><a class="text-dark" href="#">{{$post->description}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


{{--                    <nav class="flexbox mt-30">--}}
{{--                        <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>--}}
{{--                        <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>--}}
{{--                    </nav>--}}

                    {{$posts->appends(['search'=> request()->query('search')])->links()}}
                </div>



                <div class="col-md-4 col-xl-3">
                    <div class="sidebar px-4 py-md-0">

                        <h6 class="sidebar-title">Search</h6>
                        <form class="input-group" action="{{route('welcome')}}" method="GET">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <div class="input-group-addon">
                                <span class="input-group-text"><i class="ti-search"></i></span>
                            </div>
                        </form>

                        <hr>

                        <h6 class="sidebar-title">Categories</h6>
                        @foreach($categories as $category)
                            <div class="row link-color-default fs-14 lh-24">
                                <div class="col-6"><a href="#">{{$category -> name}}</a></div>
                            </div>
                        @endforeach

                        <hr>

                        <h6 class="sidebar-title">Tags</h6>
                       @foreach($tags as $tag)
                            <div class="gap-multiline-items-1">
                                <a class="badge badge-secondary" href="#">{{$tag->name}}</a>
                            </div>
                        @endforeach

                        <hr>

                        <h6 class="sidebar-title">About</h6>
                        <p class="small-3">TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.</p>


                    </div>
                </div>

            </div>
        </div>
    </div>
</main>


<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row gap-y align-items-center">

            <div class="col-6 col-lg-3">
                <a href="../index.html"><img src="{{asset('logo/logo-dark.png')}}" alt="logo"></a>
            </div>

            <div class="col-6 col-lg-3 text-right order-lg-last">
                <div class="social">
                    <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i class="fa fa-facebook"></i></a>
                    <a class="social-twitter" href="https://twitter.com/thethemeio"><i class="fa fa-twitter"></i></a>
                    <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i class="fa fa-instagram"></i></a>
                    <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i class="fa fa-dribbble"></i></a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="nav nav-bold nav-uppercase nav-trim justify-content-lg-center">
                    <a class="nav-link" href="../uikit/index.html">Elements</a>
                    <a class="nav-link" href="../block/index.html">Blocks</a>
                    <a class="nav-link" href="../page/about-1.html">About</a>
                    <a class="nav-link" href="../blog/grid.html">Blog</a>
                    <a class="nav-link" href="../page/contact-1.html">Contact</a>
                </div>
            </div>

        </div>
    </div>
</footer><!-- /.footer -->


<!-- Scripts -->
<script src="{{asset('js/page.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

</body>
</html>
