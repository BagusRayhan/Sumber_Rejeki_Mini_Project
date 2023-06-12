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
              <div class="search-form w-25">
                <form action="">
                    <div class="input-group rounded-pill" style="background: #E9EEF5">
                        <input type="text" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                        <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>

                <div class="container-fluid">
                    <div class="row">
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                          <tr>
                            <th scope="col">Nama Project</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga Project</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Website Berita</td>
                            <td>Selesai</td>
                            <td>15.000.000</td>
                            <td><a type="button" href="revisiproselesai" class="btn btn-primary disabled" style="background-color: #009CFF;opacity: 100%;border: none" disabled><i class="fa-sharp fa-solid fa-file-pen"></i>&nbsp;Revisi</a>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>Website Sekolah</td>
                            <td>Revisi</td>
                            <td>10.000.000</td>
                            <td><a type="button" href="revisiproselesai" class="btn btn-primary" style="background-color: #009CFF;opacity: 70%;border: none"><i class="fa-sharp fa-solid fa-file-pen"></i>&nbsp;Revisi</a>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>Website Kesehatan</td>
                            <td>Revisi</td>
                            <td>9.000.000</td>
                            <td><a type="button" href="revisiproselesai" class="btn btn-primary" style="background-color: #009CFF;opacity: 70%;border: none"><i class="fa-sharp fa-solid fa-file-pen"></i>&nbsp;Revisi</a>&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
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