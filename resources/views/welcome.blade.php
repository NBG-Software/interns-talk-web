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
                    <p class="fs-4 fw-bold text-center mb-1">Welcome to our Intern Talks</p>
                    <small class="d-block text-center mb-2 fw-bold fst-italic">Talk & Contribute</small>
                    <span>Give a hand to your fellows by sharing your experience and providing better roadmap for their profession.  </span>

                    <div class="text-center mt-3">
                        <a href="{{route('register')}}" class="btn btn-outline-primary">Register As Mentor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
