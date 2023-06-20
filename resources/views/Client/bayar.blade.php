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
        <div class="d-flex justify-content-between">
        <div class="nav w-25 mt-4 d-flex">
            <a href="/bayarclient" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('bayarclient') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                Pending
            </a>
            <a href="/bayar2client" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('bayar2client') ? 'fw-bold border-2  border-bottom border-dark' : '' }}">
                Pembayaran
            </a>
        </div>
    </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Harga Project</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aplikasi toko online</td>
                                <td>15.000.000</td>
                                <td><center><span class="badge text-bg-danger">Menunggu Pembayaran</span></td></center>
                                <td><center><button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar"  class="btn btn-primary btn-sm"><i class="fa-solid fa-wallet"></i>&nbsp;Bayar</button></center></td>
                            </tr>
                            <tr>
                                <td>Website Sekolah</td>
                                <td>10.000.000</td>
                                <td><center><span class="badge text-bg-danger">Menunggu Pembayaran</span></td></center>
                                <td><center><button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar"  class="btn btn-primary btn-sm"><i class="fa-solid fa-wallet"></i>&nbsp;Bayar</button></center></td>
                            </tr>
                            <tr>
                                <td>Website Berita</td>
                                <td>5.000.000  </td>
                                <td><center><span class="badge text-bg-danger">Menunggu Pembayaran</span></center></td>
                                <td><center><button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar"  class="btn btn-primary btn-sm"><i class="fa-solid fa-wallet"></i>&nbsp;Bayar</button></center></td>
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

                        <div class="modal fade" id="Modalbayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                         <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                            <div class="modal-header" style="border: none;">
                                <img id="profile-image" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}" alt="" style="width:15%; height:15%; margin-top:1%;">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="border: none;">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="font-weight: bold;">Pembayaran Awal</h1><br>
                                        <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
                                            <h6 style="align-self: center;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="Website Berita" disabled>
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <h6>Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="2.000.000" disabled>
                                        </div>
                                <br>
                            </div>
                            <center><button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Pilih Metode Pembayaran</button></center>
                            <div class="modal-footer" style="border: none;">
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                                <div class="modal-header" >
                                    <div style="display: flex; flex-direction: column;">
                                        <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                                          <div style="display: flex; align-items: center;">
                                             <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                                          </div>
                                     <div style="display: flex; align-items: center; margin-top:3%;">
                                            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                                        </div>
                                      </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="border: none;">
                                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                                            <h6 style="align-self: center;">Metode</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilih Pembayaran
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#cash" data-bs-toggle="modal">Cash</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#wallet" data-bs-toggle="modal">E-Wallet</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                     <br>
                                   </div>
                                 <center><button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;" disabled>Bayar Sekarang</button></center>
                               <div class="modal-footer" style="border: none;">
                              </div>
                             </div>
                           </div>
                         </div>

                    <div class="modal fade" id="cash" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                                <div class="modal-header" >
                                    <div style="display: flex; flex-direction: column;">
                                        <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                                        <div style="display: flex; align-items: center;">
                                            <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                                        </div>
                                        <div style="display: flex; align-items: center; margin-top:3%;">
                                            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="border: none;">
                                    <div class="container m-0 p-0 d-flex justify-content-between">
                                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                                            <h6 style="align-self: center;">Metode</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Cash &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item active" href="#">Cash</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#wallet" data-bs-toggle="modal">E-Wallet</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mb-7">
                                            <h6 style="">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" value="2.000.000" disabled>
                                        </div>
                                    </div>
                                <br>
                            </div>
                            <center><a href="{{ route('bayarclient') }}" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
                            <div class="modal-footer" style="border: none;">
                            </div>
                            </div>
                          </div>
                        </div>


                    <div class="modal fade" id="wallet" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                                <div class="modal-header" >
                                    <div style="display: flex; flex-direction: column;">
                                        <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                                        <div style="display: flex; align-items: center;">
                                            <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                                        </div>
                                        <div style="display: flex; align-items: center; margin-top:3%;">
                                            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="border: none;">
                                    <div class="container m-0 p-0 d-flex justify-content-between">
                                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                                            <h6 style="align-self: center;">Metode</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#cash" data-bs-toggle="modal">Cash</a></li>
                                                    <li><a class="dropdown-item active" href="#">E-Wallet</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="d-grid" style="display: flex; justify-content: space-between; margin-top:3%;">
                                            <h6 style="align-self: center;">Layanan</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilih E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#dana" data-bs-toggle="modal" >Dana</a></li>
                                                    <li><a class="dropdown-item " href="#">Ovo</a></li>
                                                    <li><a class="dropdown-item" href="#">Gopay</a></li>
                                                    <li><a class="dropdown-item" href="#">LinkAja</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="mb-3" style="margin-top:3%; width:110%;">
                                            <h6 style="align-self: center;">Bukti Pembayaran</h6>
                                            <input class="form-control" type="file" id="formFile" style="width: 35%">
                                        </div>
                            </div>
                            <center><a href="{{ route('bayarclient') }}" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
                            <div class="modal-footer" style="border: none;">
                            </div>
                            </div>
                          </div>
                        </div>

                         <div class="modal fade" id="dana" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                                <div class="modal-header" >
                                    <div style="display: flex; flex-direction: column;">
                                        <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                                        <div style="display: flex; align-items: center;">
                                            <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                                        </div>
                                        <div style="display: flex; align-items: center; margin-top:3%;">
                                            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="border: none;">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <div class="container m-0 p-0 w-50">
                                            <div class="d-grid" style="display: flex; justify-content: space-between;">
                                                <h6 style="align-self: center;">Metode</h6>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" data-bs-target="#cash" data-bs-toggle="modal">Cash</a></li>
                                                        <li><a class="dropdown-item active" href="#">E-Wallet</a></li>
                                                        <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="d-grid" style="display: flex; justify-content: space-between; margin-top:3%;">
                                                <h6 style="align-self: center;">Layanan</h6>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dana &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item active" href="#">Dana</a></li>
                                                        <li><a class="dropdown-item " href="#">Ovo</a></li>
                                                        <li><a class="dropdown-item" href="#">Gopay</a></li>
                                                        <li><a class="dropdown-item" href="#">LinkAja</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mb-3" style="margin-top:3%; width:120%;">
                                            <h6 style="align-self: center;">Bukti Pembayaran</h6>
                                            <input class="form-control" type="file" id="formFile" style="width: 70%;">
                                        </div>
                                        </div>
                                        <div class="w-50">
                                            <img class="w-100" src="{{ asset('ProjectManagement/dashmin/img/qr.png') }}">
                                        </div>
                                    </div>
                                </div>
                            <center><a href="{{ route('bayarclient') }}" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
                            <div class="modal-footer" style="border: none;">
                            </div>
                            </div>
                          </div>
                        </div>

                    <div class="modal fade" id="bank" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                                <div class="modal-header" >
                                    <div style="display: flex; flex-direction: column;">
                                        <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                                        <div style="display: flex; align-items: center;">
                                            <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                                        </div>
                                        <div style="display: flex; align-items: center; margin-top:3%;">
                                            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                                            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="border: none;">
                                    <div class="container m-0 p-0 d-flex justify-content-between">
                                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                                            <h6 style="align-self: center;">Metode</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Bank &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Cash</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-target="#wallet" data-bs-toggle="modal">E-Wallet</a></li>
                                                    <li><a class="dropdown-item active" href="#">Bank</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mb-7" style="margin-right: 10%;">
                                            <h6 style="">Layanan</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Layanan Bank &nbsp; &nbsp; &nbsp; &nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">BRI</a></li>
                                                    <li><a class="dropdown-item" href="#">BCA</a></li>
                                                    <li><a class="dropdown-item" href="#">Mandiri</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container m-0 p-0 d-flex justify-content-between">
                                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                                           <div class="mb-3" style="margin-top:3%; width:130%;">
                                            <h6 style="">Bukti Pembayaran</h6>
                                            <input class="form-control" type="file" id="formFile" style="width: 58%;">
                                        </div>
                                        </div>
                                        <div class="mb-7" style="margin-top: 2%; margin-right:10%; width:50%;">
                                            <h6 style="">No. Rekening</h6>
                                            <input type="text" class="form-control"  disabled>
                                        </div>
                                    </div>

                                <br>
                            </div>
                            <center><a href="{{ route('bayarclient') }}" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
                            <div class="modal-footer" style="border: none;">
                            </div>
                            </div>
                          </div>
                        </div>


      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
