<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    @include('Admin.templates.head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

      <div class="container mt-4 d-flex flex-column">
        <div class="wrapper">
            <form action="{{ route('updateproreqa', $data->id) }}" method="GET">
            <h5 class="px-3 mb-2">Request Project</h5>
            @csrf
            @method('PUT')
                <div class="mb-3 d-flex justify-content-between">
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input1">Nama Client</label>
                            <input type="text" class="form-control" id="input1" name="nama" value="{{ $data->nama }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input2">Nama Project</label>
                            <input type="text" class="form-control" id="input2" name="napro" value="{{ $data->napro }}" disabled>
                        </div>
                    </div>
                    <div class="wrapper w-50 px-3 d-flex flex-column">
                        <div class="form-group mb-3">
                            <label for="input3">Dokumen Pendukung</label>
                            <div class="wrapper d-flex">
                                <input type="text" class="form-control" value="{{ $data->dokumen }}" name="dokumen" id="input3" disabled>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#suppDocs"><i class="fa-solid fa-eye"></i></button>
                            </div>
                            <div class="modal fade" id="suppDocs"tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Dokumen Pendukung</h1>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <iframe class="w-100" src="{{ asset('document/'.$data->dokumen) }}" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input4">Deadline</label>
                            <input type="datetime-local" class="form-control"  name="deadline" value="{{ $data->deadline }}" id="input4" disabled>
                        </div>
                    </div>
                </div>
                <div class="wrapper d-flex px-3 justify-content-between" style="width: 9em;">
                    <button type="submit" onclick="konfirmasi(event)" class="btn btn-primary btn-sm">Setuju</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myyModal{{ $data->id }}">Tolak</button>
                </div>
            </form>
            {{-- <script>
                function konfirmasi(event) {
                            event.preventDefault(); // Mencegah perilaku default tombol submit

                            Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: 'Ingin Menyetujui Project?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Aksi yang akan dijalankan jika pengguna menekan tombol "Ya"

                                    // Setelah sweet alert ditampilkan, formulir dapat dikirim secara manual
                                    document.querySelector('form').submit();
                                } else {
                                    // Aksi yang akan dijalankan jika pengguna menekan tombol "Batal"
                                    Swal.fire(
                                        'Tindakan dibatalkan',
                                        'Project tidak disetujui',
                                        'error'
                                    );
                                }
                            });
                        }
            </script> --}}
        </div>
        <div class="modal fade" id="myyModal{{ $data->id }}">
            <div class="modal-dialog modal-dialog-centered align-items-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ditolak</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('alasantolak') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="dataid" value="{{ $data->id }}">
                        <label for="" class="form-label">Alasan Ditolak</label>
                        <textarea rows="4" cols="50" name="alasan" required></textarea>
                        <button type="submit" onclick="showConfirmation(event)" class="btn btn-primary mt-4">Submit</button>
                    </form>
                    {{-- <script>
                        function showConfirmation(event) {
                            event.preventDefault(); // Mencegah perilaku default tombol submit

                            Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: 'Ingin Menolak Project?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Aksi yang akan dijalankan jika pengguna menekan tombol "Ya"

                                    // Setelah sweet alert ditampilkan, formulir dapat dikirim secara manual
                                    document.querySelector('form').submit();
                                } else {
                                    // Aksi yang akan dijalankan jika pengguna menekan tombol "Batal"
                                    Swal.fire(
                                        'Tindakan dibatalkan',
                                        'Project tidak ditolak',
                                        'error'
                                    );
                                }
                            });
                        } --}}
                    </script>
                </div>
            </div>
        </div>
    </div>



        <div class="wrapper mt-1">
                <div class="wrapper d-flex justify-content-between align-items-center mx-3">
                </div>
                <div class="table-responsive px-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="w-25" scope="col">Nama Fitur</th>
                                <th class="w-75" scope="col">Harga</th>
                                <th class="w-90" scope="col" colspan="2"><center>Aksi</center></th>
                            </tr>
                        </thead>
                       <tbody>
                    @foreach($dataa as $fitur)

                        <tr>
                            <td>{{ $fitur->namafitur }}</td>
                            <td>{{ $fitur->hargafitur }}</td>
                            <td><a href="#" id="buktiTransaksiModal" class="btn btn-primary" style="height: 30px;border: none" data-bs-toggle="modal" data-bs-target="#myModal{{ $fitur->id }}"><svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 15px" width="17" height="17" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                              </svg></i></a></td>
                        </tr>
                        <!-- Edit Fitur -->
                        <div class="modal fade" id="myModal{{ $fitur->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('simpanharga', $fitur->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2 d-flex justify-content-between">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Nama Fitur</label>
                                                    <input type="text" name="namafitur" class="form-control" value="{{ $fitur->namafitur }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Harga Fitur</label>
                                                    <input type="text" name="hargafitur" class="form-control" value="{{ $fitur->hargafitur }}">
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="6" disabled>{{ $fitur->deskripsi }}</textarea>
                                            </div>
                                            <button type="submit" style="border: none;margin-left: 398px" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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


    <!-- Edit Fitur -->

    @include('Admin.templates.script')
    @include('sweetalert::alert')


 <!-- Modal Box tambah desripsi Start -->

