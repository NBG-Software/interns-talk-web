@extends('layouts.app')
@section('content')
    <div class="px-3 h-100">
        {{-- breadcrumb routes --}}
        <div class="row">
            <div class="card bg-white">
                <div class="card-body">
                    <a href="{{ route('intern.list') }}" class="text-decoration-none">
                        <img src="{{ asset('assets/dashboard/home-2.png') }}" width="20" alt="">
                        Intern
                    </a>
                    <a href="" class="text-decoration-none">
                        <img src="{{ asset('assets/dashboard/arrow-right.png') }}" width="20" alt="">
                        Talk
                    </a>
                </div>
            </div>
        </div>

        {{-- chatroom --}}
        @if (false)
            {{-- empty message container --}}
            <div class="row mt-3 h-100">
                <div style="background-color: #F6F6F6;" class="p-4 d-flex flex-column">
                    <p class="fw-bold">{{ $intern->full_name }}</p>
                    <div class="message-box d-flex flex-column justify-content-center align-items-center flex-grow-1">
                        <img src="{{ asset('assets/dashboard/chat_cat.png') }}" width="80" alt="">
                        <p class="mt-2 fw-semibold text-black-50">There is no message yet</p>
                    </div>

                    {{-- Message input box --}}
                    <div class="">
                        <form action="">
                            <div class="form-group">
                                <textarea name="message" class="form-control p-3" id=""rows="3" placeholder="Write a message for this intern"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            {{--messsages container --}}
            <div class="row mt-3 h-auto">
                <div style="background-color: #F6F6F6;" class="py-4 px-3 px-md-5 position-relative">
                    <p class="fw-bold ">{{ $intern->full_name }}</p>

                    {{-- message box --}}
                    <div class=" d-flex flex-column">
                        <div class="mentor-message">
                            <small class="mb-2 fw-semibold">{{ $intern->full_name }}</small>
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 0 8px 8px 8px;" class="bg-white fw-bold py-2 px-3 d-block">Hello
                                    Sir</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>


                        <div class="intern-message mt-3 align-self-end">
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 8px 0 8px 8px;"
                                    class="bg-secondary text-white fw-bold py-2 px-3 d-block">Hello what is the
                                    matter?</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>

                        <div class="mentor-message">
                            <small class="mb-2 fw-semibold">{{ $intern->full_name }}</small>
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 0 8px 8px 8px;" class="bg-white fw-bold py-2 px-3 d-block">I
                                    got some error on bootstrap blah blah blah blah blah blah blah</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>


                        <div class="intern-message mt-3 align-self-end">
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 8px 0 8px 8px;"
                                    class="bg-secondary text-white fw-bold py-2 px-3 d-block">Can you show me your
                                    codes?</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>
                        <div class="mentor-message">
                            <small class="mb-2 fw-semibold">{{ $intern->full_name }}</small>
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 0 8px 8px 8px;background-color : white;"
                                    class="fw-bold py-2 px-3 d-block">I got some error on bootstrap blah blah blah blah
                                    blah blah blah</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>


                        <div class="intern-message mt-3 align-self-end">
                            <div style="width: fit-content" class="">
                                <span style="border-radius: 8px 0 8px 8px;"
                                    class="bg-secondary text-white fw-bold py-2 px-3 d-block">Can you show me your
                                    codes?</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:25 am</small>
                            </div>
                        </div>

                    </div>


                    {{-- write message input  --}}
                    <div style="background-color: #F6F6F6;" class=" mt-2 z-3 sticky-bottom pb-3">
                        <form action="">
                            <div class="form-group">
                                <textarea name="message" class="form-control p-3" id=""rows="3" placeholder="Write a message for this intern"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection
