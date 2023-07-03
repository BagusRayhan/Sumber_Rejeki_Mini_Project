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
                            <a href="{{ route('drequestclient') }}" class="btn btn-danger btn-sm mx-2">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm mx-2">Next Step</button>
                        </div>
                    </form>
                </div>
                <div class="wrapper mt-3">
            </div>


    </div>



@include('Client.Template.script')

    </body>


    <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
    </html>
