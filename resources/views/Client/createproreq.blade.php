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
      <style>
        .td-spacing {
            margin-right: 20px;
        }

    </style>
    <style>
        .input-group {
          position: relative;
        }

        .input-icon {
          position: absolute;
          top: 50%;
          right: 10px;
          transform: translateY(-50%);
          pointer-events: auto;
          cursor: pointer;
        }

        .dropdown-menu {
          display: none;
          position: absolute;
          top: 100%;
          right: 0;
          z-index: 999;
          /* Gaya lainnya yang diinginkan */
        }

        .dropdown-options {
          list-style: none;
          margin: 0;
          padding: 0;
          background-color: #fff;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
          position: absolute;
          top: 100%;
          right: 0;
          width: 200px;
        }

        .dropdown-options li {
          padding: 10px;
          cursor: pointer;
        }

        .dropdown-options li:hover {
          background-color: #f5f5f5;
        }

        .option-icon {
          margin-right: 5px;
        }


                    </style>
    <div class="container mt-4 d-flex justify-content-evenly">
        <div class="card" style="width: 28em">
            <div class="card-body">
                <h5 class="card-title">Request Project</h5>
                <form>
                    <div class="form-group">
                        <label for="input1">Nama Client</label>
                        <input type="text" class="form-control" id="input1" value="Ahmad" disabled>
                    </div><br>
                    <div class="form-group">
                        <label for="input2">Nama Project</label>
                        <input type="text" class="form-control" id="input2" placeholder="Masukkan nama project anda">
                    </div><br>
                    <div class="form-group">
                        <label for="input3">Dokumen Pendukung</label>
                        <input type="file" class="form-control" id="input3">
                    </div><br>
                    <div class="form-group">
                        <label for="input4">Deadline</label>
                        <input type="datetime-local" class="form-control" id="input4" placeholder="Input 4">
                    </div><br>
                    <center>
                    <button type="submit" class="btn btn-primary w-100">Kirim Request</button><br><br>
                    <a  href="http://127.0.0.1:8000/drequestclient">Kembali</a></center>
                </form>
            </div>
        </div>
        <div class="card" style="width: 28em">
            <div class="card-body">
                <h5 class="card-title">Fitur</h5>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" id="input1" value="Landing Page">
                        <div class="input-icon">
                                  <i class="fas fa-ellipsis-v"></i>

                        </div>
                        <div class="dropdown-menu">
                            <ul class="dropdown-options">
                                <li data-bs-toggle="modal" data-bs-target="#detailfitur"><span class="option-icon"><i class="fas fa-plus"></i></span> Tambah deskripsi</li>
                            </ul>
                        </div>
                    </div><br>

                    <div class="input-group">
                        <input type="text" class="form-control" id="input1" placeholder="Add fitur">
                        <div class="input-icon">
                                  <i class="fas fa-plus"></i>

                        </div>
                        <div class="dropdown-menu">
                            <ul class="dropdown-options">
                                <li><span class="option-icon"><i class="fas fa-plus"></i></span> Tambah deskripsi</li>
                            </ul>
                        </div>
                    </div><br>


                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {
                    $('.input-icon').click(function() {
                    $(this).siblings('.dropdown-menu').toggle();
                    });
                    });

                    </script>
                    <center>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal Box Edit Bank Start -->
     <div class="modal fade" id="detailfitur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Deskripsi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">

                        <div class="col-sm-12 col-xl-11" style="margin-left: 2%; margin">
                            <div class="mb-3">
                                    <label for="input1">Deskripsi</label>
                                    <textarea class="form-control w-100" name="deskirpsi" placeholder="Masukkan deskripsi yang anda inginkan"></textarea>
                            </div>
                            </div>
                        <div class="col-sm-12 col-xl-11 d-flex justify-content-end" style="margin-left: 2%; margin">
                            <div class="mb-3">
                                    <a href="" class="btn btn-danger">Batal</a>
                                    <a href="" class="btn btn-primary">Simpan</a>
                            </div>
                    </form>
                </div>

        </div>
    </div>
</div>
<!-- Modal Box Edit Bank End-->



@include('Client.Template.footer')
@include('Client.Template.script')
