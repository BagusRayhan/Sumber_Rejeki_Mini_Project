<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        @include('Client.Template.sidebar')

        <!-- Content Start -->
        <div class="content">
      @include('Client.Template.navbar')

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img src="{{ asset('ProjectManagement/dashmin/img/icon1.png') }}" style="width:29%; height:29%;">
                            <div class="ms-3">
                                <p class="mb-2">Project Disetujui</p>
                                <h6 class="mb-0">6</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img src="{{ asset('ProjectManagement/dashmin/img/icon2.png') }}" style="width:26%; height:26%;">
                            <div class="ms-3">
                                <p class="mb-2">Project Ditolak</p>
                                <h6 class="mb-0">15</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img src="{{ asset('ProjectManagement/dashmin/img/icon3.png') }}" style="width:26%; height:26%;">
                            <div class="ms-3">
                                <p class="mb-2">Project Dikerjakan</p>
                                <h6 class="mb-0">25</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img src="{{ asset('ProjectManagement/dashmin/img/icon4.png') }}" style="width:24%; height:24%;">
                            <div class="ms-3">
                                <p class="mb-2">Project Selesai</p>
                                <h6 class="mb-0">10</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->




            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4" style="width: 66%;">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Estimasi</h6>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;" >
                               <div class="w-100 ms-3 d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Aplikasi Toko Online</h6>
                                    <span><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;3 jam lagi</span>
                                </div>
                                <div class="col-sm-12 col-xl-5" style="margin-left:26%;">
                                    <div class="bg-light rounded h-100 p-10">
                                        <div class="pg-bar mb-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;" >
                               <div class="w-100 ms-3 d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Aplikasi Toko Online</h6>
                                    <span><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;3 jam lagi</span>
                                </div>
                                <div class="col-sm-12 col-xl-5" style="margin-left:26%;">
                                    <div class="bg-light rounded h-100 p-10">
                                        <div class="pg-bar mb-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;" >
                               <div class="w-100 ms-3 d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Aplikasi Toko Online</h6>
                                    <span><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;3 jam lagi</span>
                                </div>
                                <div class="col-sm-12 col-xl-5" style="margin-left:26%;">
                                    <div class="bg-light rounded h-100 p-10">
                                        <div class="pg-bar mb-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;" >
                               <div class="w-100 ms-3 d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Aplikasi Toko Online</h6>
                                    <span><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;3 jam lagi</span>
                                </div>
                                <div class="col-sm-12 col-xl-5" style="margin-left:26%;">
                                    <div class="bg-light rounded h-100 p-10">
                                        <div class="pg-bar mb-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Pesan</h6>
                                <a href="#">Tampilkan Semua</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px; ">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->


      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>