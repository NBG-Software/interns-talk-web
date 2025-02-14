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
                <div class="input-group">
                    <input type="text" class="form-control shadow-none" placeholder="Search">
                    <span class="input-group-text">
                        <img src="{{ asset('assets/search-normal.png') }}" width="24" alt="">
                    </span>
                </div>
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

        <!-- Third Row: Table -->
        <div class="row">
            <div class="col">
                <table class="table table-striped table-borderless">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interns as $intern)
                            <tr>
                                <td>{{ $intern->full_name }}</td>
                                <td>{{ $intern->email }}</td>
                                <td><a href="{{route('intern.talk', $intern->id)}}" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <div class="">
                    {{ $interns->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
