<!DOCTYPE html>
@php
    use \Carbon\Carbon;
@endphp
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
            <form action="{{ route('updateproreq-admin', ['id' => $data->id]) }}" id="ajukanPerubahan" onsubmit="ajukanPerubahan(event)" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $data->id }}">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Nama Project</label>
                        <input type="text" value="{{ $data->napro }}" name="napro" class="form-control" placeholder="">
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Deadline</label>
                        <input type="datetime-local" value="{{ $data->deadline }}" name="deadline" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="mb-5 d-flex justify-content-between">
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
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Total Harga</label>
                        <input type="text" value="{{ number_format($data->harga/2, 0, ',', '.') ?? number_format($data->biayatambahan, 0, ',', '.') }}" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <a href="{{ route('projectselesai') }}" class="btn btn-primary btn-sm">Kembali</a>
                    <button class="btn btn-warning btn-sm text-white mx-2" type="submit"><i class="fa-solid fa-pencil-square"></i> Ajukan Perubahan</button>
                </div>
            </form>
            <div class="modal fade" id="pesanRevisi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Revisi dari Client</h5>
                        </div>
                        <div class="modal-body">
                            <p>{!! nl2br($data->listrevisi) !!}</p>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <script>
                  function ajukanPerubahan(event) {
                    event.preventDefault();
                    Swal.fire({
                      title: 'Apakah Anda yakin?',
                      text: 'Mengubah project ini',
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ya',
                      cancelButtonText: 'Batal'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        document.getElementById('ajukanPerubahan').submit();
                      }
                    });
                  }
            </script>
            <div class="row">
                <div class="wrapper d-flex justify-content-end">
                    <button type="button" class="btn btn-warning text-white btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#pesanRevisi">Detail Revisi</button>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addFiturModal"><i class="fa-solid fa-circle-plus"></i> Fitur</button>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Fitur</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Harga Fitur</th>
                                    <th scope="col" class="text-center" style="width:6em">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($fitur) !== 0)
                                    @foreach ($fitur as $f)
                                        <tr>
                                            <td>{{ $f->namafitur }}</td>
                                            <td>{{ $f->status }}</td>
                                            <td>
                                                @if ($f->hargafitur !== null)
                                                    {{ number_format($f->hargafitur, 0, ',', '.') }}
                                                @else
                                                    {{ number_format($f->biayatambahan, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-evenly">
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editFiturModal{{ $f->id }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <form action="{{ route('destroy-fitur') }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="fitur_id" value="{{ $f->id }}">
                                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editFiturModal{{ $f->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel{{ $f->id }}">Edit Fitur</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update-fitur', $f->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="wrapper d-flex justify-content-between">
                                                                    <div class="mb-3">
                                                                        <label for="fitur" >Nama Fitur</label>
                                                                        <input type="text" name="namafitur" value="{{ $f->namafitur }}" class="form-control" id="fitur" placeholder="Masukkan Fitur">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="fitur" >Harga Fitur</label>
                                                                        <input type="text" name="hargafitur" value="{{ $f->hargafitur ?? $f->biayatambahan }}" class="form-control" id="hargafitur" placeholder="Masukkan Harga Fitur">
                                                                    </div>
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
                                @else
                                    <td class="text-center" colspan="4">Tidak ada fitur</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Modal Tambah Fitur --}}
            <div class="modal fade" id="addFiturModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Fitur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('savefitur', $data->id) }}" method="POST">
                                @csrf
                                <div class="wrapper d-flex justify-content-between">
                                    <div class="mb-3">
                                        <label for="">Nama Fitur</label>
                                        <input type="text" name="namafitur" class="form-control" id="fitur" placeholder="Masukkan Fitur">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Harga Fitur</label>
                                        <input type="text" name="biayatambahan" class="form-control" id="hargafitur" placeholder="Masukkan Harga">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi"></textarea>
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
            <div class="container my-5">
                <div class="panel" style="height: 90vh;">
                    <h5 class="fw-bold fs-5">Diskusi</h5>
                    <p class="text-secondary">{{ $data->namaproject }}</p>
                    <div class="chatbox d-flex align-items-center justify-content-between align-items-lg-center px-3 border rounded border-1 border-dark">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-comments fs-4 me-3"></i>
                            <p class="fw-medium mt-3">Diskusikan project dengan client</p>
                        </div>
                        <button data-bs-toggle="collapse" data-bs-target="#chatbox-container" aria-expanded="false" class="btn btn-primary fw-semibold btn-sm" onclick="openChat()">Hubungi Client</button>
                    </div>
                    <style>
                        #chatbox {
                            height: 350px;
                            overflow-y: scroll;
                            scroll-behavior: smooth;
                            background:#f3f6f9;
                        }
                    </style>
                    <div class="collapse" id="chatbox-container">
                        <div class="py-3" id="chatbox">
                            <div class="chat-box d-flex flex-column p-2">
                                @if (count($chats) > 0)
                                    @foreach ($chats as $cht)
                                    <div class="col">
                                        <div class="{{ ($cht->user_id == Auth()->user()->id ) ? 'bubble-chat-admin float-end bg-primary text-white' : 'bubble-chat-client float-start bg-white'}} d-flex flex-column mb-2 py-2 px-3 rounded-3" style="max-width: 33em; font-size: 14px">
                                            <p class="messages m-0 p-0">{{ $cht->chat }}</p>
                                            <label for="" class="{{ ($cht->user_id == Auth()->user()->id) ? 'text-white' : 'text-secondary'}} mt-2" style="font-size: 9px">{{ Carbon::parse($cht->chat_time)->locale('id')->isoFormat('HH:MM, DD MMMM YYYY') }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('project-chat') }}" method="post">
                            @csrf
                            <div class="form-group p-1 d-flex px-2 rounded-bottom" style="bottom: 0; background: #f3f6f9;">
                                <input type="hidden" name="project_id" value="{{ $data->id }}">
                                <input type="hidden" name="chat_time" value="{{ Carbon::now() }}">
                                <textarea class="form-control" id="chat" name="chat" style="height: 5vh; max-height: 100px" placeholder="Ketik pesan ..."></textarea>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Content End -->


@include('Admin.templates.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>


