<!DOCTYPE html>
<html lang="en">
@php
use \Carbon\Carbon;
@endphp
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
            <div class="container-fluid pt-3 px-4">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Nama Project</label>
                        <input type="text" value="{{ $detail->napro }}" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Dokumen Pendukung</label>
                        <input type="text" value="{{ $detail->bukti }}" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Deadline</label>
                        <input type="datetime-local" value="{{ $detail->deadline }}" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="form-group" style="width:480px">
                        <label for="exampleFormControlInput1" class="form-label">Total Harga</label>
                        <input type="text" value="{{ $detail->harga }}" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Fitur</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Harga Fitur</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($fitur) !== 0)
                                        @foreach ($fitur as $f)
                                            <tr>
                                                <td>{{ $f->namafitur }}</td>
                                                <td>{{ $f->status }}</td>
                                                <td>{{ $f->hargafitur }}</td>
                                                <td class="d-flex justify-content-evenly">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#detailFitur{{ $f->id }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            <!-- Modal Box Detail Fitur Start -->
                                            <div class="modal fade" id="detailFitur{{ $f->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="">
                                                                <div class="mb-2 d-flex justify-content-between">
                                                                    <div class="form-group">
                                                                        <label for="" class="form-label">Nama Fitur</label>
                                                                        <input type="text" class="form-control" value="{{ $f->namafitur }}" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-label">Harga Fitur</label>
                                                                        <input type="text" class="form-control" value="{{ $f->hargafitur }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" disabled>{{ $f->deskripsi }}</textarea>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Box Detail Fitur End -->
                                        @endforeach
                                    @else
                                        <td class="text-center" colspan="4">Tidak ada fitur</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-3 d-flex justify-content-between" style="width: 12em">
                    <a href="/setujuclient" class="btn btn-primary p-1"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>

                <div class="container my-5">
                    <div class="panel" style="height: 90vh;">
                        <h5 class="fw-bold fs-5">Diskusi</h5>
                        <p class="text-secondary">{{ $detail->namaproject }}</p>
                        <div class="chatbox d-flex align-items-center justify-content-between align-items-lg-center px-3 border rounded border-1 border-dark">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-comments fs-4 me-3"></i>
                                <p class="fw-medium mt-3">Diskusikan project dengan admin</p>
                            </div>
                            <button data-bs-toggle="collapse" data-bs-target="#chatbox-container" aria-expanded="false" class="btn btn-primary fw-semibold btn-sm" onclick="openChat()">Hubungi Admin</button>
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
                                                <div class="{{ ($cht->user_id == 2) ? 'bubble-chat-client float-end bg-primary text-white' : 'bubble-chat-admin float-start bg-white'}} d-flex flex-column mb-2 py-2 px-3 rounded-3" style="max-width: 33em; font-size: 14px">
                                                    <p class="messages m-0 p-0">{{ $cht->chat }}</p>
                                                    <label for="" class="{{ ($cht->user_id == 2) ? 'text-white' : 'text-secondary'}} mt-2" style="font-size: 9px">{{ Carbon::parse($cht->chat_time)->locale('id')->isoFormat('HH:MM, DD MMMM YYYY') }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('project-chat-client') }}" method="post">
                                @csrf
                                <div class="form-group p-1 d-flex px-2 rounded-bottom" style="bottom: 0; background: #f3f6f9;">
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
    </div>
    <!-- Modal Box Edit Bank End-->
    @include('Client.Template.footer')
    </div>
        <!-- Content End -->
@include('Client.Template.script')
</body>
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>


