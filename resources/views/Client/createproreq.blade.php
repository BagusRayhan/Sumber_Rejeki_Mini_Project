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
    
            <div class="container mt-4 d-flex flex-column">
                <div class="wrapper">
                    <form action="{{ route('simpanpro') }}" method="POST"  enctype="multipart/form-data">
                    <h5 class="px-3 mb-2">Request Project</h5>
                        @csrf
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="wrapper w-50 px-3 d-flex flex-column">
                                <div class="form-group mb-3">
                                    <label for="input1">Nama Client</label>
                                    <input type="text" class="form-control" id="input1" name="nama" placeholder="Masukkan Nama Anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input2">Nama Project</label>
                                    <input type="text" class="form-control" id="input2" name="napro" placeholder="Masukkan nama project anda">
                                </div>
                            </div>
                            <div class="wrapper w-50 px-3 d-flex flex-column">
                                <div class="form-group mb-3">
                                    <label for="input3">Dokumen Pendukung</label>
                                    <input type="file" class="form-control" id="input3" name="bukti">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input4">Deadline</label>
                                    <input type="datetime-local" class="form-control" id="input4" name="deadline" placeholder="Input 4">
                                </div>
                            </div>
                        </div>
                        <div class="wrapper m-3 d-flex">
                            <a href="" class="btn btn-danger btn-sm mx-2">Kembali</a>
                            <a href="" class="btn btn-primary btn-sm mx-2">Simpan</a>
                        </div>
                    </form>
                </div>
                <div class="wrapper mt-3">
                    <form action="#">
                        <div class="wrapper d-flex justify-content-between align-items-center mx-3">
                            <h6>Fitur</h6>
                            <form action="#">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFiturModal">Tambah Fitur</button>
                            </form>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-25" scope="col">Nama Fitur</th>
                                        <th class="w-75" scope="col">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($fitur) !== 0)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                @include('Client.Template.footer')
            </div>

            <!-- Add Fitur -->
            <div class="modal fade" id="addFiturModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Fitur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('simpanfitur') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Nama Fitur</label>
                                    <input type="text" value="" class="form-control" id="nomorRekening">
                                </div>
                                <div class="mb-3">
                                    <label for="">Deskripsi</label>
                                    <input type="text" value="" class="form-control" id="nomorRekening">
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
    </div>



@include('Client.Template.script')

    </body>


    <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
    </html>