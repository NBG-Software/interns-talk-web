<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white border-0 border-bottom border-black-50">
            <div class="container-fluid px-5 py-1">
                {{-- nav logo --}}
                <div class="d-flex align-items-center">
                    <img src="{{asset('assets/intern_talk_logo.png')}}" class="me-3" width="50" alt="">

                    <a class="py-0" href="{{ url('/') }}">
                        <img src="{{asset('assets/intern_talk_text.png')}}" width="100" alt="">
                    </a>
                </div>

                {{-- toggle button --}}
                <button id="toggle-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="navbar-nav ms-auto nav-mentor">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                Mentor {{ Auth::user()->full_name }}
                            </a>
                        </li>


                    @endauth
                </ul>
            </div>
        </nav>

        <main class="container-fluid h-100 px-0 d-flex position-relative">
            <aside class="bg-white h-100 sidebar border-0 border-end border-black-50 p-4">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="" class="btn btn-secondary text-start text-dark fw-bold w-100">
                            Intern List
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="" class="btn text-start text-dark fw-bold w-100">
                            Edit Profile
                        </a>
                    </li>

                    <li class="">
                        <form action="{{route('logout')}}" method="post" class="">
                            @csrf
                            <button type="submit" class="btn text-start w-100 text-dark fw-bold">Log out</button>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="p-4">
                <h4>Nothing here</h4>
                @yield('content')
            </div>
        </main>
    </div>
    <script>
        let toggleBtn = document.getElementById("toggle-btn");
        let sidebar = document.querySelector(".sidebar");

        toggleBtn.addEventListener("click", function() {
            sidebar.classList.toggle("active");
        });
    </script>
    @stack('js')
</body>

</html>
