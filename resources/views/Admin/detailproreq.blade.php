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

        <!-- style css -->
        <script>
            .modal-line {
            border: none;
            border-top: 1px solid #ccc;
            margin-top: 0;
            margin-bottom: 0;
        }
        </script>
            
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <form>
                    <div class="row mb-3 mt-sm-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="input1">Nama Client</label>
                                <input type="text" value="Suharto" class="form-control" id="input1" name="input1" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="input2">Nama Project</label>
                                <input type="text" value="Website Berita" class="form-control" id="input2" name="input2" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="input1">Dokumen Pendukung</label>
                                <input type="text" value="website-berita.pdf" class="form-control" id="input1" name="input1" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="input2">Deadline</label>
                                <input type="datetime-local" class="form-control" id="input2" name="input2" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table table-striped table-hover mb-sm-3">
                        <thead>
                          <tr>
                            <center>
                            <th scope="col">Nama Fitur</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                            </center>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Halaman Login</td>
                            <td>150.000</td>
                            <td><a href="#" id="buktiTransaksiModal" class="btn btn-primary" style="background-color: #009CFF;opacity: 70%;height: 30px;border: none" data-bs-toggle="modal" data-bs-target="#myModal"><svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 15px" width="17" height="17" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                              </svg></i></a></td>
                          </tr>
                          <tr>
                            <td>Halaman Register</td>
                            <td>-</td>
                            <td><a href="#" class="btn btn-primary" style="background-color: #009CFF;opacity: 70%;height: 30px;border: none" data-bs-toggle="modal" data-bs-target="#myModal"><svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 15px" width="17" height="17" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                              </svg></i></a></td>
                          </tr>
                          <tr>
                            <td>Landing Page</td>
                            <td>-</td>
                            <td><a href="#" class="btn btn-primary" style="background-color: #009CFF;opacity: 70%;height: 30px;border: none" data-bs-toggle="modal" data-bs-target="#myModal"><svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 15px" width="17" height="17" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                              </svg></i></a></td>
                          </tr>
                        </tbody>
                      </table>                   
                    <a href="projectreq" type="button" style="background-color: #009CFF;border: none;opacity: 70%;" class="btn btn-primary">Setuju</a>
                    <a href="projectreq" type="button" class="btn btn-danger">Tolak</a>
                  </form>
            </div>
            </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sales Chart Start -->
            <div class="modal" id="myModal" style="height: 540px">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Isi modal di sini -->
                        <div class="modal-body">
                            <h4>Detail Fitur</h4>
                        </div>
                        <hr>
                        <div class="modal-header">
                            <div class="row mb-3 mt-sm-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input1">Nama Fitur</label>
                                        <input type="text" value="Halaman Login" class="form-control mt-1" id="input1" name="input1" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input2">Harga Fitur</label>
                                        <input type="number" class="form-control mt-1" id="input2" name="input2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input1">Deskripsi Fitur</label>
                                    <textarea class="form-control mt-1" id="textarea1" style="height: 200px" name="textarea1" disabled>Halaman login terdiri dari kolom input yang meminta pengguna untuk memasukkan informasi seperti nama pengguna atau alamat email, diikuti oleh kolom kata sandi. Pengguna kemudian dapat mengklik tombol "masuk" untuk mengirimkan informasi tersebut untuk verifikasi. Halaman login juga sering dilengkapi dengan fitur seperti "ingat saya" untuk menyimpan informasi login pengguna secara otomatis, dan tautan "lupa kata sandi" untuk membantu pengguna yang lupa kata sandi mereka.</textarea>
                                </div>
                                <div class="modal-footer">
                                    <a href="detailproreq" class="btn btn-primary mt-3" style="background-color: #009CFF;opacity: 70%;border: none;margin-left: 385px">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    </script>
    
</body>

@include('Admin.templates.script')