<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cover.css') }}">
    
    
   
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/popper.min.js') }}"></script> <!-- or should it come before jquery? --> 
    
    
    
    <title> @yield("app-title", "ActorsApp") </title>
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto"> 
        <div class="inner">    
            <h3 class="masthead-brand">@yield("app-title")</h3>
            <nav class="nav nav-masthead justify-content-end">
            <!-- Authentication links --> 
                @guest 
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @if(Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endif
                @else 
                <div class="dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"
                        aria-labelledby="navbarDropdown">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                            Logout 
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> <!-- style"..." --> 
                            @csrf
                        </form>
                    </div>
                </div>
                        <a href="{{ route('logout') }}" class="btn btn-link" style="color:white;"
                            onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                            Logout 
                        </a>
                @endguest

                <!-- example --> 
                <!-- <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> -->
                <!-- end of example --> 
            </nav>
            <div class="clearfix"></div>
            <!-- refernces --> 
            <nav class="nav nav-masthead justify-content-center">
            
                <a class="nav-link" href="/">Home </a> 
                <a class="nav-link" href="/dynamic_pdf">PDF </a> 
                <a class="nav-link" href="/actors">Actors </a> <!--index --> 
                <a class="nav-link" href="/genre/0/films">Films </a> <!--index --> 
                <a class="nav-link" href="/genres">Genres </a> 
                @can('admin-page')
                    <a class="nav-link" href="/users">Admin</a> 
                @endcan
                <a class="nav-link" href="/about">About </a> 
            </nav>
        </div>
    </header>
    <main role="main" class="inner cover">
            <h1 class="cover-heading"> @yield("page-title")</h1>

            @yield("page-content")
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner"> <!-- do i have a page-footer defined somewhere? --> 
            @yield("page-footer")
        </div>
    </footer>
 </div>
</body>
</html>