<!DOCTYPE html>
<html lang="en">

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
            
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">

                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">

                                    </div>

                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">

                                    </div>

                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">

                                    </div>

                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">

                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">

                            </div>
                            <div class="d-flex mb-2">

                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">

                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->

            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <!-- Widgets End -->

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('ProjectManagement/code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('ProjectManagement/dashmin/js/main.js') }}"></script>
</body>

@include('Admin.templates.script')