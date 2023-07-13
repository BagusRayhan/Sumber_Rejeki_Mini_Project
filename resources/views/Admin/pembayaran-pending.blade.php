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

            <!-- Confirm Payment Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="search-form w-25">
                    <form action="">
                        <div class="input-group rounded-pill" style="background: #E9EEF5">
                            <input type="text" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                            <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="nav w-25 mt-4 d-flex">
                    <a href="/pembayaran-pending" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('pending-bayar-admin') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                        Pending
                    </a>
                    <a href="/pembayaran-disetujui" onclick="redirectToPaymentPage()" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('setuju-bayar-admin') ? 'fw-bold border-dark border-bottom-2' : '' }}"  data-url="/pembayaran-disetujui">
                        Disetujui
                    </a>
                    <script>
                        function redirectToPaymentPage() {
                          // Mengubah URL ke halaman pembayaran-disetujui
                          window.location.href = 'halaman-pembayaran-disetujui.html';
                        }
                      </script>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Client</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Harga Project</th>
                                        <th scope="col" class="text-center">Bukti Pembayaran</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($propend) !== 0)
                                    @foreach ($propend as $pro)
                                    <tr>
                                        <td>{{ $pro->nama }}</td>
                                        <td>{{ $pro->napro }}</td>
                                        <td>{{ $pro->harga }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-bayar btn-sm" data-bs-toggle="modal" data-bs-target="#buktiTransaksiModal" data-id="{{ $pro->id }}" data-bukti="{{ $pro->buktipembayaran }}" >
                                                <i class="fa-solid fa-image"></i>
                                            </button>

                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-evenly">
                                            <form action="{{ route('setujui-pembayaran', ['id' => $pro->id]) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="idpropend" value="{{ $pro->id }}">
                                                <button class="btn btn-primary btn-sm rounded-circle" type="submit">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('tolak-pembayaran', ['id' => $pro->id]) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="idpropend" value="{{ $pro->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm rounded-circle">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="buktiTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="width: 400px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body mt-0 d-flex flex-column align-items-center justify-content-center">
                                                   <img id="buktipembayaran" src="{{ asset('gambar/bukti/'. $pro->id . '.jpg') }}" class="w-75">
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endif

                                        <script>
                                            $(document).ready(function() {
                                                $('.btn-bayar').click(function() {
                                                    var buktipembayaran = $(this).data('bukti');
                                                    var projectId = $(this).data('id');

                                                    $('#buktipembayaran').attr('src', buktipembayaran);
                                                    $('#projectIdCash').val(projectId);
                                                    $('#buktiTransaksiModal').modal('show');
                                                });
                                            });
                                            </script>
                                            @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                                    </tr>
                                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Confirm Payment Table End -->
        <!-- Content End -->

    </div>

    @include('Admin.templates.script')
</body>
