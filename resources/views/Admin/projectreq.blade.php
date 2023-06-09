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

                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-3">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card" style="background-color: #F3F6F9;border: none">
                        <div class="card-body">
                          <h5 class="card-title mb-5" style="color: #191C24;opacity: 0.8">Special title treatment</h5>
                          <a href="#" class="btn btn-primary" style="margin-left: 265px;background-color: #009CFF;opacity: 70%"><i class="bi bi-eye-fill"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-sm-5" style="margin-left: 910px">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
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