<!DOCTYPE html>
<html lang="en">
     {{--  Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT  --}}
{{--  <!-- Added by HTTrack -->  --}}
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
{{--  <!-- /Added by HTTrack -->  --}}
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

      <div class="container mt-4 d-flex flex-column">
        <div class="wrapper">
            <form action="{{ route('update-proreq', ['id' => $data->id]) }}" id="setujuiProject" onsubmit="setujuiProject(event)" method="POST">
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
                        <div class="form-group">
                            <label for="input3">Dokumen Pendukung</label>
                            <div class="input-group mb-3">
                                <button type="button" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#suppDocs" aria-describedby="suppdocsBtn">
                                    <i class="fa-solid fa-eye pe-2"></i> lihat dokumen
                                </button>
                                @if ($data->dokumen == null)
                                    <a onclick="emptyDocsDown()" class="input-group-text" id="suppdocsBtn"><i class="fa-solid fa-file-arrow-down"></i></a>
                                    <script>
                                        function emptyDocsDown() {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                text: 'Dokumen tidak tersedia',
                                            })
                                        }
                                    </script>
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
                        <div class="form-group mb-3">
                            <label for="input4">Deadline</label>
                            <input type="datetime-local" class="form-control"  name="deadline" value="{{ $data->deadline }}" id="input4" disabled>
                        </div>
                    </div>
                </div>
                <div class="wrapper d-flex justify-content-between px-3" style="width: 14em;">
                    <a href="{{ route('projectreq') }}" type="button" class="btn btn-secondary btn-sm">Kembali</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myyModal{{ $data->id }}">Tolak</button>
                    @if ($data->dokumen == null && count($dataa) !== 0)
                    <button type="button" onclick="sendRequest(event)" class="btn btn-primary btn-sm">Setuju</button>
                @elseif (count($dataa) == 0)
                    <button type="button" data-bs-toggle="modal" data-bs-target="#hargaDocs{{ $data->id }}" class="btn btn-primary btn-sm">Setuju</button>
                @elseif (count($dataa) !== 0 && $data->dokumen !== null)
                    <button type="submit" onclick="sendRequest(event)" class="btn btn-primary btn-sm">Setuju</button>
                @endif


                </div>


                </form>
                <script>
                    function sendRequest(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin',
                            text: 'Ingin Menyutujui?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var form = event.target.form;
                                if (form) {
                                    form.submit();
                                } else {
                                    console.error('Form tidak ditemukan.');
                                }
                            }
                        });
                    }
                </script>

        </div>
        <div class="modal fade" id="myyModal{{ $data->id }}">
            <div class="modal-dialog modal-dialog-centered align-items-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alasan Ditolak</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('alasantolak') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="dataid" value="{{ $data->id }}">
                        <textarea class="form-control" placeholder="Masukkan Alasan Anda...." rows="6" name="alasan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- harga fitur dokument  --}}
    <div class="modal fade" data-bs-backdrop="static" id="hargaDocs{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:24em">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Harga Project</h5>
                </div>
                <form action="{{ route('simpanharga', $data->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <input type="text" name="harga" id="hargaProject" class="form-control mb-2 input-hargafitur" value="{{ $data->harga }}" aria-describedby="basic-addon1">
                            <p style="font-size: 13px; opacity: .8">Masukkan harga project berdasarkan isi dokumen</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end harga fitur dokument --}}

        <div class="wrapper mt-1">
                <div class="wrapper d-flex justify-content-between align-items-center mx-3">
                </div>
                <div class="table-responsive px-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="w-25" scope="col">Nama Fitur</th>
                                <th class="w-50" scope="col">Deskripsi</th>
                                <th class="w-25" scope="col">Harga</th>
                                <th scope="col" colspan="2"><center>Aksi</center></th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($dataa as $fitur)
                        <tr>
                            <td>{{ $fitur->namafitur }}</td>
                            <td>{{ $fitur->deskripsi }}</td>
                            <td>{{ $fitur->hargafitur }}</td>
                            <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#hargaFitur{{ $fitur->id }}"><i class="fa-solid fa-sack-dollar"></i></button></td>
                        </tr>




                        <div class="modal fade" id="hargaFitur{{ $fitur->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('simpanfiturr', $fitur->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2 d-flex justify-content-between">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Nama Fitur</label>
                                                    <input type="text" name="namafitur" class="form-control" value="{{ $fitur->namafitur }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Harga Fitur</label>
                                                    <input type="text" name="hargafitur" class="form-control input-hargafitur" value="{{ $fitur->hargafitur }}">
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
                        <td class="text-center" colspan="4">Tidak ada data</td>
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

