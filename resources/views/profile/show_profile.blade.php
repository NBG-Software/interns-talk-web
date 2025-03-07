@extends('layouts.app')

@section('content')
    <div class="px-2">
        <div class="">
            {{-- tab bar with edit button modal --}}
            <div class="d-flex align-items-center">
                <p class="fs-5 fw-medium mb-0 me-3">Mentor Detail</p>
                {{-- Button trigger Modal --}}
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="d-flex btn btn-white align-items-center border border-0" href="">
                    <img src="{{ asset('assets/dashboard/edit.png') }}" class="me-1" width="20" height="20"
                        alt="">
                    <span class="custom-hover">Edit</span>
                </button>
            </div>

            {{-- Preview and upload image --}}
            <div class="mt-3">
                <p class="">Image : </p>
                <img id="preview-img" src="{{ $user->profile_picture ? asset('storage/profile_pictures/' . $user->profile_picture) : asset('assets/profile_default.jpg') }}"
                    class="mb-2" width="150">

                <form action="{{ route('image.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="">

                        <label style="cursor: pointer;" class="custom-hover" id="profile-label" for="upload_profile">
                            <img
                                src="{{ asset('assets/dashboard/document-upload.png') }}" class="me-2 " width="18"
                                alt=""> Upload Profile</label>
                        <input style="display: none" type="file" accept="image/png, image/jpeg, image/jpg" name="profile_picture" class=""
                            id="upload_profile">

                        @error('profile_picture')
                            <small class="text-danger">{{$message}}</small>
                        @enderror

                    </div>

                    <button style="display: none !important;" id="change-btn" type="submit"
                        class="btn btn-primary text-white rounded-1 d-flex justify-content-center align-items-center">
                        <span id="spinner" class="spinner-border spinner-border-sm me-3" style="display: none"
                            aria-hidden="true"></span>
                        <p class="mb-0">Change</p>
                    </button>
                </form>

            </div>
            <hr>

            {{-- Mentor Information --}}
            <div class="">
                <p>Name : {{ $user->full_name }}</p>
                <p>Expertise : {{ $user->mentor->expertise }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Company : {{ $user->mentor->company }}</p>
            </div>
            <hr>
        </div>

        <!-- Modal for updating mentor information -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog custom-modal modal-dialog-centered px-lg-0 px-3">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="modal-title fs-6 fw-semibold" id="exampleModalLabel">Edit Profile</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('profile.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $user->full_name) }}" required>
                            @error('name')
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Expertise</label>
                            <input type="text" class="form-control" name="expertise"
                                value="{{ old('expertise', $user->mentor->expertise) }}" required>
                            @error('expertise')
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Company</label>
                            <input type="text" class="form-control" name="company"
                                value="{{ old('company', $user->mentor->company) }}" required>
                            @error('company')
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <button id="confirm-btn" type="submit"
                            class="btn btn-primary text-white rounded-1 d-flex justify-content-center align-items-center">
                            <span id="spinner2" class="spinner-border spinner-border-sm me-3" style="display: none"
                                aria-hidden="true"></span>
                            <p class="mb-0">Confirm</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- show edit form model when there is validation errors --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->hasAny(['name', 'email', 'expertise', 'company']))
                window.showModal();
            @endif
        });
    </script>
@endpush

@push('js')
    {{-- adding dynamic loading features for two forms btns --}}
    <script type="module">
        document.addEventListener('submit', function(event) {
            event.preventDefault();

            let confirmButton = event.target.querySelector('#confirm-btn');
            let changeButton = event.target.querySelector('#change-btn');

            // Dynamically showing spinner for when having two forms with two submit btns
            if (confirmButton) {
                isLoading(event, 'confirm-btn', 'spinner2');
            }

            if (changeButton) {
                isLoading(event, 'change-btn');
            }

            event.target.submit();
        });
    </script>
@endpush

@push('js')
        {{-- creating image url for preview image --}}
    <script>
        let imgForm = document.getElementById('img-form')
        let imgUpdate = document.getElementById('upload_profile')
        let changeBtn = document.getElementById('change-btn')
        let profileLabel = document.getElementById('profile-label')
        let preview = document.getElementById('preview-img')

        imgUpdate.addEventListener('change', function(event) {
            let imageFile = URL.createObjectURL(event.target.files[0]);
            if (imageFile) {
                preview.src = imageFile;

                preview.onload = () => URL.revokeObjectURL(imageFile);
            }
            changeBtn.style.display = "block";
            profileLabel.style.display = "none";
        })
    </script>
@endpush
