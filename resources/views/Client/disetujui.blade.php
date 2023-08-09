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
                                                @if ($pro->status2 == 'telat' && $pro->biayatambahan == null)
                                                <button class="btn btn-primary btn-sm btn-refund" data-bs-toggle="modal" data-id="{{ $pro->id }}" data-napro="{{ $pro->napro }}" data-harga="{{ $pro->harga }}" data-tanggalpembayaran="{{ $pro->tanggalpembayaran }}" data-metodepembayaran="{{ $pro->metodepembayaran }}" data-biayatambahan="{{ $pro->biayatambahan }}"  data-bs-target="#lateProject"><i class="fa-solid fa-eye"></i></button>
                                                                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                
                                                </script>
                                                @elseif ($pro->status2 == 'telat' && $pro->biayatambahan !== null)
                                                <form action="{{ route('cancel-revision') }}" method="post" id="cancelProjectRevision" onsubmit="cancelProject(event, {{ $pro->id }})">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="project_id" >
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-xmark"></i></button>
                                                </form>
                                                <script>
                                                    function cancelProject(event, id) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Apakah Anda yakin?',
                                                            text: 'Ingin membatalkan revisi?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Ya',
                                                            cancelButtonText: 'Tidak'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('cancelProjectRevision').submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                                {{-- <div class="modal fade" id="extendsProject" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Body
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                
                                                
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

                                                {{-- late project modal --}}
                                                <div class="modal fade" id="lateProject" tabindex="-1" data-bs-keyboard="false" aria-labelledby="lateProjectModal" aria-hidden="true">
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
                                                                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                                                                    <h6>Nama Project</h6>
                                                                    <input type="text" name="namaProject" class="form-control w-50" style="border:none; font-style: ubuntu;" id="namaProject" disabled>
                                                                    </div>
                                                                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                                                                    <h6>Harga Project</h6>
                                                                    <input type="text" name="hargaProject" class="form-control w-50" style="border:none; font-style: ubuntu;" id="hargaProject5" disabled>
                                                                    </div>
                                                                     <div class="d-flex justify-content-evenly align-items-center mb-3">
                                                                    <h6>Harga Refund</h6>
                                                                    <input type="text" name="hargaRefound" class="form-control w-50" style="border:none; font-style: ubuntu;" id="hargaProj" disabled>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="projectIdCash">
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btn-primary w-100 mx-2 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#refundPaymentModal">Refund</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Refund Payment Modal --}}
                                                <div class="modal fade" id="refundPaymentModal" tabindex="-1" data-bs-keyboard="false" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 26em">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <div class="wrapper d-flex flex-column align-items-start">
                                                                    <h5 class="modal-title text-warning" id="modalTitleId"><i class="fa-solid fa-money-bill-transfer"></i> Refund</h5>
                                                                    <small class="fst-italic text-secondary" style="font-family: sans-serif" id="namaProjectCash">Pengembalian dana untuk project </small>
                                                                </div>
                                                            </div>
                                                            <form id="sendRefundForm" action="{{ route('refund-request-client', '') }}"   method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="wrapper d-flex justify-content-between mb-3">
                                                                        <div class="w-50">
                                                                            <p class="fw-bold mb-1">Harga Total Project</p>
                                                                            <h6 class="m-0"  id="hargaProjectCash">Rp. </h6>
                                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#detailTransaksi" class="btn btn-block p-0 text-primary bayar-belumnya" style="font-size: 14px">Detail transaksi</button>
                                                                        </div>
                                                                        <div class="w-50">
                                                                            <p class="fw-bold mb-1">Biaya Refund <span class="fw-normal">(Pembayaran awal)</span></p>
                                                                            <h6 class="m-0"  id="hargaProjectCash2">Rp. </h6>
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
                                                                <script>
                                                                function formatHarga(harga) {
                                                                return 'Rp ' + harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                                                }

                                                                $(document).ready(function() {
                                                                    var hargaFormatted4;
                                                                        var tglBayar; 
                                                                        var metodepembayaran;
                                                                    $('.btn-refund').click(function() {
                                                                        var napro = $(this).data('napro');
                                                                        harga = $(this).data('harga');
                                                                        tglBayar = $(this).data('tanggalpembayaran');
                                                                        metodepembayaran = $(this).data('metodepembayaran');
                                                                        var projectId = $(this).data('id');

                                                                        
                                                                        console.log("tglBayar: " + tglBayar);
                                                                        console.log("metodepembayaran: " + metodepembayaran);

                                                                        setengahHarga = parseInt(harga) / 2;
                                                                        hargaFormatted4 = formatHarga(setengahHarga);
                                                                        var hargaFormatted5 = formatHarga(harga);
                                                                        

                                                                        $('#namaProject').val(napro);
                                                                        $('#hargaProject5').val(hargaFormatted5);
                                                                        $('#hargaProj').val(hargaFormatted4);
                                                                        $('#tgl-bayar').val(tglBayar);
                                                                        $('#metodepembayaran').val(metodepembayaran); 
                                                                        $('#projectIdCash').val(projectId);
                                                                        $('#lateProject').modal('show');
                                                                    });

                                                                    $('.bayar-belumnya').click(function() {
                                                                        var harga = $('#hargaProj').val();
                                                          
                                                                        console.log("harga: " + harga);
                                                                        console.log("tglBayar: " + tglBayar);
                                                                        console.log("metodepembayaran: " + metodepembayaran);

                                                                        var formattedDate = new Date(tglBayar).toLocaleDateString('id-ID', {
                                                                            year: 'numeric',
                                                                            month: 'long',
                                                                            day: 'numeric'
                                                                        });

                                                                        $('#harga-revisi').text(harga);
                                                                        $('#tgl-bayarrevisi').text(formattedDate);
                                                                        $('#metodepembayaranrevisi').text(metodepembayaran);
                                                                        $('#detailTransaksi').modal('show');
                                                                    });
                                                                    function formatDate(dateString) {
                                                                        var date = new Date(dateString);
                                                                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                                                        return date.toLocaleDateString('id-ID', options); // Adjust 'id-ID' to the desired locale
                                                                    }

                                                                    $('#refundPaymentModal').on('shown.bs.modal', function (event){
                                                                        var button = $(event.relatedTarget);
                                                                        var projectId = button.data('id');
                                                                        var napro = $('#namaProject').val();
                                                                        var harga = $('#hargaProject5').val();
                                                                        var projectId = $('#projectIdCash').val();

                                                      
                                                                        $('#namaProjectCash').text(napro); 
                                                                        $('#hargaProjectCash').text(harga);
                                                                        console.log("Setengah : " +hargaFormatted4);
                                                                        $('#hargaProjectCash2').text(hargaFormatted4.toString());

                                                                        var form = $('#sendRefundForm');
                                                                        var action = form.attr('action');
                                                                        action = action.replace(/\/\d+$/, "");
                                                                        form.attr('action', action + '/' + projectId);

                                                                    });
                                                                        $('#sendRefundForm').on('submit', function(event) {
                                                                        event.preventDefault(); 

                                                                        Swal.fire({
                                                                            title: 'Apakah Anda yakin?',
                                                                            text: 'Ingin membayar project ini sekarang?',
                                                                            icon: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonText: 'Bayar Sekarang',
                                                                            cancelButtonText: 'Batal',
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                this.submit();
                                                                            }
                                                                            });
                                                                        });
                                                                });
                                                                </script>
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
                                                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary w-100 mx-2 rounded-pill fw-bold">AJUKAN REFUND</button>
                                                                    <button type="button" class="btn btn-block w-100 m-0 text-primary" data-bs-toggle="modal" data-bs-target="#lateProject">Kembali</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" id="detailTransaksi" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="width: 26em">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Detail Transaksi</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <p>Pembayaran sebesar <b id="harga-revisi">Rp.</b> dilakukan melalui <b id="metodepembayaranrevisi"> </b> pada tanggal <b id="tgl-bayarrevisi"></b></p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#refundPaymentModal" class="btn btn-primary rounded-pill w-100 mx-2 fw-bold">Kembali</button>
                                                            </div>
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
