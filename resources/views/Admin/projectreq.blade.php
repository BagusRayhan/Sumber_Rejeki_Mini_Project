<!DOCTYPE html>
<html lang="en">

{{--  <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->  --}}
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

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

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                @if(!$projectreq->isEmpty() || !empty(request('query')))
            <form method="GET" action="{{ route('projectreq') }}" class="search-form w-25">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" name="query" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                </div>
            </form>
            @endif
            </div>
                <div class="row mt-4 px-4">
                    @foreach ($projectreq as $row)
                        <div class="col-sm-4 mb-2 mb-sm-4">
                            <div class="card" style="background-color: #F3F6F9;border: none">
                                <div class="card-body">
                                    <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">{{ $row->napro }}</h5>
                                    <a href="/detailproreq/{{ $row->id }}" class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($projectreq->isEmpty())
                    <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                        <img src="gambar/empty-icon/empty-directory.png" class="w-35" style="margin-top: 90px">
                        <p>Tidak ada data</p>
                    </div>
                @else
                    </div>
                    <div style="float: right">
                    {{ $projectreq->links() }}
                </div>
                @endif

            @include('Admin.templates.script')
