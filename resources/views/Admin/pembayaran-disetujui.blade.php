<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

@include('Admin.templates.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->

        <!-- Spinner End -->

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Admin.templates.navbar')

            <!-- Confirm Payment Table Start -->
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
                    <a href="/pembayaran-pending" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('pending-bayar-admin') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                        Pending
                    </a>
                    <a href="/pembayaran-disetujui" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('setuju-bayar-admin') ? 'fw-bold border-2  border-bottom border-dark' : '' }}">
                        History
                    </a>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Client</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Harga Project</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($approved) !== 0)
                                        @foreach ($approved as $apv)
                                            <tr>
                                                <td>{{ $apv->namaclient }}</td>
                                                <td>{{ $apv->namaproject }}</td>
                                                <td>{{ $apv->hargaproject }}</td>
                                                <td class="d-flex justify-content-evenly">
                                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentDetailModal{{ $apv->id }}"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Payment Detail Modal Start -->
                                            <div class="modal fade" id="paymentDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Detail Pembayaran</h1>
                                                        </div>
                                                        <div class="modal-body mt-0 d-flex justify-content-evenly">
                                                            <img src="{{ asset('ProjectManagement/dashmin/img/bukti-pembayaran.png') }}" class="w-50">
                                                            <div class="container">
                                                                <div class="mb-2">
                                                                    <label for="namaClient">Nama Client</label>
                                                                    <input type="text" id="namaClient" class="form-control" value="Ahmad" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="namaProject">Nama Project</label>
                                                                    <input type="text" id="namaProject" class="form-control" value="Website Sekolah" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="hargaProject">Harga Project</label>
                                                                    <input type="text" id="hargaProject" class="form-control" value="10.000.000" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="metodePembayaran">Metode Pembayaran</label>
                                                                    <input type="text" id="metodePembayaran" class="form-control" value="DANA" disabled>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button type="button" class="btn btn-primary fw-medium rounded-pill w-100 p-2" data-bs-dismiss="modal" aria-label="Close">KEMBALI</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Payment Detail Modal End -->
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endif
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
            <!-- Confirm Payment Table End -->
            
        <!-- Content End -->

    </div>

    @include('Admin.templates.script')
</body>

