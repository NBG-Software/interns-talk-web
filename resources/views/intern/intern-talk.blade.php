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

        {{-- empty message container --}}
        {{-- <div style="display: block" class="empty-message-container row mt-3 h-100">
            <div style="background-color: #F6F6F6;" class="p-4 d-flex flex-column">
                <p class="fw-bold">{{ $chat->user->full_name }}</p>
                <div class="empty-message-box d-flex flex-column justify-content-center align-items-center flex-grow-1">
                    <img src="{{ asset('assets/dashboard/chat_cat.png') }}" width="80" alt="">
                    <p class="mt-2 fw-semibold text-black-50">There is no message yet</p>
                </div> --}}

                {{-- Message input box --}}
                {{-- <div class="">
                    <form id="send-message">
                        @csrf

                        <div class="form-group">
                            <textarea name="message_text" class="form-control p-3" id="" rows="3"
                                placeholder="Write a message for this intern" required></textarea>
                        </div>
                        <div class="message-image mt-2">
                            <img id="preview-img" src="" class="mb-2" width="80">
                        </div>
                        <div class="mt-3 d-flex">
                            <form class="d-inline-block" method="post" id="messsage-media-upload"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="">

                                    <label type="button" style="cursor: pointer;" id="message-photo"
                                        class="btn btn-primary" for="message-media">
                                        <img src="{{ asset('assets/dashboard/document-upload.png') }}" class="me-2"
                                            width="18" alt="">
                                        Upload
                                    </label>
                                    <input style="display: none" type="file" accept="image/png, image/jpeg, image/jpg"
                                        name="message_media" class="" id="message-media">

                                    @error('profile_picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <button style="display: none !important;" id="send-btn" type="submit"
                                    class="btn btn-primary text-white rounded-1 d-flex justify-content-center align-items-center">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-3" style="display: none"
                                        aria-hidden="true"></span>
                                    <p class="mb-0">Upload</p>
                                </button>
                            </form>
                            <button type="submit" class="btn btn-primary ms-2">Send Message</button>
                        </div>
                    </form>
                    <form action="" id="send-box">
                        <div class="form-group">
                            <textarea name="message" class="form-control p-3" id=""rows="3" placeholder="Write a message for this intern"></textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        {{-- messsages container --}}
        <div style="display : block;" class="message-container row mt-3 h-auto">
            <div style="background-color: #F6F6F6;" class="py-4 px-3 px-md-5 position-relative">
                <p class="fw-bold ">{{ $chat->user->full_name }}</p>

                {{-- empty message box --}}
                <div class="empty-message-box d-flex flex-column justify-content-center align-items-center flex-grow-1">
                    <img  src="{{ asset('assets/dashboard/chat_cat.png') }}" width="80" alt="">
                    <p class="mt-2 fw-semibold text-black-50">There is no message yet</p>
                </div>

                {{-- message box --}}
                <div class="message-box d-flex flex-column">

                </div>

                @error('message_text')
                    <div>{{ $message }}</div>
                @enderror

                {{-- write message input  --}}
                <div style="background-color: #F6F6F6;" class=" mt-2 z-3 sticky-bottom pb-3">
                    {{-- sending text message --}}
                    <div class="">
                        <small id="error-message" class="text-danger"></small>
                    </div>
                    <form id="send-message">
                        @csrf
                    </form>
                        <div class="form-group">
                            <textarea name="message_text" class="form-control p-3" form="send-message" id="" rows="3"
                                placeholder="Write a message for this intern"></textarea>
                        </div>
                        <div class="message-image mt-2">
                            <img id="preview-img" src="" class="mb-2" width="80">
                        </div>
                        <div class="mt-3 d-flex">
                            {{-- sending media message --}}
                            <form class="d-inline-block" id="uploadMedia">
                                @csrf

                                <div class="">

                                    <label style="cursor: pointer;" id="message-photo"
                                        class="btn btn-primary" for="message-media">
                                        <img src="{{ asset('assets/dashboard/document-upload.png') }}" class="me-2"
                                            width="18" alt="">
                                        Upload
                                    </label>
                                    <input style="display: none" type="file" accept="image/png, image/jpeg, image/jpg"
                                        name="message_media" class="" id="message-media">

                                    @error('profile_picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <button style="display: none !important;" id="send-btn" type="submit"
                                    class="btn btn-primary text-white rounded-1 d-flex justify-content-center align-items-center">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-3" style="display: none"
                                        aria-hidden="true"></span>
                                    <p class="mb-0">Upload</p>
                                </button>
                            </form>
                            <button type="submit" form="send-message" class="btn btn-primary ms-2">Send Message</button>
                        </div>

                </div>
            </div>
        </div>



    </div>
@endsection

@push('js')
    <script type="module">
        document.addEventListener('DOMContentLoaded', async function() {
            let emptyMessageBox = document.querySelector('.empty-message-box');
            // for uploading media message
            let mediaMessageUpload = document.getElementById('uploadMedia');

            // for pushing messages
            let messageBox = document.querySelector('.message-box');
            // currenct chat room
            let chat_user_name = "{{ $chat->user->full_name }}";
            // media message validation error
            let errorMessage = document.getElementById('error-message');

            let messages = [];
            let chat;

            // for preview image
            let messageMedia = document.getElementById('message-media')
            let sendBtn = document.getElementById('send-btn')
            let messageLabel = document.getElementById('message-photo')
            let preview = document.getElementById('preview-img')

            // media message photo pre-upload
            messageMedia.addEventListener('change', function(event) {
            let imageFile = URL.createObjectURL(event.target.files[0]);
            if (imageFile) {
                preview.src = imageFile;

                preview.onload = () => URL.revokeObjectURL(imageFile);
            }
            sendBtn.style.display = "block";
            messageLabel.style.display = "none";
            })


            // pre-fetching all messages on DOM Loading
            try {
                let result = await fetch("{{ route('message.all', $chat->id) }}");
                let data = await result.json();
                console.log("Messages fetched successfully:", data);

                messages.push(...data.messages);
                chat = data.chat;
                console.log(messages)

            } catch (error) {
                console.error("Error fetching messages:", error);
            }

            // console.log(chat);

            // append fetched messages to DOM MessageBox
            messages.forEach((message) => appendMessageToDOM(message));

            function appendMessageToDOM(message) {
                let messageHTML = "";

                if (message.sender_id == chat.mentor_id) {
                    if(message.message_text){
                        messageHTML = `
                        <div class="mentor-message mt-3 align-self-end">
                            <div style="width: fit-content">
                                <span style="border-radius: 8px 0 8px 8px;"
                                    class="bg-secondary text-white fw-bold py-2 px-3 d-block">${message.message_text}</span>
                                <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:00 pm</small>
                            </div>
                        </div>
                    `;
                    }else if(message.message_media){
                        messageHTML = `
                            <div class="mentor-message mt-3 align-self-end">
                                <div style="width: fit-content">
                                    <img src="/storage/message_media/${message.message_media}" alt="Media Message" class="img-fluid" style="max-width: 200px; border-radius: 8px 0 8px 8px;">
                                    <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:00 pm</small>
                                </div>
                            </div>
                        `;
                    }

                } else if (message.sender_id == chat.user_id) {
                    if(message.message_text){
                        messageHTML = `
                            <div class="intern-message">
                                <small class="mb-2 fw-semibold">${chat_user_name}</small>
                                <div style="width: fit-content">
                                    <span style="border-radius: 0 8px 8px 8px;" class="bg-white fw-bold py-2 px-3 d-block">${message.message_text}</span>
                                    <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:00 pm</small>
                                </div>
                            </div>
                        `;
                    }else if(message.message_media){
                        messageHTML = `
                            <div class="intern-message">
                                <small class="mb-2 fw-semibold">${chat_user_name}</small>
                                <div style="width: fit-content">
                                    <img src="/storage/message_media/${message.message_media}" alt="Media Message" class="img-fluid" style="max-width: 200px; border-radius: 0 8px 8px 8px;">
                                    <small class="d-block text-end fw-bold fst-italic text-black-50 mt-1">9:00 pm</small>
                                </div>
                            </div>
                        `;
                    }

                }

                messageBox.insertAdjacentHTML("beforeend", messageHTML);

                messageBox.scrollTop = messageBox.scrollHeight;

            }


            // toggle message box and empty message box
            if(messages.length === 0){
                messageBox.style.display = "none";
                emptyMessageBox.style.display = "block";
            }else{
                messageBox.style.display = "block";
                emptyMessageBox.style.display = "none";
                emptyMessageBox.classList.remove('d-flex');
            }

            // send text message
            document.getElementById("send-message").addEventListener("submit", async function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                let chatId = "{{ $chat->id }}";

                try {
                    let response = await fetch("{{ route('message.store', $chat->id) }}", {
                        method: "POST",
                        body: formData,
                    });

                    let data = await response.json();


                    if (data.errors) {
                        let errors = data.errors;
                        errorMessage.innerHTML = errors.message_text
                    }

                    emptyMessageBox.style.display = "none";
                    emptyMessageBox.classList.remove('d-flex');

                    console.log("Message sent successfully:", data);
                    form.reset();

                } catch (error) {
                    console.error("Error sending message:", error);
                }


            });

            // sending media message
            mediaMessageUpload.addEventListener("submit", async function(e) {
                e.preventDefault();
                let form = this;
                let formData = new FormData(form);
                let chatId = "{{ $chat->id }}";

                try {
                    let response = await fetch("{{ route('media.store', $chat->id) }}", {
                        method: "POST",
                        body: formData,
                    });

                    let data = await response.json();


                    if (data.errors) {
                        let errors = data.errors;
                        errorMessage.innerHTML = errors.message_media;
                    }

                    emptyMessageBox.style.display = "none";
                    emptyMessageBox.classList.remove('d-flex');

                    console.log("Message sent successfully:", data);
                    form.reset();
                    preview.src = "";
                    sendBtn.style.display = "none";
                    sendBtn.classList.remove('d-flex');
                    messageLabel.style.display = "block";

                } catch (error) {
                    console.error("Error sending message:", error);
                }


            });


            // Listing real time messages from both mentor and user
            window.Echo.private('chat-channel-{{ $chat->id }}')
                .listen('MessageSent', (event) => {
                    console.log(event.message);
                    messages.push(event.message);
                    appendMessageToDOM(event.message);
                });

        })


    </script>
@endpush


