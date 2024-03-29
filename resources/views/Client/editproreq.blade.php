<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
</head>

<body>


    <div class="container-xxl position-relative bg-white p-0">
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
            <form action="{{ route('updateproreq') }}" id="updateProreqForm" onsubmit="sendRequest(event)" method="POST" enctype="multipart/form-data">
                <h5 class="px-3 mb-2">Request Project</h5>
                @csrf
                @method('PUT')
                <input type="hidden" name="projectid" value="{{ $data->id }}">
                <div class="mb-3 w-100 d-flex justify-content-between">
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input1">Nama Client</label>
                            <input type="text" class="form-control" id="input1" name="nama" value="{{ $data->nama }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input2">Nama Project</label>
                            <input type="text" class="form-control" id="input2" name="napro" value="{{ $data->napro }}">
                        </div>
                    </div>
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input3">Dokumen Pendukung (Opsional)</label>
                            <div class="wrapper d-flex">
                                <input type="file" class="form-control" name="dokumen" id="input3">
                                <button type="button" class="btn btn-block border" data-bs-toggle="modal" data-bs-target="#suppDocs"><i class="fa-solid fa-eye"></i></button>
                            </div>
                            <div class="modal fade" id="suppDocs" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Dokumen Pendukung</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($data->dokumen == null)
                                            <div class="wrapper d-flex flex-column align-items-center justify-content-center">
                                                <img class="w-25 h-25" src="{{ asset('gambar/empty-icon/empty-directory.png') }}" alt="">
                                                <p class="fw-semibold">Anda tidak menyertakan dokumen untuk project ini</p>
                                            </div>
                                            @else
                                            <div class="mb-3">
                                                <iframe class="w-100" src="{{ asset('document/'.$data->dokumen) }}" frameborder="0" style="height: 400px"></iframe>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input4">Deadline</label>
                            <input type="datetime-local" class="form-control"  name="deadline" value="{{ $data->deadline }}" id="input4">
                        </div>
                    </div>
                </div>
                <div class="wrapper m-3 d-flex">
                    <a href="{{ route('drequestclient') }}" class="btn btn-danger btn-sm mx-2">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm">Kirim Request</button>
                </div>
            </form>
            <script>
                function sendRequest(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Ingin Mengirim Request?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('updateProreqForm').submit();
                        }
                    });
                }
            </script>
        </div>
        <div class="wrapper mt-3">
                <div class="wrapper d-flex justify-content-between align-items-center mx-3">
                    <h6>Fitur</h6>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addFiturModal">Tambah Fitur</button>

                </div>
                    <style>
                        .scrollable-table {
                            max-height: 400px; /* Set the desired max height */
                            overflow-y: scroll;
                        }

                        .scrollable-table thead th {
                            position: sticky;
                            top: 0;
                            background-color: #f1f1f1; /* You can adjust the background color as needed */
                        }
                    </style>
                <div class="table-responsive px-3">
                    <div class="scrollable-table mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Fitur</th>
                                    <th class="w-75" scope="col">Deskripsi</th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataa as $fitur)
                                <tr>
                                    <td>
                                        @if (strlen($fitur->namafitur) > 15)
                                        {{ substr($fitur->namafitur, 0, 15). '...' }}
                                        @else
                                        {{ $fitur->namafitur }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strlen($fitur->deskripsi) > 89)
                                            {{ substr($fitur->deskripsi, 0, 89) . '...' }}
                                        @else
                                            {{ $fitur->deskripsi }}
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-evenly">
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{ $fitur->id }}"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;
                                        <form action="{{ route('destroyfitur', ['id' => $fitur->id]) }}" id="deleteFitur" onsubmit="deleteFitur(event, {{ $fitur->id }})" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <script>
                                            function deleteFitur(event, id) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: 'Apakah Anda yakin?',
                                                    text: 'Ingin menghapus fitur?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Ya',
                                                    cancelButtonText: 'Batal'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('deleteFitur').submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal{{ $fitur->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel{{ $data->id }}">Edit Fitur</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('updatefitur', $fitur->id) }}" method="POST">
                                            <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="fitur" >Nama Fitur</label>
                                                        <input type="text" name="namafitur" value="{{ $fitur->namafitur }}" class="form-control" id="fitur" placeholder="Masukkan Fitur" autofocus>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi">{{ $fitur->deskripsi }}</textarea>
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
                                @endforeach
                                @if($dataa->isEmpty())
                                    <tr>
                                        <td class="text-center" colspan="3">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
                <form action="{{ route('simpanfitur',$data->id) }}" method="POST">
                    <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nama Fitur</label>
                                <input type="text" name="namafitur" class="form-control" id="fitur" placeholder="Masukkan Fitur" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi"></textarea>
                                <div class="modal-footer">
                            </div>
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
    </div>
    @include('Client.Template.footer')
    @include('Client.Template.script')
</body>
@include('sweetalert::alert')


 <!-- Modal Box tambah desripsi Start -->

