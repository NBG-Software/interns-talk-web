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

     {{-- favicon --}}
     <link rel="icon" href="{{URL::asset('intern.png')}}" type="image/png" sizes="192x192">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="min-vh-100 d-flex flex-column">
        <nav class="navbar navbar-expand-md navbar-light bg-white border-0 border-bottom border-black-50 sticky-top">
            <div class="container-fluid px-4 py-1">
                {{-- nav logo --}}
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/intern_talk_logo.png') }}" class="me-3" width="50" alt="">

                    <a class="py-0" href="{{ url('/') }}">
                        <img src="{{ asset('assets/intern_talk_text.png') }}" width="100" alt="">
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
                        <li class="nav-item d-md-block d-none">
                            <a class="nav-link custom-hover" aria-current="page" href="{{route('profile.show')}}">
                                <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' .  Auth::user()->profile_picture) : asset('assets/profile_default.jpg') }}" class="me-2 rounded-circle" width="50"
                                        alt="">
                                <span class="mb-0">Mentor {{ Auth::user()->full_name }}</span>
                            </a>
                        </li>


                    @endauth
                </ul>
            </div>
        </nav>

        <main class="container-fluid px-0 h-100 d-flex flex-grow-1 position-relative">
            <aside class="bg-white sidebar h-100 border-0 border-end border-black-50 p-4 position-fixed overflow-auto">
                <ul class="list-unstyled">
                    <li class="mb-2 d-md-none d-block">
                        <a href="{{ route('profile.show') }}"
                            class="text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' .  Auth::user()->profile_picture) : asset('assets/profile_default.jpg') }}" class="me-2 rounded-circle" width="50"
                                        alt="">
                                </div>
                                <div class="ms-2">
                                    <p class="mb-2">Mentor</p>
                                    <p class="mb-0 fw-bold">{{Auth::user()->full_name}}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="mb-2 mt-md-0 mt-4">
                        <a href="{{ route('intern.list') }}"
                            class="btn btn-custom-hover text-start text-dark fw-bold w-100 {{ request()->fullurl() == route('intern.list') ? 'btn-secondary' : '' }}">
                            <img src="{{ asset('assets/dashboard/chart-bar.png') }}" class="me-2" width="15"
                                alt="">
                            Intern List
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('profile.show') }}"
                            class="btn btn-custom-hover text-start text-dark fw-bold w-100 {{ request()->fullurl() == route('profile.show') ? 'btn-secondary' : '' }}">
                            <img src="{{ asset('assets/dashboard/cog.png') }}" class="me-2" width="15"
                                alt="">
                            Edit Profile
                        </a>
                    </li>

                    <li class="">
                        <form action="{{ route('logout') }}" method="post" class="">
                            @csrf
                            <button class="btn btn-custom-hover  text-start w-100 text-dark fw-bold">
                                <img src="{{ asset('assets/dashboard/logout.png') }}" class="me-2" width="15"
                                    alt="">
                                Log out
                            </button>
                        </form>

                    </li>
                </ul>
            </aside>

            <div class="container-fluid d-flex flex-column flex-grow-1 py-4 bg-white content-container">
                {{-- <h4>Nothing here</h4> --}}
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
