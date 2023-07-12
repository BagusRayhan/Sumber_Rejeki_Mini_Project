<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
@endphp

<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
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

            <!-- Counter Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-regular fa-user fa-2x text-primary"></i>
                            <div class="ms-1">
                                <p class="mb-2">Jumlah Client</p>
                                <h6 class="mb-0">{{ $clientCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon2.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Ditolak</p>
                                <h6 class="mb-0">{{ $tolakCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon3.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Dikerjakan</p>
                                <h6 class="mb-0">{{ $progressCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon4.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Selesai</p>
                                <h6 class="mb-0">{{ $selesaiCounter }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Counter End -->


            <!-- Monthly Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="w-100">
                    <div class="bg-light text-center rounded p-4" style="height: 550px">
                        <div class="d-flex align-items-center justify-content-start mb-4">
                            <div class="" style="width: 1100px">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Monthly Chart End -->

            <!-- Annualy Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="w-100">
                    <div class="bg-light text-center rounded p-4" style="height: 550px">
                        <div class="d-flex align-items-center justify-content-start mb-4">
                            <div class="" style="width: 1100px">
                                {!! $ychart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Annualy Chart End -->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 mb-5">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <h6 class="mb-0">Project Masuk</h6>
                            </div>
                            @if (count($incomeProject) !== 0)
                                @foreach ($incomeProject as $inc)
                                    <div class="border-bottom py-3">
                                        <a href="{{ route('detailproreq', ['id' => $inc->id]) }}" class="text-decoration-none d-flex text-dark">
                                            <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $inc->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                            {{-- <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;"> --}}
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-0">{{ $inc->user->name }}</h6>
                                                    {{-- <small>{{ $inc->harga }}</small> --}}
                                                </div>
                                                <span>{{ $inc->napro }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada project masuk</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <h6 class="mb-0">Pembayaran Masuk</h6>
                            </div>
                            @if (count($incomePayment) !== 0)
                                @foreach ($incomePayment as $inc)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <a href="{{ route('pending-bayar-admin', ['id' => $inc->id]) }}" style="text-decoration: none; color: inherit;">
                                        <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $inc->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">{{ $inc->user->name }}</h6>
                                                <small>{{ $inc->harga }}</small>
                                            </div>
                                            <span>{{ $inc->napro }}</span>
                                        </div>
                                    </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada pembayaran masuk</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <h6 class="mb-0">Pesan</h6>
                            </div>
                            @if (count($message) !== 0)
                                @foreach ($message as $msg)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <a href="{{ route('detail-disetujui-admin', ['id' => $msg->id]) }}" style="text-decoration: none; color: inherit;">
                                        <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $msg->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">{{ $msg->user->name }}</h6>
                                                <small>{{ Carbon::parse($msg->chat_time)->locale('id')->isoFormat('HH:MM') }}</small>
                                            </div>
                                            <span>{{ $msg->chat }}</span>
                                        </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada pesan masuk</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->
        </div>
        <!-- Content End -->

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $ychart->script() }}

    @include('Admin.templates.script')
</body>
