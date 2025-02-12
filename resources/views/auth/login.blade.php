@extends('layouts.guest')

@section('content')
    <div class="container vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-11 col-md-8 col-lg-5">
                <div class="text-center mb-2">
                    <img src="{{asset('assets/intern_talk_logo.png')}}" width="80" alt="">
                </div>
                <div class="text-center mb-5">
                    <img src="{{asset('assets/intern_talk_text.png')}}" width="100" alt="">
                </div>
                <div class="card bg-white py-3 px-4 border-0">
                    <div class="card-body">
                        <p class="fw-bold">Sign in to your account</p>
                        @error('throttle_error')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                          </div>
                        @enderror
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">Your Email</label>

                                <input id="email" type="email"
                                    class="form-control py-2 bg-light shadow-none @if ($errors->has('login_fail') || $errors->has('email')) is-invalid @endif"  name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Password</label>

                                <input style="letter-spacing: 5px;" id="password" type="password"
                                    class="form-control fs-5 bg-light shadow-none @if ($errors->has('login_fail') || $errors->has('password')) is-invalid @endif" name="password" required
                                    autocomplete="current-password">

                                @if ($errors->has('login_fail') || $errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login_fail') ?: $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>


                            <div class="d-flex flex-md-row flex-column justify-content-between align-items-center mb-3">
                                <div  class="form-check">
                                    <input style="cursor: pointer;" class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="">
                                        <a type="button" class="text-dark text-decoration-none custom-hover" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <a type="button" class="text-dark text-decoration-none custom-hover" href="{{ route('register') }}">
                                    Don't have an account?
                                </a>
                            </div>


                            <div class="text-center mt-3">
                                <button type="submit" id="login-btn" class="btn btn-primary rounded-1 w-100 d-flex justify-content-center align-items-center">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-3" style="display: none" aria-hidden="true"></span>
                                    <p class="mb-0">Login</p>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module">
        document.addEventListener('submit', function (event) {
            isLoading(event, 'login-btn');
        });

    </script>
@endpush
