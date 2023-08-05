<!DOCTYPE html>
<html lang="en">
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

        <div class="container-fluid pt-4 px-4">
            <div class="search-form w-25">
                <form action="{{ route('setujuclient') }}" method="GET">
                    <div class="input-group rounded-pill" style="background: #E9EEF5">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                        <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Estimasi</th>
                                    <th scope="col">Harga Project</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                @if (count($project) !== 0)
                                    @foreach ($project as $pro)
                                        <tr>
                                            <td>{{ $pro->napro }}</td>
                                            <td>{{ ($pro->estimasi == null) ? 'belum diatur' : Carbon::parse($pro->estimasi)->diffForHumans()}}</td>
                                            {{-- <td>{{ number_format($pro->harga, 0, ',', '.') }}</td> --}}
                                            <td>{{ isset($pro->biayatambahan) ? 'Rp ' . number_format((float)$pro->harga + (float)$pro->biayatambahan, 0, ',', '.') : 'Rp ' . number_format((float)$pro->harga, 0, ',', '.') }}</td>
                                            <td><span class="badge {{ $pro->status2 == 'telat' ? 'text-bg-danger' : 'bg-warning' }}">{{ $pro->status2 == 'telat' ? $pro->status2 : 'proses' }}</span></td>
                                            <td class="d-flex justify-content-evenly">
                                                @if ($pro->status2 == 'telat')
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lateProject{{ $pro->id }}"><i class="fa-solid fa-eye"></i></button>
                                                {{-- late project modal --}}
                                                <div class="modal fade" id="lateProject{{ $pro->id }}" tabindex="-1" data-bs-keyboard="false" aria-labelledby="lateProjectModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 26em">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <div class="wrapper d-flex flex-column align-items-start">
                                                                    <h5 class="modal-title text-danger" id="modalTitleId"><i class="fa-solid fa-stopwatch"></i> Telat</h5>
                                                                    <small class="fst-italic text-secondary" style="font-family: sans-serif">Project sudah melebihi deadline yang ditentukan</small>
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="wrapper refund d-grid">
                                                                    <h6 class="m-0">Refund</h6>
                                                                    <p class="text-break p-0">Ajukan pengembalian dana untuk project yang sudah anda bayar.</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btn-primary w-100 mx-2 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#refundPaymentModal{{ $pro->id }}">Refund</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Refund Payment Modal --}}
                                                <div class="modal fade" id="refundPaymentModal{{ $pro->id }}" tabindex="-1" data-bs-keyboard="false" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 26em">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <div class="wrapper d-flex flex-column align-items-start">
                                                                    <h5 class="modal-title text-warning" id="modalTitleId"><i class="fa-solid fa-money-bill-transfer"></i> Refund</h5>
                                                                    <small class="fst-italic text-secondary" style="font-family: sans-serif">Pengembalian dana untuk project {{ $pro->napro }}</small>
                                                                </div>
                                                            </div>
                                                            <form action="{{ route('refund-request-client') }}" id="sendRefundForm" onsubmit="refundRequest(event, {{ $pro->id }})" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="project_id" value="{{ $pro->id }}">
                                                                <div class="modal-body">
                                                                    <div class="wrapper d-flex justify-content-between mb-3">
                                                                        <div class="w-50">
                                                                            <p class="fw-bold mb-1">Harga Total Project</p>
                                                                            <h6 class="m-0">Rp. {{ number_format($pro->harga, 0, ',', '.') }}</h6>
                                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#detailTransaksi{{ $pro->id }}" class="btn btn-block p-0 text-primary" style="font-size: 14px">Detail transaksi</button>
                                                                        </div>
                                                                        <div class="w-50">
                                                                            <p class="fw-bold mb-1">Biaya Refund <span class="fw-normal">(Pembayaran awal)</span></p>
                                                                            <h6 class="m-0">Rp. {{ number_format($pro->harga/2, 0, ',', '.') }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="wrapper d-flex justify-content-between mb-3">
                                                                        <div class="input-group d-flex justify-content-between">
                                                                            <div style="width: 11em">
                                                                                <label for="paymentMethod">Metode Pembayaran</label>
                                                                                <select class="form-select" name="metodeRefund" id="paymentMethod">
                                                                                    <option value="Bank">Bank</option>
                                                                                    <option value="E-Wallet">E-Wallet</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="width: 11em" id="paymentProvider">
                                                                                <label for="paymentProviderList">Layanan</label>
                                                                                <select class="form-select" name="layananRefund" id="paymentProviderList">
                                                                                    <option value="Bank BRI">Bank BRI</option>
                                                                                    <option value="Bank BCA">Bank BCA</option>
                                                                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="paymentNumber" id="paymentNumberLabel" class="form-label">Nomor Rekening</label>
                                                                        <input type="text" id="paymentNumber" name="nomorRefund" class="form-control" placeholder="Masukkan nomor anda ...">
                                                                    </div>
                                                                </div>
                                                                <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
                                                                <script>
                                                                    let paymentProvider = $('#paymentProvider');
                                                                    let paymentNumberLabel = $('#paymentNumberLabel');
                                                                    const bankProvider = `<label for="paymentProviderList">Layanan</label>
                                                                        <select class="form-select" name="layananRefund" id="paymentProviderList">
                                                                            <option value="Bank BRI">Bank BRI</option>
                                                                            <option value="Bank BCA">Bank BCA</option>
                                                                            <option value="Bank Mandiri">Bank Mandiri</option>
                                                                        </select>`;
                                                                    const ewalletProvider = `<label for="paymentProviderList">Layanan</label>
                                                                        <select class="form-select" name="layananRefund" id="paymentProviderList">
                                                                            <option value="DANA">DANA</option>
                                                                            <option value="OVO">OVO</option>
                                                                            <option value="GoPay">GoPay</option>
                                                                            <option value="LinkAja">LinkAja</option>
                                                                        </select>`;
    
                                                                    $('#paymentMethod').on('change', function () {
                                                                        if ($(this).val() == 'E-Wallet') {
                                                                            paymentProvider.empty();
                                                                            paymentProvider.append(ewalletProvider);
                                                                            paymentNumberLabel.empty();
                                                                            paymentNumberLabel.append('Nomor E-Wallet');
                                                                        } else if ($(this).val() == 'Bank') {
                                                                            paymentProvider.empty();
                                                                            paymentProvider.append(bankProvider);
                                                                            paymentNumberLabel.empty();
                                                                            paymentNumberLabel.append('Nomor Rekening');
                                                                        }
                                                                    })
                                                                </script>
                                                                <div class="modal-footer border-0">
                                                                    <button type="submit" id="sendRefundBtn" class="btn btn-primary w-100 mx-2 rounded-pill fw-bold">AJUKAN REFUND</button>
                                                                    <button type="button" class="btn btn-block w-100 m-0 text-primary" data-bs-toggle="modal" data-bs-target="#lateProject{{ $pro->id }}">Kembali</button>
                                                                </div>
                                                            </form>
                                                            <script>
                                                                function refundRequest(event, id) {
                                                                    event.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Apakah Anda yakin',
                                                                        text: 'Ingin Mengajukan Refund?',
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Ya',
                                                                        cancelButtonText: 'Batal'
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('sendRefundForm').submit();
                                                                        }
                                                                    });
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="detailTransaksi{{ $pro->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="width: 26em">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Detail Transaksi</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($pro->metodepembayaran !== 'cash')
                                                            <div class="wrapper d-flex justify-content-between">
                                                                <div class="mb-3" style="width: 10em">
                                                                    <label class="mb-1">Metode Pembayaran</label>
                                                                    <input type="text"class="form-control" value="{{ ($pro->metodepembayaran == 'ewallet') ? 'E-Wallet' : (($pro->metodepembayaran == 'bank') ? 'Bank' : '') }}" disabled>
                                                                </div>
                                                                <div class="mb-3" style="width: 10em">
                                                                    <label class="mb-1">Biaya Awal</label>
                                                                    <input type="text"class="form-control" value="Rp.{{ number_format($pro->harga/2, 0, ',', '.') }}" disabled>
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
                                                                    <p>Pembayaran sebesar <b>Rp.{{ number_format($pro->harga/2, 0, ',', '.') }}</b> dilakukan secara <b>Cash</b> pada tanggal <b>{{ Carbon::parse($pro->tanggalpembayaran)->locale('id')->isoFormat('DD MMMM YYYY') }}</b></p>
                                                                </div>
                                                            @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#refundPaymentModal{{ $pro->id }}" class="btn btn-primary rounded-pill w-100 mx-2 fw-bold">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                
                                                </script>
                                                @else
                                                <a href="/detailsetujui/{{ $pro->id }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="float: right;">
            {{ $project->links() }}
            </div>
    </div>


    @include('Client.Template.footer')
</div>
<!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
