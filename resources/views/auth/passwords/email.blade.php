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
            <div class="card px-4 py-3">

                <div class="card-body">
                    <p class="fw-bold">Forgot Password ?</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="mb-3">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control bg-light shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        {{-- <div class="">
                            <button id="send-reset-btn" type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div> --}}

                        <div class="text-center mt-3">
                            <button type="submit" id="send-reset-btn" class="btn btn-primary rounded-1 d-flex justify-content-center align-items-center">
                                <span id="spinner" class="spinner-border spinner-border-sm me-3" style="display: none" aria-hidden="true"></span>
                                <p class="mb-0">Send Password Reset Link</p>
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
            isLoading(event, 'send-reset-btn');
        });

    </script>
@endpush
