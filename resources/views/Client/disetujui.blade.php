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

      <div class="container-fluid pt-4 px-4">

            <div class="search-form w-25">
                <form action="">
                    <div class="input-group rounded-pill" style="background: #E9EEF5">
                        <input type="text" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                        <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Estimasi</th>
                                <th scope="col">Progress Project</th>
                                <th scope="col">Harga Project</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aplikasi toko online</td>
                                <td>1 hari</td>
                                <td>
                                    <div class="col-sm-12 col-xl-5" style="margin-left:2%;">
                                        <div class="bg-light rounded h-100 p-10">
                                            <div class="pg-bar mb-3">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>15.000.000</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('detailsetujui') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Website Berita</td>
                                <td>3 jam</td>
                                <td>
                                    <div class="col-sm-12 col-xl-5" style="margin-left:2%;">
                                        <div class="bg-light rounded h-100 p-10">
                                            <div class="pg-bar mb-3">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>15.000.000</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('detailsetujui') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Website Sekolah</td>
                                <td>4 hari</td>
                                <td>
                                    <div class="col-sm-12 col-xl-5" style="margin-left:2%;">
                                        <div class="bg-light rounded h-100 p-10">
                                    <div class="pg-bar mb-3">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>15.000.000</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('detailsetujui') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mt-sm-3">
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
<!-- Content End -->


@include('Client.Template.script')
@include('Client.Template.footer')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
