@extends('layouts.guest')

@section('content')
<div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12 col-lg-5 col-md-8 col-lg-5 px-lg-0 px-3">
            <div class="text-center mb-2">
                <img src="{{asset('assets/intern_talk_logo.png')}}" width="80" alt="">
            </div>
            <div class="text-center mb-5">
                <img src="{{asset('assets/intern_talk_text.png')}}" width="100" alt="">
            </div>
            <div class="card pt-3">
                <div class="card-body">
                    <h5 class="text-center fw-bold mb-3">Password Reset Success</h5>
                    <p class="text-center">Now proceed to login page to authenticate you account</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
