<!DOCTYPE html>
<html lang="en">
@php
    use \Carbon\Carbon;
@endphp
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

@include('Admin.templates.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->

        <!-- Spinner End -->

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Admin.templates.navbar')

            <!-- Confirm Payment Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="search-form w-25">
                    <form action="{{ route('setuju-bayar-admin') }}" method="GET">
                        <div class="input-group rounded-pill" style="background: #E9EEF5">
                            <input type="text" name="query" value="{{ request('query') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                            <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="nav w-25 mt-4 d-flex">
                    <a href="/pembayaran-pending" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('pending-bayar-admin') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                        Pending
                    </a>
                    <a href="/pembayaran-disetujui" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('setuju-bayar-admin') ? 'fw-bold border-2  border-bottom border-dark' : '' }}">
                        History
                    </a>
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
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($approved) !== 0)
                                        @foreach ($approved as $apv)
                                            <tr>
                                                <td>{{ $apv->nama }}</td>
                                                <td>{{ $apv->napro }}</td>
                                                <td>Rp.{{ number_format($apv->harga, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <span class="badge rounded-pill {{ (($apv->statusbayar == 'lunas') ? 'text-bg-success' : (($apv->statusbayar == 'lunas') ? 'text-bg-primary' : '')) }}">{{ $apv->statusbayar }}</span>
                                                </td>
                                                <td class="d-flex justify-content-evenly">
                                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $apv->id }}"><i class="fa-solid fa-eye"></i></a>
                                                    <form action="{{ route('delete-history-project') }}" id="deleteHistoryProject" onsubmit="deleteHistory(event)" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="project_id" value="{{ $apv->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                    <script>
                                                        function deleteHistory(event) {
                                                            event.preventDefault();
                                                            Swal.fire({
                                                                title: 'Apakah Anda yakin?',
                                                                text: 'Ingin menghapus project ini',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    document.getElementById('deleteHistoryProject').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="detailTransaksi{{ $apv->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Detail Transaksi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="wrapper">
                                                                @if ($apv->statusbayar == 'pembayaran awal')
                                                                    @if ($apv->metodepembayaran !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($apv->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($apv->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Biaya Awal</label>
                                                                            <input type="text"class="form-control" value="{{ $apv->harga/2 }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$apv->buktipembayaran) }}" class="w-100" alt="">
                                                                    </div>
                                                                    @else
                                                                        <div class="mb-3">
                                                                            <p>Pembayaran sebesar <b>{{ $apv->harga/2 }}</b> dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($apv->tanggalpembayaran)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                        </div>
                                                                    @endif
                                                                @elseif ($apv->statusbayar == 'pembayaran akhir')
                                                                    @if ($apv->metodepembayaran2 !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($apv->metodepembayaran2 == 'ewallet') ? 'E-Wallet' : (($apv->metodepembayaran2 == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Biaya Akhir</label>
                                                                            <input type="text"class="form-control" value="{{ $apv->harga/2 }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$apv->buktipembayaran2) }}" class="w-100" alt="">
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#pembayaranAwal{{ $apv->id }}">Pembayaran Awal</button>
                                                                    </div>
                                                                    @else
                                                                        <div class="mb-3">
                                                                            <p>Pembayaran sebesar <b>{{ $apv->harga/2 }}</b> dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($apv->tanggalpembayaran2)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#pembayaranAwal{{ $apv->id }}">Pembayaran Awal</button>
                                                                        </div>
                                                                    @endif
                                                                @elseif ($apv->statusbayar = 'pembayaran revisi')
                                                                    @if ($apv->metodepembayaran !== 'cash')
                                                                    <div class="wrapper d-flex justify-content-between">
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Metode Pembayaran</label>
                                                                            <input type="text"class="form-control" value="{{ ($apv->metodepembayaran3 == 'ewallet') ? 'E-Wallet' : (($apv->metodepembayaran3 == 'bank') ? 'Bank' : '') }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3" style="width: 12em">
                                                                            <label class="mb-1">Biaya Revisi</label>
                                                                            <input type="text"class="form-control" value="{{ $apv->biayatambahan }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mb-1">Bukti Pembayaran</label>
                                                                        <img src="{{ asset('gambar/bukti/'.$apv->buktipembayaran3) }}" class="w-100" alt="">
                                                                    </div>
                                                                    <div class="mb-1 d-flex justify-content-between">
                                                                        <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAwal{{ $apv->id }}">Pembayaran Awal</button>
                                                                        <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAkhir{{ $apv->id }}">Pembayaran Akhir</button>
                                                                    </div>
                                                                    @else
                                                                        <div class="wrapper text-center">
                                                                            <p>Pembayaran sebesar <b>{{ $apv->biayatambahan }}</b> dilakukan secara Cash pada tanggal <b>{{ Carbon::parse($apv->tanggalpembayaran3)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                        </div>
                                                                        <div class="mb-1 d-flex justify-content-between">
                                                                            <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAwal{{ $apv->id }}">Pembayaran Awal</button>
                                                                            <button class="btn btn-primary" style="width: 48%" data-bs-toggle="modal" data-bs-target="#pembayaranAkhir{{ $apv->id }}">Pembayaran Akhir</button>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="pembayaranAwal{{ $apv->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Pembayaran Awal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($apv->metodepembayaran !== 'cash')
                                                            <div class="wrapper d-flex justify-content-between">
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Metode Pembayaran</label>
                                                                    <input type="text"class="form-control" value="{{ ($apv->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($apv->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                </div>
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Biaya Awal</label>
                                                                    <input type="text"class="form-control" value="{{ $apv->harga/2 }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="mb-1">Bukti Pembayaran</label>
                                                                <img src="{{ asset('gambar/bukti/'.$apv->buktipembayaran) }}" class="w-100" alt="">
                                                            </div>
                                                            <div class="mb-1">
                                                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $apv->id }}">Kembali</button>
                                                            </div>
                                                            @else
                                                                <div class="mb-3">
                                                                    <p>Pembayaran sebesar <b>{{ $apv->harga/2 }}</b> dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($apv->tanggalpembayaran)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $apv->id }}">Kembali</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="pembayaranAkhir{{ $apv->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="width: 28em">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Pembayaran Akhir</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($apv->metodepembayaran2 !== 'cash')
                                                            <div class="wrapper d-flex justify-content-between">
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Metode Pembayaran</label>
                                                                    <input type="text"class="form-control" value="{{ ($apv->metodepembayaran2 == 'ewallet') ? 'E-Wallet' : (($apv->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                </div>
                                                                <div class="mb-3" style="width: 12em">
                                                                    <label class="mb-1">Biaya Akhir</label>
                                                                    <input type="text"class="form-control" value="{{ $apv->harga/2 }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="mb-1">Bukti Pembayaran</label>
                                                                <img src="{{ asset('gambar/bukti/'.$apv->buktipembayaran2) }}" class="w-100" alt="">
                                                            </div>
                                                            <div class="mb-1">
                                                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $apv->id }}">Kembali</button>
                                                            </div>
                                                            @else
                                                                <div class="mb-3">
                                                                    <p>Pembayaran sebesar <b>{{ $apv->harga/2 }}</b> dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($apv->tanggalpembayaran2)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $apv->id }}">Kembali</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payment Detail Modal Start -->
                                            {{-- <div class="modal fade" id="paymentDetailModal{{$apv->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Detail Pembayaran Terbaru</h1>
                                                        </div>
                                                        @if ($apv->metodePembayaran == '')

                                                        @endif
                                                        <div class="modal-body mt-0 d-flex justify-content-evenly">
                                                            <img src="{{ asset('gambar/bukti/') }}" class="w-50">
                                                            <div class="container">
                                                                <div class="mb-2">
                                                                    <label for="namaClient">Nama Client</label>
                                                                    <input type="text" id="namaClient" class="form-control" value="{{ $apv->nama }}" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="namaProject">Nama Project</label>
                                                                    <input type="text" id="namaProject" class="form-control" value="{{ $apv->napro }}" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="hargaProject">Harga Project</label>
                                                                    <input type="text" id="hargaProject" class="form-control" value="{{ $apv->harga }}" disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="metodePembayaran">Metode Pembayaran</label>
                                                                    <input type="text" id="metodePembayaran" class="form-control" value="{{ $apv->metodepembayaran }}" disabled>
                                                                </div>
                                                                <div class="mt-5 text-center">
                                                                    <button type="button" class="btn btn-primary fw-medium rounded-pill w-100 p-2" data-bs-dismiss="modal" aria-label="Close">Pembayaran Sebelumnya</button>
                                                                    <button class="btn btn-block text-primary mt-2" data-bs-dismiss="modal">Kembali</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <!-- Payment Detail Modal End -->
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
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

