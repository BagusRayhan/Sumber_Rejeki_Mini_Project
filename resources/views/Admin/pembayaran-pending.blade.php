<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->

@php
    use \Carbon\Carbon;
@endphp

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
                    <a href="/pembayaran-disetujui" onclick="redirectToPaymentPage()" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('setuju-bayar-admin') ? 'fw-bold border-dark border-bottom-2' : '' }}" data-url="/pembayaran-disetujui">
                        History
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
                                        <th scope="col" class="text-center">Status Bayar</th>
                                        <th scope="col" class="text-center">Detail</th>
                                        <th scope="col" class="text-center" style="width: 7em">Aksi</th>
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
                                                    <span class="badge rounded-pill {{ ($pro->statusbayar == 'pembayaran awal') ? 'text-bg-warning' : (($pro->statusbayar == 'pembayaran akhir') ? 'text-bg-success' : (($pro->statusbayar == 'pembayaran revisi') ? 'text-bg-primary' : '')) }}">{{ $pro->statusbayar }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-bayar btn-sm" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $pro->id }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
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
                                            <div class="modal fade" id="detailTransaksi{{ $pro->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Detail Transaksi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="wrapper">
                                                                @if ($pro->statusbayar == 'pembayaran awal')
                                                                    @if ($pro->metodepembayaran !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($pro->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($pro->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Layanan</label>
                                                                            <input type="text"class="form-control" value="{{ $pro->metode }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$pro->buktipembayaran) }}" class="w-100" alt="">
                                                                    </div>
                                                                    @else
                                                                        <div class="mb-3">
                                                                            <p>Pembayaran dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($pro->tanggalpembayaran)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                        </div>
                                                                    @endif
                                                                @elseif ($pro->statusbayar == 'pembayaran akhir')
                                                                    @if ($pro->metodepembayaran2 !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($pro->metodepembayaran2 == 'ewallet') ? 'E-Wallet' : (($pro->metodepembayaran2 == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Layanan</label>
                                                                            <input type="text"class="form-control" value="{{ $pro->metode2 }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$pro->buktipembayaran2) }}" class="w-100" alt="">
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailPembayaranAwal{{ $pro->id }}">Pembayaran Awal</button>
                                                                    </div>
                                                                    @else
                                                                        <div class="mb-3">
                                                                            <p>Pembayaran dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($pro->tanggalpembayaran2)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailPembayaranAwal{{ $pro->id }}">Pembayaran Awal</button>
                                                                        </div>
                                                                    @endif
                                                                {{-- @elseif ($pro->statusbayar = 'pembayaran revisi')
                                                                    @if ($pro->metodepembayaran !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($pro->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($pro->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Layanan</label>
                                                                            <input type="text"class="form-control" value="{{ $pro->metode }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$pro->buktipembayaran) }}" class="w-100" alt="">
                                                                    </div>
                                                                    <div class="mb-1 d-flex justify-content-between">
                                                                        <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAwal">Pembayaran Awal</button>
                                                                        <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAwal">Pembayaran Akhir</button>
                                                                    </div>
                                                                    @else
                                                                        <div class="wrapper text-center">
                                                                            <p>Pembayaran Dilakukan Secara Cash</p>
                                                                        </div>
                                                                    @endif --}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="detailPembayaranAwal{{ $pro->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Pembayaran Awal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($pro->metodepembayaran !== 'cash')
                                                            <div class="mb-3">
                                                                <label for="">Biaya Awal</label>
                                                                <input class="form-control" type="text" value="{{ $pro->harga }}" disabled>
                                                            </div>
                                                            <div class="wrapper d-flex justify-content-between">
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Metode Pembayaran</label>
                                                                    <input type="text"class="form-control" value="{{ ($pro->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($pro->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                </div>
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Layanan</label>
                                                                    <input type="text"class="form-control" value="{{ $pro->metode }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="mb-1">Bukti Pembayaran</label>
                                                                <img src="{{ asset('gambar/bukti/'.$pro->buktipembayaran) }}" class="w-100" alt="">
                                                            </div>
                                                            <div class="mb-1">
                                                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $pro->id }}">Kembali</button>
                                                            </div>
                                                            @else
                                                                <div class="mb-3">
                                                                    <p>Pembayaran dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($pro->tanggalpembayaran)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $pro->id }}">Kembali</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                {{ $propend->links() }}
                </div>
            </div>
            <!-- Confirm Payment Table End -->
        </div>
        <!-- Content End -->
    </div>

    @include('Admin.templates.script')
</body>

</html>
