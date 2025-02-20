@extends('layouts.guest')

@section('content')
<div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-xl-10">
            <div class="text-center mb-2">
                <img src="{{asset('assets/intern_talk_logo.png')}}" width="80" alt="">
            </div>
            <div class="text-center mb-5">
                <img src="{{asset('assets/intern_talk_text.png')}}" width="100" alt="">
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card bg-white py-4 px-4 border-0">
                        <p class="fs-4 fw-bold text-center mb-1">Welcome to our Intern Talks</p>
                        <small class="d-block text-center mb-2 fw-bold fst-italic">Talk & Contribute</small>
                        <div class="card-body">


                            <span>Give a hand to your fellows by sharing your experience and providing better roadmap for their profession.  </span>

                            <div class="text-center mt-3">
                                <a href="{{route('register')}}" class="btn btn-outline-primary">Register As Mentor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mt-lg-0 mt-3">
                    <div class="card bg-white py-4 px-4 border-0">
                        <p class="fs-4 fw-bold text-center mb-1">Are you a young fellow?</p>
                        <div class="card-body d-flex flex-md-row flex-column justify-content-center align-items-center">

                            <div class="">
                                <span class="">If you are motivated juniors who are thriving to seek opportunities for professional development, scan this QR to contact your mentor.</span>
                            </div>
                            <div class="ms-2 mt-md-0 mt-2">
                                {!! QrCode::size(150)
                                    ->color(94,37,114)
                                    ->generate('https://play.google.com/store/apps/details?id=com.matteljv.uno');
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
