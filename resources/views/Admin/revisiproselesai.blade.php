<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Admin.templates.head')
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
        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">
      @include('Admin.templates.navbar')

      <div class="container-fluid">
            <h4 class="mb-3 mt-3" style="margin-left: 2%;">Detail Project</h4>
        <div class="col-sm-12 col-xl-11 d-flex justify-content-between" style="margin-left: 2%; margin">
                <div class="mb-3" style="width: 27em">
                    <div class="form-group">
                        <label for="input1">Nama Project</label>
                        <input type="text" class="form-control" id="input1" value="Aplikasi toko online" disabled>
                    </div><br>
                    <div class="form-group">
                        <label for="input2">Deadline</label>
                        <input type="text" class="form-control" id="input2" value="05/06/2023 13.00" disabled>
                    </div><br>
                </div>
                <div class="mb-3" style="width: 27em">
                    <div class="form-group">
                        <label for="input3">Dokument Pendukung</label>
                        <input type="text" class="form-control" id="input3" value="Website toko online.pdf" disabled>
                    </div><br>
                    <div class="form-group">
                        <label for="input4">Total Harga</label>
                        <input type="text" class="form-control" id="input4" value="58.000.000" disabled>
                    </div>
                </div>
        </div>
        </div>


        {{-- table  --}}
     <div class="col-sm-12 col-xl-11 d-flex justify-content-between" style="margin-left: 2%; margin">
         <div class="w-25">
             <form action="#" method="GET">
             </form>
         </div>
     </div>
       <div class="col-sm-12 col-xl-11" style="margin-left: 2%;">
                        <div class="col-12">
                            <div class="table-responsive">
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama fitur</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Harga Fitur</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Halaman Login</td>
                                        <td>Selesai</td>
                                        <td>15.000.000</td>
                                        <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailfitur"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman Register</td>
                                        <td>Belum selesai</td>
                                        <td>11.000.000</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>Landing Page</td>
                                        <td>Belum selesai</td>
                                        <td>5.000.000</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman dashboard</td>
                                        <td>Selesai</td>
                                        <td>12.000.000</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman pembelian</td>
                                        <td>Selesai</td>
                                        <td>5.000.000</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman penjualan</td>
                                        <td>Belum selesai</td>
                                        <td>10.000.000</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-start mb-3">
                                <a href="{{ route('setujuclient') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Kembali</a>
                            </div>

                        </div>

                    </div>

                     <!-- Modal Box Edit Bank Start -->
            <div class="modal fade" id="detailfitur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">

                                <div class="col-sm-12 col-xl-11 d-flex justify-content-between" style="margin-left: 2%; margin">
                                    <div class="mb-3" style="width: 13em">
                                        <div class="form-group">
                                            <label for="input1">Nama Fitur</label>
                                            <input type="text" class="form-control" id="input1" value="Aplikasi toko online" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3" style="width: 13em">
                                        <div class="form-group">
                                            <label for="input3">Harga Fitur</label>
                                            <input type="text" class="form-control" id="input3" value="Website toko online.pdf" disabled>
                                        </div><br>
                                    </div>
                                </div>
                                <div class="mb-3    ">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Itaque, aperiam totam. Vel nemo amet modi laborum nihil aspernatur quod! Vitae, corporis, earum consequuntur dicta repudiandae facilis voluptatum placeat nisi odio necessitatibus debitis eligendi eveniet enim amet laboriosam ipsum nulla fuga in soluta velit cumque a, esse qui. Suscipit sed odit iste ullam quos! Iusto cum maiores quisquam excepturi cumque, quae nostrum fuga eveniet voluptatibus?</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>

                </div>
            </div>
        </div>
        <!-- Modal Box Edit Bank End-->


      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>


