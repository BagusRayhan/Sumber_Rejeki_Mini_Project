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
            
            <!-- Bank Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">BANK</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Bank</th>
                                            <th scope="col">Nomor Rekening</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BANK BRI</td>
                                            <td>8765785xxx</td>
                                            <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRekeningModal"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>BANK BCA</td>
                                            <td>8657673xxx</td>
                                            <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRekeningModal"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>BANK Mandiri</td>
                                            <td>8652342xxx</td>
                                            <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRekeningModal"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">E-Wallet</h6>
                            <div class="d-flex justify-content-evenly">
                                <div class="col-3">
                                    <div class="card">
                                        <img src="{{ asset('ProjectManagement/dashmin/img/qr-example.png') }}" class="card-img-top p-2">
                                        <div class="card-body justify-content-between align-items-center">
                                            <h5 class="card-title">DANA</h5>
                                            <a href="#" class="btn btn-primary rounded-circle float-end" data-bs-toggle="modal" data-bs-target="#editQRModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <img src="{{ asset('ProjectManagement/dashmin/img/qr-example.png') }}" class="card-img-top p-2">
                                        <div class="card-body justify-content-between align-items-center">
                                            <h5 class="card-title">OVO</h5>
                                            <a href="#" class="btn btn-primary rounded-circle float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <img src="{{ asset('ProjectManagement/dashmin/img/qr-example.png') }}" class="card-img-top p-2">
                                        <div class="card-body justify-content-between align-items-center">
                                            <h5 class="card-title">GoPay</h5>
                                            <a href="#" class="btn btn-primary rounded-circle float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bank Table End -->

            <!-- Modal Box Edit Bank Start -->
            <div class="modal fade" id="editRekeningModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">UBAH NO REKENING</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="no-rekening" value="3235435">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Box Edit Bank End-->

                <!-- Modal Box Edit QR Start -->
                <div class="modal fade" id="editQRModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">DANA</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-0 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('ProjectManagement/dashmin/img/qr-example.png') }}" class="w-75">
                                <input type="file" class="form-control" name="" id="">
                            </div>
                            <div class="modal-footer d-flex justify-content-evenly">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Box Edit QR End -->
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