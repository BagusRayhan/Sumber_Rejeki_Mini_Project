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
        <div class="nav w-25 mt-4 d-flex">
            <a href="/selesaiclient" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('selesaiclient') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                Selesai
            </a>
            <a href="/revisiclient" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('revisiclient') ? 'fw-bold border-2  border-bottom border-dark' : '' }}">
                Revisi
            </a>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Status</th>
                                <th scope="col">Harga Project</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aplikasi toko online</td>
                                <td><span class="badge text-bg-success">Selesai</span></td>
                                <td>5.000.000</td>
                                <td><center>
                                    <a href="{{ route('detail-revisi-client') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></center>
                                </td>
                            </tr>
                            <tr>
                                <td>Website Pertanian</td>
                                <td><span class="badge text-bg-success">Selesai</span></td>
                                <td>5.000.000</td>
                                <td><center>
                                    <a href="{{ route('detail-revisi-client') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></center>
                                </td>
                            </tr>
                            <tr>
                                <td>Aplikasi Timer Waktu Solat</td>
                                <td><span class="badge text-bg-success">Selesai</span></td>
                                <td>5.000.000</td>
                                <td><center>
                                    <a href="{{ route('detail-revisi-client') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></center>
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

      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
