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
            <div class="container-fluid pt-3 px-4">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Nama Project</label>
                        <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Dokumen Pendukung</label>
                        <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Deadline</label>
                        <input type="datetime-local" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width:5em">Status</th>
                                        <th scope="col">Nama Fitur</th>
                                        <th scope="col">Harga Fitur</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </td>
                                        <td>Login & Register</td>
                                        <td>15.000.000</td>
                                        <td class="d-flex justify-content-evenly">
                                            <a href="/detail-project-disetujui" data-bs-toggle="modal" data-bs-target="#detailFitur" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </td>
                                        <td>Dashboard</td>
                                        <td>15.000.000</td>
                                        <td class="d-flex justify-content-evenly">
                                            <a href="/detail-project-disetujui" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </td>
                                        <td>Pembayaran</td>
                                        <td>15.000.000</td>
                                        <td class="d-flex justify-content-evenly">
                                            <a href="/detail-project-disetujui" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-3 d-flex justify-content-between" style="width: 12em">
                    <a href="/project-disetujui" class="btn btn-primary p-1"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                    <button class="btn btn-warning text-white p-1" data-bs-toggle="modal" data-bs-target="#estimasiModal"><i class="fa-solid fa-clock-rotate-left"></i> Estimasi</button>
                </div>
                <div class="container my-5">
                    <div class="panel" style="height: 80vh;">
                        <h5 class="fw-bold fs-5">Diskusi</h5>
                        <p class="text-secondary">Aplikasi Toko Online</p>
                        <div class="chatbox d-flex align-items-center justify-content-between align-items-lg-center px-3 border rounded border-1 border-dark">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-comments fs-4 me-3"></i>
                                <p class="fw-medium mt-3">Diskusikan project dengan client</p>
                            </div>
                            <button data-bs-toggle="collapse" data-bs-target="#chatbox-container" aria-expanded="false" class="btn btn-primary fw-semibold btn-sm">Hubungi Client</button>
                        </div>
                        <div class="collapse" id="chatbox-container">
                            <div class="py-3 border border-bottom-0 border-top-0 border-dark" id="chatbox" style="height: 50vh; overflow-y: scroll; background:#f3f6f9">
                                <div class="chat-box d-grid p-2">
                                    <div class="chat-line-admin">
                                        <div class="bubble-chat-admin mb-2 float-end py-1 px-3 bg-white rounded-3" style="max-width: 28em">
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, a nihil. Mollitia aliquid eaque reiciendis dolores officia doloremque deleniti architecto? Dicta cupiditate explicabo provident consequatur, quasi porro non reiciendis inventore eum neque iste iusto facilis quo nobis odio suscipit! Sit nostrum tenetur nesciunt, numquam dolor nisi perspiciatis magnam non eum vitae blanditiis corporis mollitia. Ipsum, neque! Suscipit fuga vel dolor officia corrupti ipsum neque.</p>
                                        </div>
                                    </div>
                                    <div class="chat-line-admin">
                                        <div class="bubble-chat-admin mb-2 float-end py-1 px-3 bg-white rounded-3" style="max-width: 28em">
                                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="chat-line-client">
                                        <div class="bubble-chat-client mb-2 float-start py-1 px-3 bg-white rounded-3" style="max-width: 28em">
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                                        </div>
                                    </div>
                                    <div class="chat-line-admin">
                                        <div class="bubble-chat-admin mb-2 float-end py-1 px-3 bg-white rounded-3" style="max-width: 28em">
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam inventore doloribus nobis minima provident eveniet, id aliquid fuga, reiciendis dolor eaque ut repellat necessitatibus recusandae laborum voluptatibus, illo ad rem expedita natus?</p>
                                        </div>
                                    </div>
                                    <div class="chat-line-client">
                                        <div class="bubble-chat-client mb-2 float-start py-1 px-3 bg-white rounded-3" style="max-width: 28em">
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group p-1 d-flex px-2 border border-top-0 border-dark rounded-bottom" style="bottom: 0; background: #f3f6f9;">
                                <textarea class="form-control" style="height: 5vh; max-height: 150px" placeholder="Ketik pesan ..."></textarea>
                                <button class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Box Detail Fitur Start -->
        <div class="modal fade" id="detailFitur" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-2 d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="" class="form-label">Nama Fitur</label>
                                    <input type="text" class="form-control" value="Kaja" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Harga Fitur</label>
                                    <input type="text" class="form-control" value="100.000" disabled>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" disabled>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore, consequatur eos! Tempore consectetur, nam expedita dicta iusto vitae natus itaque necessitatibus rem quos dolore saepe repellendus dolor qui voluptatum sapiente totam veritatis voluptatibus! Modi perferendis quaerat, assumenda laborum necessitatibus eos ex vero nulla facere accusantium possimus ullam ea culpa quae itaque dolores quasi quas labore voluptas numquam quo adipisci at. Sint corporis et deserunt!</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Box Detail Fitur End -->

        <!-- Modal Box Estimasi Start -->
        <div class="modal fade" id="estimasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Atur Estimasi</h1>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <input type="date" class="form-control" value="3235435">
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
    <!-- Modal Box Estimasi End-->

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