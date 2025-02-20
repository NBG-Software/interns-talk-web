@extends('layouts.app')

@section('content')
    <div class="px-2">
        <!-- First Row: Title -->
        <div class="row">
            <div class="col">
                <p class="h4">Intern List</p>
            </div>
        </div>


        <!-- Second Row: Search Box & Entries Dropdown -->
        <div class="row mb-3 d-flex justify-content-between align-items-center">
            <!-- Search Box -->
            <div class="col-md-3">
                <form action="{{ route('intern.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control shadow-none" placeholder="Search" name="search">
                        <button class="input-group-text" type="submit">
                            <img src="{{ asset('assets/search-normal.png') }}" width="24" alt="">
                        </button>
                    </div>
                </form>
            </div>

            <!-- Entries Dropdown -->
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <select class="form-select w-auto">
                    @for ($i = 10; $i <= 100; $i += 10)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <p class="ms-2 mb-0">entries per page</p>
            </div>
        </div>
        @if (request('search'))
            <div class="mb-2">
                <small>Search By : {{ request('search') }}</small>
                <a href="{{ route('intern.list') }}" class="btn btn-sm btn-primary ms-2"> Clear</a>
            </div>
        @endif

        <!-- Third Row: Table -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead class="">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chats as $chat)
                                <tr>
                                    <td>{{ $chat->user->full_name }}</td>
                                    <td class="text-wrap">{{ $chat->user->email }}</td>
                                    <td>
                                        <a id="link-{{ $chat->id }}" data-chat-id="{{ $chat->id }}"
                                            href="{{ route('intern.talk', $chat->id) }}"
                                            class="text-primary fw-semibold text-decoration-none position-relative">
                                            Talk
                                            <small style="width: 8px; height:8px;" id="event-badge-{{ $chat->id }}"
                                                class="rounded-circle bg-danger position-absolute d-none"></small>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No results found.</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module">
        let chats = @json($chats);

        chats.forEach(chat => {
            window.Echo.private(`chat-channel-${chat.id}`)
                .listen('.MessageSent', (event) => {
                    console.log(event.message);
                    localStorage.setItem(`chat_${event.message.chat_id}`, event.message.chat_id);

                    let badge = document.getElementById(`event-badge-${event.message.chat_id}`);
                    badge.classList.remove('d-none');
                });


        });


        // chats.forEach(chat=>{
        //     if( localStorage.getItem(`chat_${chat.id}`)){
        //         document.getElementById(`event-badge-${localStorage.getItem(`chat_${chat.id}`)}`).classList.remove('d-none')
        //     }
        // })

        chats.forEach(chat => {
            let storedChatId = localStorage.getItem(`chat_${chat.id}`);
            if (storedChatId) {
                let badge = document.getElementById(`event-badge-${storedChatId}`);
                if (badge) {
                    badge.classList.remove('d-none');
                } else {
                    console.warn(`Badge not found for chat ID: ${storedChatId}`);
                }
            }

            let link = document.getElementById(`link-${chat.id}`);
            link.addEventListener('click', function(e) {
                e.preventDefault();
                let chatId = this.dataset.chatId; // Assuming you store chat ID in a data attribute
                console.log("Clicked Chat ID:", chatId);

                // Perform your function (e.g., remove chat ID from localStorage)
                localStorage.removeItem(`chat_${chatId}`);

                // Optionally hide the badge
                let badge = document.getElementById(`event-badge-${chatId}`);
                if (badge) {
                    badge.classList.add('d-none');
                }

                setTimeout(() => {
                    window.location.href = this.href;
                }, 50);
                // Now navigate to the original href
                // window.location.href = this.href;
            })

        });


        function removeBadge(id) {
            if (localStorage.getItem(`chat_${id}`)) {
                localStorage.removeItem(`chat_${id}`)
                document.getElementById(`event-badge-${id}`).classList.add('d-none')
            }
        }
    </script>
@endpush
