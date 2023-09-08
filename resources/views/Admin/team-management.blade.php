<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
@endphp

@include('Admin.templates.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Admin.templates.navbar')

            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-between">
                    <div class="search-form w-25">
                        <form action="{{ route('project-disetujui-admin') }}">
                            <div class="input-group rounded-pill" style="background: #E9EEF5">
                                <input type="text" name="query" value="{{ request('query') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                                <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content End -->
    </div>
    @include('Admin.templates.script')
</body>
