<!DOCTYPE html>
<html lang="en">

{{--  <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->  --}}
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

@include('Admin.templates.head')
<style>
    .list-group-item {
        background: transparent;
    }
</style>

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

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                @if(!$user->isEmpty() || !empty(request('query')))
            <form method="GET" action="{{ route('client-list') }}" class="search-form w-25">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" name="query" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                </div>
            </form>
            @endif
            </div>
                <div class="row mt-3 px-3">
                    @foreach ($user as $client)
                        <div class="col-sm-3 mb-2 mb-sm-3">
                            <div class="card" style="background-color: #F3F6F9;border: none">
                                <div class="card-body px-0">
                                    <div class="header d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('gambar/user-profile/'. $client->profil) }}" class="rounded-circle profile-image" style="width: 8em; height: 8em;">
                                        <h6 class="card-title mt-3 text-center" style="color: #191C24;opacity: 0.8">{{ $client->name }}</h6>
                                        @if ($client->status == 'banned')
                                            <span class="badge text-bg-danger rounded-pill" style="font-size: .6em">BANNED</span>
                                        @endif
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="font-size: .8em"><b>Email</b><br> {{ $client->email }}</li>
                                        <li class="list-group-item"><button class="btn w-100 btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailClient{{ $client->id }}">Detail</button></li>
                                    </ul>
                                    <div class="modal fade" id="detailClient{{ $client->id }}" aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-start">
                                                        <img src="{{ asset('gambar/user-profile/'. $client->profil) }}" class="rounded-circle profile-image" style="width: 3em; height: 3em;">
                                                        <div class="wrapper mx-2 d-flex flex-column justify-content-center p-0">
                                                            <h5 class="modal-title" id="modalTitleId">{{ $client->name }}</h5>
                                                            <span style="font-size: 14px">{{ $client->email }}</span>
                                                        </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="wrapper d-flex justify-content-between">
                                                        <ul class="list-group list-group-flush w-50">
                                                            <li class="list-group-item border-0 mb-1 p-0"><b>No. Telpon</b><br> {{ ($client->no_tlp == null) ? '-' : $client->no_tlp }}</li>
                                                            <li class="list-group-item border-0 mb-1 p-0"><b>Nama Perusahaan</b><br> {{ ($client->nama_perusahaan == null) ? '-' : $client->nama_perusahaan }}</li>
                                                        </ul>
                                                        <li class="list-group-item border-0 m-0 p-0 w-50"><b>Alamat Perusahaan</b><br> {{ ($client->alamat_perusahaan == null) ? '-' : $client->alamat_perusahaan }}</li>
                                                    </div>
                                                    <div class="wrapper">
                                                        <p class="fw-bold mb-0 mt-3">List Project</p>
                                                        @if ($project->where('user_id', $client->id)->count() > 0)
                                                            <ol class="list-group list-group-numbered mt-0" style="height: 10em; overflow-y: scroll; scroll-behavior: smooth;">
                                                                @foreach ($project->where('user_id', $client->id) as $pro)
                                                                    <li class="list-group-item">{{ $pro->napro }} <span class="badge rounded-pill float-end {{ ($pro->status == 'selesai') ? 'text-bg-success' : 'text-bg-danger' }}">{{ ($pro->status == 'selesai') ? 'selesai' : 'belum selesai' }}</span></li>
                                                                @endforeach
                                                            </ol>
                                                        @else
                                                        <div class="wrapper d-flex flex-column align-items-center justify-content-center">
                                                            <img src="{{ asset('gambar/empty-icon/empty-directory.png') }}" class="w-25" alt="">
                                                            <p class="text-center">tidak ada project</p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    @if ($client->alasan_dibanned != null)
                                                        <div class="wrapper">
                                                            <p class="fw-bold mb-0 mt-3">Alasan Dibanned</p>
                                                            <p class="text-break">{{ $client->alasan_dibanned }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    @if ($client->status == 'banned')
                                                    <form action="{{ route('unbanned-client') }}" id="unbannedClient{{ $client->id }}" onsubmit="unbannedClient(event, {{ $client->id }})" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                        <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-ban"></i> Unbanned</button>
                                                    </form>
                                                    <script>
                                                        function unbannedClient(event, id) {
                                                            event.preventDefault();
                                                            Swal.fire({
                                                            title: 'Apakah Anda yakin?',
                                                            text: 'Ingin menyetujui pembayaran ini',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Ya',
                                                            cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    document.getElementById('unbannedClient' + id).submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    @else
                                                        <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#bannedReason-{{ $client->id }}" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Banned</button>
                                                    @endif
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="bannedReason-{{ $client->id }}" onsubmit="bannedClient(event, {{ $client->id }})" aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="modalTitleId"><i class="fa-solid fa-ban"></i> Banned Client</h5>
                                                </div>
                                                <form action="{{ route('banned-client') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <div class="modal-body">
                                                        <label for="bannedreason" class="form-label">Alasan</label>
                                                        <textarea name="bannedreason" id="bannedreason" rows="8" class="form-control" placeholder="Alasan anda untuk membekukan client ini..."></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" onclick="sendRequest(event)" class="btn btn-danger btn-sm">Banned</button>
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                                <script>
                                                    function sendRequest(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Apakah Anda yakin',
                                                            text: 'Ingin Membanned akun ini?',
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($user->isEmpty())
                    <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                        <img src="{{ asset('gambar/empty-icon/empty-directory.pngs') }}" class="w-50" style="margin-top: 90px">
                        <p class="text-center">Tidak ada data</p>
                    </div>
                @else
                    </div>
                    <div class="float-end mx-4">
                        {{ $user->links() }}
                    </div>
                @endif
            @include('Admin.templates.script')
