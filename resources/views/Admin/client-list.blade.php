<!DOCTYPE html>
<html lang="en">

{{--  <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->  --}}
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

@include('Admin.templates.head')
<style>
    .list-group-item {
        background: transparent;
    }
</style>

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
        <div class="content" style="overflow: hidden">

            @include('Admin.templates.navbar')

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                @if(!$user->isEmpty() || !empty(request('query')))
            <form method="GET" action="{{ route('client-list') }}" class="search-form w-25">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" name="query" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                </div>
            </form>
            @endif
            </div>
                <div class="row mt-4 px-4">
                    @foreach ($user as $client)
                        <div class="col-sm-4 mb-2 mb-sm-4">
                            <div class="card" style="background-color: #F3F6F9;border: none">
                                <div class="card-body">
                                    <div class="header d-grid justify-content-center">
                                        <img src="{{ asset('gambar/user-profile/'. $client->profil) }}" width="100" class="rounded-circle profile-image">
                                        <h5 class="card-title mt-3 text-center" style="color: #191C24;opacity: 0.8">{{ $client->name }}</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Email</b><br> {{ $client->email }}</li>
                                        <li class="list-group-item"><b>Jumlah Project</b><br></li>
                                        <li class="list-group-item"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($user->isEmpty())
                    <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                        <img src="gambar/empty-icon/empty-directory.png" class="w-35" style="margin-top: 90px">
                        <p>Tidak ada data</p>
                    </div>
                @else
                    </div>
                    <div class="float-end mx-4">
                        {{ $user->links() }}
                    </div>
                @endif
            @include('Admin.templates.script')
