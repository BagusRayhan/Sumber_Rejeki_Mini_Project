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
    <style>
        @media (min-width: 1199px) {
            .search-form {
                width: 16em;
                height: 2em;
            }
        }
        @media (max-width: 767px) {
            .table-responsive tr th {
                font-size: .5em;
            }
            .search-form {
                width: 14em;
                height: 2em;
            }
            .table-responsive tr td {
                font-size: .5em;
            }
        }
        </style>
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
                <div class="search-form w-100 w-md-25"> <!-- Use w-100 for full width and w-md-25 for 25% width on medium screens and larger -->
                    <form action="{{ route('refund-admin') }}" method="GET">
                        <div class="input-group rounded-pill" style="background: #E9EEF5">
                            <input type="text" name="query" value="{{ request('query') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                            <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>     
                <div class="search-form w-25">
                    <form method="GET" action="{{ route('setuju-bayar-admin') }}" class="search-form">
                        <div class="input-group rounded-pill" style="background: #E9EEF5">
                            <input type="text" name="query" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('query') }}">
                            <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>            
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Client</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Biaya Refund</th>
                                        <th scope="col" class="text-center" style="width: 7em">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($projectRefund) !== 0)
                                        @foreach ($projectRefund as $pro)
                                            <tr>
                                                <td>{{ $pro->nama }}</td>
                                                <td>{{ $pro->napro }}</td>
                                                <td><span class="badge {{ ($pro->status == 'refund pending') ? 'text-bg-success' : 'bg-warning' }}">{{ ($pro->status == 'refund pending') ? 'selesai' : $pro->status }}</span></td>
                                                <td>Rp.{{ number_format($pro->harga/2, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                  @if ($pro->status == 'refund')
                                                      <button type="button" data-bs-toggle="modal" data-bs-target="#payRefundModal{{ $pro->id }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-wallet"></i> Bayar</button>
                                                  @else
                                                    <i class="fa-solid fa-check text-success fs-5"></i>
                                                  @endif
                                                <div class="modal fade" id="payRefundModal{{ $pro->id }}" tabindex="-1" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 26em">
                                                      <div class="modal-content">
                                                          <div class="modal-header border-0">
                                                              <div class="wrapper d-flex flex-column align-items-start">
                                                                  <h5 class="modal-title text-warning" id="modalTitleId"><i class="fa-solid fa-money-bill-transfer"></i> Request Refund</h5>
                                                                  <small class="fst-italic text-secondary" style="font-family: sans-serif">Pengembalian dana untuk project {{ $pro->napro }}</small>
                                                              </div>
                                                          </div>
                                                          <form action="{{ route('pay-refund') }}" id="payRefundForm" onsubmit="payRefund(event, {{ $pro->id }})" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="project_id" value="{{ $pro->id }}">
                                                            <div class="modal-body text-start border-0">
                                                                <div class="wrapper mb-3">
                                                                  <h6>Biaya Refund : {{ number_format($pro->harga/2, 0, ',', '.') }}</h6>
                                                                </div>
                                                                <div class="wrapper mb-3">
                                                                  <label for="" class="form-label">{{ ($pro->metodeRefund == 'Bank') ? 'Nomor Rekening' : (($pro->metodeRefund == 'E-Wallet') ? 'Nomor Layanan' : '') }}</label>
                                                                  <input type="text" class="form-control" value="{{ $pro->nomorRefund }}" disabled>
                                                                </div>
                                                                <div class="mb-3 d-flex justify-content-between">
                                                                  <div style="width:11em">
                                                                    <label for="metodeRefund" class="form-label">Metode Pembayaran</label>
                                                                    <input type="text" id="metodeRefund" class="form-control" value="{{ $pro->metodeRefund }}" disabled>
                                                                  </div>
                                                                  <div style="width:11em">
                                                                    <label for="layananRefund" class="form-label">Layanan</label>
                                                                    <input type="text" id="layananRefund" class="form-control" value="{{ $pro->layananRefund }}" disabled>
                                                                  </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                  <label for="buktiRefund" class="form-label">Bukti Refund</label>
                                                                  <input type="file" id="buktiRefund" name="buktiRefund" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="submit" id="sendRefundBtn" data-bs-dismiss="modal" class="btn btn-primary w-100 mx-2 rounded-pill fw-bold">Bayar Sekarang</button>
                                                                <button type="button" class="btn btn-block w-100 m-0 text-primary" data-bs-toggle="modal" data-bs-target="#lateProject{{ $pro->id }}">Kembali</button>
                                                            </div>
                                                          </form>
                                                          <script>
                                                              function payRefund(event, id) {
                                                                  event.preventDefault();
                                                                  Swal.fire({
                                                                      title: 'Apakah Anda yakin',
                                                                      text: 'Ingin Membayar Refund?',
                                                                      icon: 'warning',
                                                                      showCancelButton: true,
                                                                      confirmButtonColor: '#3085d6',
                                                                      cancelButtonColor: '#d33',
                                                                      confirmButtonText: 'Ya',
                                                                      cancelButtonText: 'Batal'
                                                                  }).then((result) => {
                                                                      if (result.isConfirmed) {
                                                                          document.getElementById('payRefundForm').submit();
                                                                      }
                                                                  });
                                                              }
                                                          </script>
                                                      </div>
                                                  </div>
                                              </div>
                                                
                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                  const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                
                                                </script>
                                                </td>
                                            </tr>
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
                {{ $projectRefund->links() }}
                </div>
            </div>
            <!-- Confirm Payment Table End -->
        </div>
        <!-- Content End -->
    </div>
       @include('sweetalert::alert')
    @include('Admin.templates.script')
</body>

</html>
