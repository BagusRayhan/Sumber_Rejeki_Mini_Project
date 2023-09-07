    <!DOCTYPE html>
    <html lang="en">

    <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

    @include('Admin.templates.head')

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
                
                <!-- Bank Table Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <h6 class="mb-4">BANK</h6>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Bank</th>
                                            <th scope="col">Nomor Rekening</th>
                                            <th scope="col" style="width: 4em">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($banks) !== 0)
                                            @foreach ($banks as $bank)
                                                <tr>
                                                    <td>{{ $bank->nama }}</td>
                                                    <td>{{ $bank->rekening }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRekeningModal{{ $bank->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Box Edit Bank Start -->
                                                <div class="modal fade" id="editRekeningModal{{ $bank->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $bank->nama }}</h1>
                                                                </div>
                                                                <form action="{{ route('update-bank') }}" id="editRekeningForm" method="post">
                                                                    <div class="modal-body">
                                                                        @csrf
                                                                        <input type="hidden" name="idrekening" value="{{ $bank->id }}">
                                                                        <div class="mb-3">
                                                                            <input type="text" value="{{ $bank->rekening }}" class="form-control" id="nomorRekening" name="rekening">
                                                                            @error('rekening')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Box Edit Bank End-->
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Bank Table End -->
                        <!-- Bank E-Wallet Start -->
                        <div class="col-12 mb-5">
                            <h6 class="mb-4">E-Wallet</h6>
                            <div class="d-flex justify-content-evenly">
                                @if (count($ewallet) !== 0)
                                    @foreach ($ewallet as $ewl)
                                        <div class="col-2">
                                            <div class="card">
                                                <img src="gambar/qr/{{ $ewl->qrcode }}" class="card-img-top p-2">
                                                <div class="card-body justify-content-between align-items-center">
                                                    <h6 class="card-title">{{ $ewl->nama }}</h6>
                                                    <a href="#" class="btn btn-primary btn-sm rounded-circle float-end" data-bs-toggle="modal" data-bs-target="#editQRModal{{ $ewl->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Box Edit QR Start -->
                                        <div class="modal fade" id="editQRModal{{ $ewl->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $ewl->nama }}</h1>
                                                    </div>
                                                    <form action="{{ route('update-ewallet') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body mt-0 d-flex flex-column align-items-center justify-content-center">
                                                            <input type="hidden" name="idewallet" value="{{ $ewl->id }}">
                                                            <img src="gambar/qr/{{ $ewl->qrcode }}" class="w-75" id="gambar-qr">
                                                            <input type="file" class="form-control" name="qrcode" id="qrcode">
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Box Edit QR End -->
                                    @endforeach
                                 <script>
                                         let gambarqr = document.getElementById("gambar-qr");
                                         let fileqr = document.getElementById("qrcode");

                                         fileqr.onchange = function(){
                                         gambarqr.src = URL.createObjectURL(fileqr.files[0]);
                                            }
                                </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- E-Wallet Table End -->
                
                
            </div>
            <!-- Content End -->
        </div>

        @include('Admin.templates.script')

    </body>
