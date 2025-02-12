@extends('layouts.app')

@section('content')
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
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-text">
                    <img src="{{asset('assets/search-normal.png')}}" width="24" alt="">
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
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                    <tr>
                        <td>Shaniec</td>
                        <td>KaungSithu@gmail.com</td>
                        <td><a href="" class="text-primary fw-semibold text-decoration-none">Talk</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col justify-content-between d-flex">
            <p>Showing 1 to 10 of 29 entries</p>
            <p>Place holder for page navigation</p>
        </div>
    </div>
@endsection
