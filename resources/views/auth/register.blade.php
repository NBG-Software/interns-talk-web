@extends('layouts.guest')

@section('content')
<div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center py-4">
        <div class="col-11 col-md-8 col-lg-5">
            <div class="text-center mb-2">
                <img src="{{asset('assets/intern_talk_logo.png')}}" width="80" alt="">
            </div>
            <div class="text-center mb-5">
                <img src="{{asset('assets/intern_talk_text.png')}}" width="100" alt="">
            </div>
            <div class="card bg-white py-3 px-4 border-0">
                <div class="card-body">
                    <p class="fw-bold">Register as Mentor</p>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <img id="previewImg" src="{{asset('assets/profile_default.png')}}" class="rounded-pill @error('profile_picture') border border-2 border-danger @enderror" width="100" height="100" alt="">
                            @error('profile_picture')
                                <small class="text-danger mt-2">{{$message}}</small>
                            @enderror
                            <div class="mt-2 mb-3">
                                <label type="button" for="upload_profile">Upload Profile</label>
                                <input style="display: none" type="file" name="profile_picture" id="upload_profile">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Your Email</label>

                            <input id="email" type="email"
                                class="form-control bg-light shadow-none @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">Your Name</label>

                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="first_name" class="form-control bg-light shadow-none @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" required placeholder="First">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="last_name" class="form-control bg-light shadow-none @error('last_name') is-invalid @enderror" value="{{old('last_name')}}" required placeholder="Second">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Company</label>

                            <input id="company" type="text"
                                class="form-control bg-light shadow-none @error('company') is-invalid @enderror" name="company"
                                value="{{ old('company') }}" required autocomplete="company" autofocus>

                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Expertise</label>

                            <input id="expertise" type="text"
                                class="form-control bg-light shadow-none @error('expertise') is-invalid @enderror" name="expertise"
                                value="{{ old('expertise') }}" required autocomplete="expertise" autofocus>

                            @error('expertise')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="mb-2">Password</label>

                            <input id="password" type="password"
                                class="form-control bg-light shadow-none @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="mb-2">Confirm Password</label>

                            <input id="password" name="password_confirmation" type="password"
                                class="form-control bg-light shadow-none" required
                                autocomplete="current-password">

                        </div>

                        <div class="mb-3">
                            <a type="button" class="text-dark text-decoration-none" href="{{ route('login') }}">
                                Already have an account?
                            </a>
                        </div>

                        <div class="">
                            <button id="register-btn" type="submit" class="w-100 btn btn-primary">
                                Register
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
<script>
    let preview = document.getElementById('previewImg');
    let upload = document.getElementById('upload_profile');
    upload.addEventListener('change', function(event) {
        console.log(event);
        let imageFile = URL.createObjectURL(event.target.files[0]);
        if (imageFile) {
            preview.src = imageFile;

            preview.onload = () => URL.revokeObjectURL(imageFile);
        }

    });
</script>
@endpush
