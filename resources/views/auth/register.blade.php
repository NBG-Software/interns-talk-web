@extends('layouts.guest')

@section('content')
    <div class="container vh-100">
        <div class="row h-100 justify-content-center align-items-center py-4">
            <div class="col-11 col-md-8 col-lg-5">
                <div class="text-center mb-2">
                    <img src="{{ asset('assets/intern_talk_logo.png') }}" width="80" alt="">
                </div>
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/intern_talk_text.png') }}" width="100" alt="">
                </div>
                <div class="card bg-white py-3 px-4 border-0">
                    <div class="card-body">
                        <p class="fw-bold">Register as Mentor</p>
                        <form method="POST" id="register-form" action="{{ route('register') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <img style="cursor: pointer;object-fit: cover;" id="previewImg"
                                    src="{{ asset('assets/profile_default.jpg') }}"
                                    class="rounded-pill @error('profile_picture') border border-2 border-danger @enderror"
                                    width="100" height="100" alt="">
                                @error('profile_picture')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror

                                <input type="hidden" name="base64_image" id="image_base64">

                                <div class="mt-1 mb-3">
                                    <label type="button" class="custom-hover" for="upload_profile">Upload Profile</label>
                                    <input style="display: none" type="file" accept="image/png, image/jpeg, image/jpg"
                                        name="profile_picture" id="upload_profile">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">Your Email</label>

                                <input id="email" type="email"
                                    class="form-control bg-light py-2 shadow-none @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                        <input type="text" name="first_name"
                                            class="form-control py-2 bg-light shadow-none @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}" required placeholder="First">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="last_name"
                                            class="form-control py-2 bg-light shadow-none @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}" required placeholder="Last">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">Company</label>

                                <input id="company" type="text"
                                    class="form-control bg-light shadow-none py-2 @error('company') is-invalid @enderror"
                                    name="company" value="{{ old('company') }}" required autocomplete="company" autofocus>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">Expertise</label>

                                <input id="expertise" type="text"
                                    class="form-control bg-light shadow-none py-2 @error('expertise') is-invalid @enderror"
                                    name="expertise" value="{{ old('expertise') }}" required autocomplete="expertise"
                                    autofocus>

                                @error('expertise')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Password</label>

                                <input style="letter-spacing: 5px;" id="password" type="password"
                                    class="form-control bg-light shadow-none fs-5 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Confirm Password</label>

                                <input style="letter-spacing: 5px;" id="password" name="password_confirmation"
                                    type="password" class="form-control bg-light shadow-none fs-5" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <a type="button" class="text-dark text-decoration-none custom-hover"
                                    href="{{ route('welcome') }}">
                                    Home
                                </a>
                                ||
                                <a type="button" class="text-dark text-decoration-none custom-hover"
                                    href="{{ route('login') }}">
                                    Already have an account?
                                </a>
                            </div>


                            <div class="text-center mt-3">
                                <button type="submit" id="register-btn"
                                    class="btn btn-primary rounded-1 w-100 d-flex justify-content-center align-items-center">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-3"
                                        style="display: none" aria-hidden="true"></span>
                                    <p class="mb-0">Register</p>
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
        document.addEventListener("DOMContentLoaded", function() {
            let preview = document.getElementById('previewImg');
            let upload = document.getElementById('upload_profile');
            let registerForm = document.getElementById('register-form');
            // let imageBase64Input = document.getElementById('image_base64');

            // // Restore the image from localStorage if available
            // if (localStorage.getItem("uploadedImage")) {
            //     preview.src = localStorage.getItem("uploadedImage");
            //     imageBase64Input.value = localStorage.getItem("uploadedImage");
            // }

            upload.addEventListener('change', function(event) {
                console.log(event);
                let imageFile = URL.createObjectURL(event.target.files[0]);
                if (imageFile) {
                    preview.src = imageFile;
                    localStorage.setItem("uploadedImage", imageFile);
                    preview.onload = () => URL.revokeObjectURL(imageFile);
                }

            });


            preview.addEventListener('click', function() {
                upload.click();
            })


            // // Clear localStorage after form submission (to avoid keeping old images)
            // registerForm.addEventListener("submit", function() {
            //     localStorage.removeItem("uploadedImage");
            // });
        });
    </script>
@endpush

@push('js')
    <script type="module">
        document.addEventListener('submit', function(event) {
            isLoading(event, 'register-btn');
        });
    </script>
@endpush
