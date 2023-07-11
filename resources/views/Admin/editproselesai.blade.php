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
            <div class="container-fluid pt-3 px-4">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Nama Client</label>
                        <input type="text" value="{{ $data->nama }}" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px;">
                        <label class="form-label">Dokumen Pendukung</label>
                        <div class="input-group">
                            <button type="button" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#suppDocs" aria-describedby="suppdocsBtn">
                                <i class="fa-solid fa-eye pe-2"></i> lihat dokumen
                            </button>
                            @if ($data->dokumen == null)
                                <a onclick="emptyDocsDown()" class="input-group-text" id="suppdocsBtn"><i class="fa-solid fa-file-arrow-down"></i></a>
                            @else
                                <a href="{{ route('download-suppdocs', ['dokumen' => $data->dokumen]) }}" class="input-group-text" id="suppdocsBtn"><i class="fa-solid fa-file-arrow-down"></i></a>
                            @endif
                        </div>
                        <div class="modal fade" id="suppDocs" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Dokumen Pendukung</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <iframe class="w-100" src="{{ asset('document/'.$data->dokumen) }}" frameborder="0" style="height: 400px"></iframe>
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Nama Project</label>
                        <input type="text" value="{{ $data->napro }}" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Deadline</label>
                        <input type="datetime-local" value="{{ $data->deadline }}" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-3">
                    <a href="{{ route('revisiproselesai', ['id' => $data->id]) }}" class="btn btn-primary btn-sm" style="margin-right: 15px"><i class="fa fa-reply"></i> Kembali</a>
                    <a href="{{ route('editproselesai', ['id' => $data->id]) }}" class="btn btn-warning btn-sm" style="color: #ffffff"><i class="fa fa-pencil-square"></i> Ajukan Perubahan</a>
                </div>

                <div class="wrapper d-flex justify-content-between align-items-center mx-1">
                    <h6>Fitur</h6>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addFiturModal">Tambah Fitur</button>
                </div>
                <div class="table-responsive px-1">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Fitur</th>
                                <th class="w-75" scope="col">Deskripsi</th>
                                <th scope="col" class="test-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($fitur as $f)
                            <tr>
                                <td>{{ $f->namafitur }}</td>
                                <td>{{ $f->deskripsi }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{ $f->id }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('destroyfitur', ['id' => $f->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Fitur -->
                            <div class="modal fade" id="editModal{{ $f->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel{{ $f->id }}">Edit Fitur</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updatefitur', $f->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="fitur" >Nama Fitur</label>
                                                        <input type="text" name="namafitur" value="{{ $f->namafitur }}" class="form-control" id="fitur" placeholder="Masukkan Fitur">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi">{{ $f->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
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
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </div>
    </div>



@include('Admin.templates.script')





