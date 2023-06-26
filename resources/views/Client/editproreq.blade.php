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
            <form action="{{ route('updateproreq', $data->id) }}" method="POST"  enctype="multipart/form-data">
            <h5 class="px-3 mb-2">Request Project</h5>
            {{ csrf_field() }}
            @method('PUT')
                <div class="mb-3 d-flex justify-content-between">
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input1">Nama Client</label>
                            <input type="text" class="form-control" id="input1" name="nama" value="{{ $data->nama }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input2">Nama Project</label>
                            <input type="text" class="form-control" id="input2" name="napro" value="{{ $data->napro }}">
                        </div>
                    </div>
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input3">Dokumen Pendukung</label>
                            <img src="{{ asset('gambar/'.$data->bukti) }}" width="10%" height="10%">
                            <input type="file" class="form-control" name="bukti" value="{{ 'gambar/'.$data->bukti }}" id="input3">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input4">Deadline</label>
                            <input type="datetime-local" class="form-control"  name="deadline" value="{{ $data->deadline }}" id="input4">
                        </div>
                    </div>
                </div>
                <div class="wrapper m-3 d-flex">
                    <a href="{{ route('drequestclient') }}" class="btn btn-danger btn-sm mx-2">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm mx-2">Kirim Request</button>
                </div>
            </form>
        </div>
        <div class="wrapper mt-3">
            <form action="#">
                <div class="wrapper d-flex justify-content-between align-items-center mx-3">
                    <h6>Fitur</h6>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addFiturModal">Tambah Fitur</button>

                </div>
                <div class="table-responsive px-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="w-25" scope="col">Nama Fitur</th>
                                <th class="w-75" scope="col">Deskripsi</th>
                                <th class="w-90" scope="col"><center>Aksi</center></th>
                                <th></th>
                            </tr>
                        </thead>
                       <tbody>
                    @foreach($dataa as $fitur)
                   
                        <tr>
                            <td>{{ $fitur->namafitur }}</td>
                            <td>{{ $fitur->deskripsi }}</td>
                            <td><center>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('destroyfitur', $fitur->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </center>
                        </tr>
                    @endforeach
                    @if($dataa->isEmpty())
                        <tr>
                            <td class="text-center" colspan="2">Tidak ada data</td>
                        </tr>
                    @endif

                </tbody>
                    </table>
                </div>
            </div>
        </form>
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
                    <form action="{{ route('simpanfitur',$data->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Nama Fitur</label>
                            <input type="text" name="namafitur" class="form-control" id="fitur" placeholder="Masukkan Fitur">
                        </div>
                        <div class="mb-3">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi"></textarea>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>






@include('Client.Template.footer')
@include('Client.Template.script')


 <!-- Modal Box tambah desripsi Start -->

