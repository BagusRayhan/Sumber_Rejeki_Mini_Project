 <!DOCTYPE html>
<html lang="en">
{{--  <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->  --}}
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <style>
        #buttonContainer {
        display: none;
        margin-top: 10px;
        }
        #imageContainer img {
        float: right;
        margin-top: -140px;
        margin-left: 240px;
    }
    #fileInputContainer {
        position: relative;
    }
    #fileInputContainer{
        position: absolute;
        top: 174px;
        left: 31px;
    }
            @media print {
            body * {
                visibility: hidden;
            }
            .modal, .modal * {
                visibility: visible;
            }
            .modal {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: transparent;
                padding: 0;
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
        @include('Client.Template.sidebar')

        <!-- Content Start -->
        <div class="content">
      @include('Client.Template.navbar')

      <div class="container-fluid pt-4 px-4">
        <div class="search-form w-25">
            <form action="{{ route('bayar2client') }}" method="GET">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                    <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-between">
        <div class="nav w-25 mt-4 d-flex">
            <a href="/bayarclient" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('bayarclient') ? 'fw-bold border-2 border-bottom border-dark' : '' }}">
                Pending
            </a>
            <a href="/bayar2client" class="d-flex text-decoration-none text-dark px-3 py-1 border-bottom border-secondary {{ Request::routeIs('bayar2client') ? 'fw-bold border-2  border-bottom border-dark' : '' }}">
                Pembayaran
            </a>
        </div>
        <div>
    <a href="#" id="deleteAllSelectedRecord" class="btn btn-danger btn-sm d-none">Delete All</a>
   <script>

    function updateDeleteAllButtonVisibility() {
        if ($('.checkbox_ids:checked').length > 0) {
            $('#deleteAllSelectedRecord').removeClass('d-none');
        }else{
            $('#deleteAllSelectedRecord').addClass('d-none');
        }
    }

$(function(e){
    $('#select_all_ids').click(function(){
        $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        updateDeleteAllButtonVisibility();
    });

    $('.checkbox_ids').click(function() {
        updateDeleteAllButtonVisibility();
        if ($('.checkbox_ids:checked').length === $('.checkbox_ids').length) {
            $('#select_all_ids').prop('checked', true);
        } else {
            $('#select_all_ids').prop('checked', false);
        }
    });

    $('#deleteAllSelectedRecord').click(function(e){
        e.preventDefault();
        var all_ids = [];
        $('input:checkbox[name=ids]:checked').each(function(){
            all_ids.push($(this).val());
        });

        if (all_ids.length > 0) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dipilih akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-all') }}",
                        type: "DELETE",
                        data: {
                            ids: all_ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            $.each(all_ids, function(key, val){
                                $('#employee_ids' + val).remove();
                            });
                            updateDeleteAllButtonVisibility();

                            if ($('.checkbox_ids:checked').length > 0) { 
                                $('#select_all_ids').prop('checked', true);
                                } else {
                                     $('#select_all_ids').prop('checked', false);
                                }
                            
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        }
                    });
                }
            });
        } else {
            Swal.fire(
                'Peringatan!',
                'Pilih setidaknya satu data untuk dihapus.',
                'warning'
            );
        }
    });
});
</script>
        </div>

    </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                    <input class="form-check-input master-checkbox"  type="checkbox" value="" id="select_all_ids">
                                    </div>
                                </th>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bayar2 as $client2)
                            @if ( $client2->statusbayar === 'belum lunas' || $client2->statusbayar === 'lunas' || $client2->statusbayar == 'pembayaran akhir' || $client2->statusbayar = 'pembayaran revisi')
                            <tr id="employee_ids{{ $client2->id }}">
                                <td>
                                    <div class="form-check">
                                        @if ($client2->statusbayar === 'lunas')
                                            <input class="form-check-input checkbox_ids" type="checkbox" name="ids" value="{{ $client2->id }}">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $client2->napro }}</td>
                                <td>
                                    @php
                                        $totalHarga = $client2->biayatambahan ? $client2->harga + $client2->biayatambahan : $client2->harga;
                                    @endphp
                                    Rp.{{ number_format($totalHarga, 0, ',', '.') }}
                                </td>

                                <td class="text-center ">
                                @if ($client2->statusbayar == 'lunas')
                                    <span class="badge text-bg-success">{{ $client2->statusbayar }}</span>
                                @elseif ($client2->statusbayar == 'belum lunas')
                                    <span class="badge bg-danger text-white">{{ $client2->statusbayar }}</span>
                                    @elseif ($client2->statusbayar == 'pembayaran akhir' || $client2->statusbayar == 'pembayaran revisi')
                                    <span class="badge bg-warning">menunggu persetujuan</span>
                                @else
                                    <span class="badge">{{ $client2->statusbayar }}</span>
                                @endif
                                    </td>
                                    <td class="text-center">
                                    @if ($client2->biayatambahan)
                                        @if ($client2->tanggalpembayaran3  && $client2->statusbayar === 'lunas')
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#struk2" data-bs-id="{{ $client2->id }}" data-bs-nama="{{ $client2->napro }}" data-bs-harga="{{ $client2->harga }}" data-bs-tanggal="{{ $client2->tanggalpembayaran }}" data-bs-biayatambahan="{{ $client2->biayatambahan }}" data-bs-tanggal2="{{ $client2->tanggalpembayaran2 }}" data-bs-metode="{{ $client2->metodepembayaran }}" data-bs-metode2="{{ $client2->metodepembayaran2 }}" class="btn btn-warning struk text-white btn-sm" style="background-color: none">
                                                <i class="fa-sharp fa-solid fa-print"></i>&nbsp;Struk
                                            </button>
                                        @else
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar2" data-id="{{ $client2->id }}" data-napro="{{ $client2->napro }}" data-harga="{{ $client2->harga }}" data-tanggalpembayaran="{{ $client2->tanggalpembayaran }}" data-metodepembayaran="{{ $client2->metodepembayaran }}" data-biayatambahan="{{ $client2->biayatambahan }}" data-tanggalpembayaran2="{{ $client2->tanggalpembayaran2 }}" data-metodepembayaran2="{{ $client2->metodepembayaran2 }}" class="btn btn-primary btn-revisi btn-sm" style="background-color: none">
                                                <i class="fa-solid fa-wallet"></i>&nbsp;Bayar
                                            </button>
                                        @endif
                                    @elseif ($client2->statusbayar == 'lunas')
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#struk" data-bs-id="{{ $client2->id }}" data-bs-nama="{{ $client2->napro }}" data-bs-harga="{{ $client2->harga }}" data-bs-tanggal="{{ $client2->tanggalpembayaran }}" data-bs-tanggal2="{{ $client2->tanggalpembayaran2 }}" data-bs-metode="{{ $client2->metodepembayaran }}" data-bs-metode2="{{ $client2->metodepembayaran2 }}" class="btn btn-warning struk text-white btn-sm" style="background-color: none">
                                            <i class="fa-sharp fa-solid fa-print"></i>&nbsp;Struk
                                        </button>
                                    @elseif ($client2->statusbayar == 'belum lunas')
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar" data-id="{{ $client2->id }}" data-napro="{{ $client2->napro }}" data-harga="{{ $client2->harga }}" data-tanggalpembayaran="{{ $client2->tanggalpembayaran }}" data-metodepembayaran="{{ $client2->metodepembayaran }}" data-biayatambahan="{{ $client2->biayatambahan }}" class="btn btn-primary btn-bayar btn-sm" style="background-color: none">
                                            <i class="fa-solid fa-wallet"></i>&nbsp;Bayar
                                        </button>
                                    @elseif ($client2->statusbayar == 'pembayaran akhir' || $client2->statusbayar == 'pembayaran revisi')
                                        <i class="fa-solid fa-hourglass fs-5 text-warning-emphasis"></i>
                                    @endif
                                    </td>
                            </tr>
                            @elseif ($client2->status == 'refund pending')
                                <tr id="employee_ids{{ $client2->id }}">
                                    <td>
                                        <div class="form-check">
                                            @if ($client2->status === 'refund pending')
                                                <input class="form-check-input checkbox_ids" type="checkbox" name="ids" value="{{ $client2->id }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $client2->napro }}</td>
                                    <td>Rp.{{ number_format($client2->harga, 0, ',', '.') }}</td>
                                    <td class="text-center"><span class="badge bg-primary">refund</span></td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailRefund{{ $client2->id }}"><i class="fa-solid fa-eye"></i> Detail</button></td>
                                </tr>
                                {{-- Modal Detail Refund --}}
                                <div class="modal fade" id="detailRefund{{ $client2->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="width:26em">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="modalTitleId">Detail Refund</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="mb-3">Biaya Refund : {{ number_format($client2->harga/2, 0, ',', '.') }}</h6>
                                                <div class="mb-3 d-flex justify-content-between">
                                                    <div style="width:11em">
                                                        <label for="metodeRefund" class="form-label">Metode Pembayaran</label>
                                                        <input type="text" id="metodeRefund" class="form-control" value="{{ $client2->metodeRefund }}" disabled>
                                                    </div>
                                                    <div style="width:11em">
                                                        <label for="layananRefund" class="form-label">Layanan</label>
                                                        <input type="text" id="layananRefund" class="form-control" value="{{ $client2->layananRefund }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="wrapper">
                                                    <label class="mb-1">Bukti Refund</label>
                                                    <img src="{{ asset('gambar/bukti/'.$client2->buktiRefund) }}" alt="" class="w-100">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach

                            @if ($bayar2->isEmpty())
                            <tr>
                                <td class="text-center" colspan="5"><i class="fa-solid fa-empty"></i> Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

    </script>

{{-- modal pembayaran akhir --}}
    <div class="modal fade" id="Modalbayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                <div class="modal-header" style="border: none;">
                    <div class="wrapper d-flex align-items-center">
                        <img id="profile-image" style="width:4em" class="me-3" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalToggleLabel">Pembayaran Akhir</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0">
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                        <h6>Nama Project</h6>
                        <input type="text" name="namaProject" class="form-control w-50 border-0" style="font-style: ubuntu;" id="namaProject" disabled>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                        <h6>Harga Project</h6>
                        <input type="text" name="hargaProject" class="form-control w-50 border-0" style="font-style: ubuntu;" id="hargaProject"  disabled>
                    </div>
                    <input type="hidden" id="projectIdCash">
                    <br>
                </div>
                <div class="modal-footer border-0 d-flex flex-colum justify-content-center">
                    <button class="btn btn-primary w-75 mb-2 fw-bold pilih-metode" data-bs-target="#bayar1" data-bs-toggle="modal" style="border-radius: 33px; font-family: 'Ubuntu';">Pilih Metode Pembayaran</button>
                    <a href="#" class="link-offset-2 link-underline bayar-awal link-underline-opacity-0 " data-bs-target="#modalawal" data-bs-toggle="modal">Lihat Pembayaran Awal</a>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir pembayaran akhir --}}


{{-- modal pembayaran akhir --}}
    <div class="modal fade" id="Modalbayar2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                <div class="modal-header" style="border: none;">
                    <div class="wrapper d-flex align-items-center">
                        <img id="profile-image" style="width:4em" class="me-3" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalToggleLabel">Pembayaran Tambahan</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0">
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                        <h6>Nama Project</h6>
                        <input type="text" name="namaProject" class="form-control w-50 border-0" style="font-style: ubuntu;" id="name" disabled>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                        <h6>Harga Tambahan</h6>
                        <input type="text" name="hargaProject" class="form-control w-50 border-0" style="font-style: ubuntu;" id="hargarevisi"  disabled>
                    </div>
                    <input type="hidden" id="projectIdrevisi">
                    <br>
                </div>
                <div class="modal-footer border-0 d-flex flex-colum justify-content-center">
                    <button class="btn btn-primary w-75 mb-2 fw-bold pilih-revisi" data-bs-target="#bayar3" data-bs-toggle="modal" style="border-radius: 33px; font-family: 'Ubuntu';">Pilih Metode Pembayaran</button>
                    <a href="#" class="link-offset-2 link-underline bayar-belumnya link-underline-opacity-0 " data-bs-target="#modalawal2" data-bs-toggle="modal">Lihat Pembayaran Sebelumnya</a>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir pembayaran akhir --}}

    {{-- Modal detail pembayaran awal --}}
    <div class="modal fade" id="modalawal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1 " tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                <div class="modal-header" style="border: none;">
                    <div class="wrapper d-flex align-items-center">
                        <img id="profile-image" style="width:4em" class="me-3" src="{{ asset('ProjectManagement/dashmin/img/ikond.png') }}">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalToggleLabel">Pembayaran Awal</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 p-0 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                        <h6>Nama Project</h6>
                        <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="napro-awal" disabled>
                    </div>
                    <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                        <h6>Harga Project</h6>
                        <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="harga-pro" disabled>
                    </div>
                    <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                        <h6>Tanggal Bayar</h6>
                        <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="tgl-bayar" disabled>
                    </div>
                    <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                        <h6>Metode Pembayaran</h6>
                        <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="metodepembayaran" disabled>
                    </div>
                    <div class="modal-footer d-flex flex-column border-0">
                        <button class="btn btn-primary fw-bold w-75" data-bs-target="#bayar1" data-bs-toggle="modal" style="border-radius: 33px; font-family: 'Ubuntu';" disabled>Selesai</button>
                        <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar" data-bs-toggle="modal">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir code lihat pembayaran--}}

     {{-- Modal detail pembayaran awal --}}
<div class="modal fade" id="modalawal2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
            <div class="modal-header" style="border: none;">
                <div class="wrapper d-flex align-items-center">
                    <img id="profile-image" style="width:4em" class="me-3" src="{{ asset('ProjectManagement/dashmin/img/ikond.png') }}">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalToggleLabel">Pembayaran</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
            </div>
            <div class="modal-body border-0 p-0 d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Nama Project</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="napro-revisi" disabled>
                </div>
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Harga Project</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="harga-revisi" disabled>
                </div>
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Tanggal Bayar</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="tgl-bayarrevisi" disabled>
                </div>
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Metode Pembayaran</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="metodepembayaranrevisi" disabled>
                </div>
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Tanggal Bayar ke 2</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="tgl-bayarrevisi2" disabled>
                </div>
                <div class="d-flex justify-content-between mx-5 align-items-center mb-3">
                    <h6>Metode Pembayaran ke 2</h6>
                    <input type="text" class="form-control w-50 border-0" style="font-style: ubuntu;" id="metodepembayaranrevisi2" disabled>
                </div>
                <div class="modal-footer d-flex flex-column border-0">
                    <button class="btn btn-primary fw-bold w-75" data-bs-target="#bayar1" data-bs-toggle="modal" style="border-radius: 33px; font-family: 'Ubuntu';" disabled>Selesai</button>
                    <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar2" data-bs-toggle="modal">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>



    {{-- akhir code lihat pembayaran--}}


    {{-- struk pembayaran start --}}
    <div class="modal fade" id="struk" tabindex="-1" aria-hidden="true">
        <div class="myModal">
        <div class="modal-dialog modal-dialog-centered" style="width: 22em">
        <div class="modal-content">
            <div class="modal-header p-2">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex mt-0 pt-0 justify-content-center">
                    <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/success.png') }}" alt="">
                </div>
                <p class="text-center mt-3">Pembayaran Berhasil!</p>
                <h4 class="fw-bold text-center mt-1 border-bottom border-dark pb-2" id="napro-awall"></h4>
                <div class="d-flex justify-content-between">
                    <div class="d-grid">
                        <p class="text-center">Pembayaran Awal</p>
                        <p class="fw-bold text-center pembayaran-awal"></p>
                    </div>
                    <div class="d-grid">
                        <p class="text-center">Pembayaran Akhir</p>
                        <p class="fw-bold text-center pembayaran-akhir"></p>
                    </div>
                </div>
                <div class="container m-0 p-0">
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fs-10">Tanggal Pembayaran Awal</p>
                    <p id="tgl-bayarr"></p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="text-secondary fs-10">Tanggal Pembayaran Akhir</p>
                    <p id="tgl-bayarr2"></p>
                </div>
                    <div class="d-flex pb-0 justify-content-between">
                        <p class="text-secondary fs-10">Metode Pembayaran Awal</p>
                        <p id="metodepembayarann"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Metode Pembayaran Akhir</p>
                        <p id="metodepembayarann2"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Biaya Tambahan</p>
                        <p id="pembayaran-tambahan"></p>
                    </div>
                            <div class="d-flex justify-content-between">
                                <p class="text-secondary fs-10">Total Bayar</p>
                                <p id="harga-proo"></p>
                            </div>
                </div>
            </div>
            <div class="modal-footer">
            <button id="printBtn" class="btn btn-primary w-100 fw-bold"><i class="fa-solid fa-print"></i> Cetak PDF</button>
            </div>
        </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <style>
            @media print {
                @page {
                    size: 100mm 168mm;
                    margin: 0;
                }
            }
        </style>
        <script>
            document.getElementById('printBtn').addEventListener('click', function() {
                window.print();
            });
            </script>
<script>
    $(document).ready(function() {
      $('#struk').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var nama = button.data('bs-nama');
        var harga = button.data('bs-harga');
        var biayatambahan = button.data('bs-biayatambahan');
        var tanggal = button.data('bs-tanggal');
        var tanggal2 = button.data('bs-tanggal2');
        var metode = button.data('bs-metode');
        var metode2 = button.data('bs-metode2');

        var formattedTanggal = moment(tanggal).format('DD-MM-YYYY');
        var formattedTanggal2 = moment(tanggal2).format('DD-MM-YYYY');

        var hargaSetengah = harga / 2;
        var hargatotal = parseFloat(harga) + parseFloat(biayatambahan);

        var namaElem = $('#napro-awall');
        var tanggalElem = $('#tgl-bayarr');
        var tanggal2Elem = $('#tgl-bayarr2');
        var metodeElem = $('#metodepembayarann');
        var metode2Elem = $('#metodepembayarann2');
        var hargaElem = $('#harga-proo');
        var hargatotalElem = $('#harga-total');
        var pembayaranAwalElem = $('.pembayaran-awal');
        var pembayaranAkhirElem = $('.pembayaran-akhir');
        var biayatambahanElem = $('#pembayaran-tambahan');

        var formatter = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0
        });

        namaElem.text(nama);
        tanggalElem.text(formattedTanggal);
        tanggal2Elem.text(formattedTanggal2);
        metodeElem.text(metode);
        metode2Elem.text(metode2);

        hargaElem.text(formatter.format(harga));
        pembayaranAwalElem.text(formatter.format(hargaSetengah));
        pembayaranAkhirElem.text(formatter.format(hargaSetengah));

        if (biayatambahan) {
          biayatambahanElem.text(formatter.format(biayatambahan));
        } else {
          biayatambahanElem.text("Rp 0");
        }

        hargatotalElem.text(formatter.format(hargatotal));
      });
    });
    </script>

    </div>
    </div>


     <div class="modal fade" id="struk2" tabindex="-1" aria-hidden="true">
        <div class="myModal">
        <div class="modal-dialog modal-dialog-centered" style="width: 22em">
        <div class="modal-content">
            <div class="modal-header p-2">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex mt-0 pt-0 justify-content-center">
                    <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/success.png') }}" alt="">
                </div>
                <p class="text-center mt-3">Pembayaran Berhasil!</p>
                <h4 class="fw-bold text-center mt-1 border-bottom border-dark pb-2" id="napro-awall1"></h4>
                <div class="d-flex justify-content-between">
                <div class="d-grid">
                    <p class="text-center">Pembayaran Awal</p>
                    <p class="fw-bold text-center pembayaran-awal1"></p>
                </div>
                <div class="d-grid">
                    <p class="text-center">Pembayaran Akhir</p>
                    <p class="fw-bold text-center pembayaran-akhir1"></p>
                </div>
                </div>
                <div class="container m-0 p-0">
                <div class="d-flex justify-content-between">
                    <p class="text-secondary fs-10">Tanggal Pembayaran Awal</p>
                    <p id="tgl-bayarr1"></p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="text-secondary fs-10">Tanggal Pembayaran Akhir</p>
                    <p id="tgl-bayarr21"></p>
                </div>
                    <div class="d-flex pb-0 justify-content-between">
                        <p class="text-secondary fs-10">Metode Pembayaran Awal</p>
                        <p id="metodepembayarann1"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Metode Pembayaran Akhir</p>
                        <p id="metodepembayarann21"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Biaya Tambahan</p>
                        <p id="pembayaran-tambahan1"></p>
                    </div>
                            <div class="d-flex justify-content-between">
                                <p class="text-secondary fs-10">Total Bayar</p>
                                <p id="harga-total1"></p>
                            </div>
                </div>
            </div>
            <div class="modal-footer">
            <button id="printButton" class="btn btn-primary w-100 fw-bold"><i class="fa-solid fa-print"></i> Cetak PDF</button>
        <script>
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
            </script>
            </div>
        </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

        <script>
            $(document).ready(function() {
              $('#struk2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var nama = button.data('bs-nama');
                var harga = button.data('bs-harga');
                var biayatambahan = button.data('bs-biayatambahan');
                var tanggal = button.data('bs-tanggal');
                var tanggal2 = button.data('bs-tanggal2');
                var metode = button.data('bs-metode');
                var metode2 = button.data('bs-metode2');

                var formattedTanggal = moment(tanggal).format('DD-MM-YYYY');
                var formattedTanggal2 = moment(tanggal2).format('DD-MM-YYYY');

                var hargaSetengah = harga / 2;
                var hargatotal = parseFloat(harga) + parseFloat(biayatambahan);

                var namaElem = $('#napro-awall1');
                var tanggalElem = $('#tgl-bayarr1');
                var tanggal2Elem = $('#tgl-bayarr21');
                var metodeElem = $('#metodepembayarann1');
                var metode2Elem = $('#metodepembayarann21');
                var hargaElem = $('#harga-proo1');
                var hargatotalElem = $('#harga-total1');
                var pembayaranAwalElem = $('.pembayaran-awal1');
                var pembayaranAkhirElem = $('.pembayaran-akhir1');
                var biayatambahanElem = $('#pembayaran-tambahan1');

                var formatter = new Intl.NumberFormat('id-ID', {
                  style: 'currency',
                  currency: 'IDR',
                  minimumFractionDigits: 0
                });

                namaElem.text(nama);
                tanggalElem.text(formattedTanggal);
                tanggal2Elem.text(formattedTanggal2);
                metodeElem.text(metode);
                metode2Elem.text(metode2);

                hargaElem.text(formatter.format(harga));
                pembayaranAwalElem.text(formatter.format(hargaSetengah));
                pembayaranAkhirElem.text(formatter.format(hargaSetengah));

                biayatambahanElem.text(formatter.format(biayatambahan));
                hargatotalElem.text(formatter.format(hargatotal));
              });
            });
            </script>

    </div>
    </div>



    {{-- modal pembayaran --}}
    <div class="modal fade" id="bayar1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                <div class="modal-header d-flex flex-column align-items-start">
                    <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian Pembayaran</h6>
                    <div class="wrapper d-flex justify-content-between w-100">
                        <div class="d-flex justify-content-start flex-column mt-2">
                            <h6 class="ms-2" style="font-size: 1em">Nama Project</h6>
                            <input type="text" class="form-control" style="width: 14em; border: none; font-family: ubuntu;" id="namaProjectCash" disabled>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            <h6 class="ms-2" style="font-size: 1em">Harga Project</h6>
                            <input type="text" class="form-control" style="width: 14em; border: none; font-family: ubuntu;" id="hargaProjectCash" disabled>
                        </div>
                    </div>
                </div>
                <form id="updateForm" action="{{ route('update-status-bayarakhir', '') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="projectId">
                    <div class="modal-body" style="border: none;">
                        <div class="containerd-flex justify-content-between" style="display: flex; align-items: center;">
                            <div class="d-grid">
                                <h6 style="align-self: center; font-size: 16px;">Metode</h6>
                                <select class="form-select form-select-lg mb-3" name="metodepembayaran2" style="width: 200px; height: 40px; font-size: 16px;" aria-label=".form-select-lg example" id="selectMetode">
                                    <option selected class="dropdown-menu" disabled>Pilih Pembayaran</option>
                                    <option value="cash">Cash</option>
                                    <option value="ewallet">E-Wallet</option>
                                    <option value="bank">Bank</option>
                                </select>
                                <div id="additionalSelectContainer"></div>
                            </div>
                            <div class="w-50" style="flex-direction: row-reverse;">
                                <div id="imageContainer"></div>
                            </div>
                        </div><br>
                        <div class="mb-3 bg-primary" style="margin-top:3%;">
                            <div id="fileInputContainer"></div>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer d-flex flex-column justify-content-center border-0">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary fw-bold w-75" style="border-radius: 33px; font-family: 'Ubuntu';">Bayar Sekarang</button>
                        <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" <Kembali href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar" data-bs-toggle="modal">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


     {{-- modal pembayaran 2 --}}
{{-- modal pembayaran 2 --}}
<div class="modal fade" id="bayar3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
            <div class="modal-header d-flex flex-column align-items-start">
                <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian Pembayaran</h6>
                <div class="wrapper d-flex justify-content-between w-100">
                    <div class="d-flex justify-content-start flex-column mt-2">
                        <h6 class="ms-2" style="font-size: 1em">Nama Project</h6>
                        <input type="text" class="form-control" style="width: 14em; border: none; font-family: ubuntu;" id="namaprojek" disabled>
                    </div>
                    <div class="d-flex flex-column mt-2">
                        <h6 class="ms-2" style="font-size: 1em">Biaya Tambahan</h6>
                        <input type="text" class="form-control" style="width: 14em; border: none; font-family: ubuntu;" id="hargaprojek" disabled>
                    </div>
                </div>
            </div>
            <form id="updateForm2" action="{{ route('update-status-bayarrevisi', '') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="projectId">
                <div class="modal-body" style="border: none;">
                    <div class="containerd-flex justify-content-between" style="display: flex; align-items: center;">
                        <div class="d-grid">
                            <h6 style="align-self: center; font-size: 16px;">Metode</h6>
                            <select class="form-select form-select-lg mb-3" name="metodepembayaran3" style="width: 200px; height: 40px; font-size: 16px;" aria-label=".form-select-lg example" id="selectMetode2">
                                <option selected class="dropdown-menu" disabled>Pilih Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="ewallet">E-Wallet</option>
                                <option value="bank">Bank</option>
                            </select>
                            <div id="additionalSelectContainer2"></div>
                        </div>
                        <div class="w-50" style="flex-direction: row-reverse;">
                            <div id="imageContainer2"></div>
                        </div>
                    </div><br>
                    <div class="mb-3" style="margin-top:3%;">
                        <div id="fileInputContainer2"></div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer d-flex flex-column justify-content-center border-0">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary fw-bold w-75" style="border-radius: 33px; font-family: 'Ubuntu';">Bayar Sekarang</button>
                    <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar2" data-bs-toggle="modal">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const selectMetode2 = document.getElementById('selectMetode2');
    const additionalSelectContainer2 = document.getElementById('additionalSelectContainer2');
    const fileInputContainer2 = document.getElementById('fileInputContainer2');

    selectMetode2.addEventListener('change', function () {
        const selectedValue = this.value;

        additionalSelectContainer2.innerHTML = '';
        fileInputContainer2.innerHTML = '';

        if (selectedValue === 'ewallet') {
            const layananLabel = document.createElement('label');
            layananLabel.textContent = 'Layanan';

            const layananSelect = document.createElement('select');
            layananSelect.className = 'form-select form-select-lg mb-3';
            layananSelect.name = 'metode3';
            layananSelect.style.width = '200px';
            layananSelect.style.height = '40px';
            layananSelect.style.fontSize = '16px';
            layananSelect.innerHTML = `
                <option selected class="dropdown-menu" name="layanan" disabled>Pilih E-Wallet</option>
                <option value="dana">DANA</option>
                <option value="ovo">OVO</option>
                <option value="gopay">GoPay</option>
                <option value="linkaja">LinkAja</option>
            `;

            additionalSelectContainer2.appendChild(layananLabel);
            additionalSelectContainer2.appendChild(layananSelect);


            const fileInputLabel = document.createElement('label');
            fileInputLabel.textContent = 'Bukti Pembayaran';
            fileInputLabel.style.position = 'absolute';
            fileInputLabel.style.marginTop = '-40px';
            fileInputLabel.style.marginLeft = '3px';



            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'buktipembayaran3';
            fileInput.className = 'form-control';
            fileInput.style.border = 'none';
            fileInput.style.fontFamily = 'ubuntu';
            fileInput.style.height = '40px';
            fileInput.style.width = '200px';
            fileInput.style.position = 'absolute';
            fileInput.style.marginTop = '-20px';
            fileInput.style.marginLeft = '3px';
            fileInput.setAttribute('required', true);

            fileInputContainer2.appendChild(fileInputLabel);
            fileInputContainer2.appendChild(fileInput);

            const imageContainer = document.createElement('div');
            imageContainer.id = 'imageContainer2';

            additionalSelectContainer2.appendChild(imageContainer);

            layananSelect.addEventListener('change', function () {
                const selectedLayanan = this.value;
                const imageContainer = document.getElementById('imageContainer2');

                imageContainer.innerHTML = '';

                if (selectedLayanan === 'dana') {
                    const imageFilename = '{{ $dana->qrcode }}';

                    const imageUrl = 'gambar/qr/' + imageFilename;

                    const imageElement = document.createElement('img');
                    imageElement.style.width = '200px';
                    imageElement.style.height = '200px';
                    imageElement.src = imageUrl;

                    imageElement.style.position = 'absolute';
                    imageElement.style.top = '35px';
                    imageElement.style.right = '35px';

                    imageContainer.appendChild(imageElement);
                }

                if (selectedLayanan === 'ovo') {
                    const imageFilename = 'ovo.png';

                    const imageUrl = 'gambar/qr/' + imageFilename;

                    const imageElement = document.createElement('img');
                    imageElement.style.width = '200px';
                    imageElement.style.height = '200px';
                    imageElement.src = imageUrl;

                    imageElement.style.position = 'absolute';
                    imageElement.style.top = '35px';
                    imageElement.style.right = '35px';


                    imageContainer.appendChild(imageElement);
                }

                if (selectedLayanan === 'gopay') {
                    const imageFilename = 'gopay.png';

                    const imageUrl = 'gambar/qr/' + imageFilename;

                    const imageElement = document.createElement('img');
                    imageElement.style.width = '200px';
                    imageElement.style.height = '200px';
                    imageElement.src = imageUrl;

                    imageElement.style.position = 'absolute';
                    imageElement.style.top = '35px';
                    imageElement.style.right = '35px';


                    imageContainer.appendChild(imageElement);
                }

                if (selectedLayanan === 'linkaja') {
                    const imageFilename = 'linkaja.png';

                    const imageUrl = 'gambar/qr/' + imageFilename;

                    const imageElement = document.createElement('img');
                    imageElement.style.width = '200px';
                    imageElement.style.height = '200px';
                    imageElement.src = imageUrl;

                    imageElement.style.position = 'absolute';
                    imageElement.style.top = '35px';
                    imageElement.style.right = '35px';


                    imageContainer.appendChild(imageElement);
                }
            });
        } else if (selectedValue === 'bank') {
            const bankLabel = document.createElement('label');
            bankLabel.textContent = 'Bank';

            const bankSelect = document.createElement('select');
            bankSelect.className = 'form-select form-select-lg mb-3';
            bankSelect.name = 'metode3';
            bankSelect.style.width = '200px';
            bankSelect.style.height = '40px';
            bankSelect.style.fontSize = '16px';
            bankSelect.innerHTML = `
                <option selected class="dropdown-menu" name="bank" disabled>Pilih Bank</option>
                <option value="Bank BRI">Bank BRI</option>
                <option value="Bank BCA">Bank BCA</option>
                <option value="Bank Mandiri">Bank Mandiri</option>
            `;

            const fileInputLabel = document.createElement('label');
            fileInputLabel.textContent = 'Bukti Pembayaran';
            fileInputLabel.style.textAlign = 'center';
            fileInputLabel.style.marginBottom = '5px';
            fileInputLabel.style.position = 'relative';
            fileInputLabel.style.top = '-120px';
            fileInputLabel.style.right = '-265px';

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'buktipembayaran3';
            fileInput.className = 'form-control';
            fileInput.style.border = 'none';
            fileInput.style.fontFamily = 'ubuntu';
            fileInput.style.height = '1%';
            fileInput.style.width = '43%';
            fileInput.style.marginTop = '-120px';
            fileInput.style.marginLeft = 'auto';
            fileInput.style.marginRight = '3px';
            fileInput.setAttribute('required', true);


            const inputBankLabel = document.createElement('label');
            inputBankLabel.textContent = 'No.Rekening';
            inputBankLabel.style.textAlign = 'center';
            inputBankLabel.style.marginBottom = '5px';
            inputBankLabel.style.position = 'absolute';
            inputBankLabel.style.top = '16px';
            inputBankLabel.style.right = '130px';


            const inputBank = document.createElement('input');
            inputBank.type = 'text';
            inputBank.name = 'rekening';
            inputBank.className = 'form-control';
            inputBank.style.border = 'none';
            inputBank.style.fontFamily = 'ubuntu';
            inputBank.style.height = '15%';
            inputBank.style.width = '40%';
            inputBank.style.position = 'absolute';
            inputBank.style.right = '22px';
            inputBank.style.marginTop = '-137px';
            inputBank.setAttribute('required', true);
            inputBank.setAttribute('disabled', true);

            additionalSelectContainer2.appendChild(bankLabel);
            additionalSelectContainer2.appendChild(bankSelect);
            additionalSelectContainer2.appendChild(inputBankLabel);
            additionalSelectContainer2.appendChild(inputBank);
            fileInputContainer2.appendChild(fileInputLabel);
            fileInputContainer2.appendChild(fileInput);


            bankSelect.addEventListener('change', function () {
                const selectedBank = this.value;
                console.log(selectedBank)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/ambilrek',
                    method: 'POST',
                    data: { id: selectedBank },
                    success: function(response) {
                        console.log(response)
                        const rekening = response;

                        inputBank.value = rekening;
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        } else if (selectedValue === 'cash') {
            const datetimeLabel = document.createElement('label');
            datetimeLabel.textContent = 'Tanggal Bayar';
            datetimeLabel.style.textAlign = 'center';
            datetimeLabel.style.marginBottom = '5px';
            datetimeLabel.style.position = 'absolute';
            datetimeLabel.style.top = '16px';
            datetimeLabel.style.right = '148px';

            const datetimeInput = document.createElement('input');
            datetimeInput.type = 'datetime-local';
            datetimeInput.name = 'tanggalpembayaran3';
            datetimeInput.className = 'form-control';
            datetimeInput.style.width = '200px';
            datetimeInput.style.height = '40px';
            datetimeInput.style.position = 'absolute';
            datetimeInput.style.right = '45px';
            datetimeInput.style.marginTop = '-56px';
            datetimeInput.style.fontSize = '16px';
            datetimeInput.setAttribute('required', true);

            additionalSelectContainer2.appendChild(datetimeLabel);
            additionalSelectContainer2.appendChild(datetimeInput);
        }
    });
</script>

{{-- akhir --}}

    <script>
function formatHarga(harga) {
  return 'Rp ' + harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

$(document).ready(function() {
$('.btn-revisi').click(function() {
    var napro = $(this).data('napro');
    var harga = $(this).data('harga');
    var biayatambahan = $(this).data('biayatambahan');
    var tglBayar = $(this).data('tanggalpembayaran');
    var metodepembayaran = $(this).data('metodepembayaran');
    var tglBayar2 = $(this).data('tanggalpembayaran2');
    var metodepembayaran2 = $(this).data('metodepembayaran2');
    var projectId = $(this).data('id');

    var setengahHarga = harga / 2;
    var hargaFormatted = formatHarga(harga);
    var hargaFormatted2 = formatHarga(biayatambahan);

    $('#name').val(napro);
    $('#harga-revisi').val(hargaFormatted);
    $('#hargarevisi').val(hargaFormatted2);
    $('#tgl-bayar').val(tglBayar);
    $('#metodepembayaran').val(metodepembayaran);
    $('#tgl-bayarrevisi2').val(tglBayar2);
    $('#metodepembayaranrevisi2').val(metodepembayaran2);
    $('#projectIdrevisi').val(projectId);
    $('#Modalbayar3').modal('show');
});

$('.bayar-belumnya').click(function() {
    var napro = $('#name').val();
    var harga = $('#harga-revisi').val();
    var tglBayar = $('#tgl-bayar').val();
    var metodepembayaran = $('#metodepembayaran').val();
    var tglBayar2 = $('#tgl-bayarrevisi2').val();
    var metodepembayaran2 = $('#metodepembayaranrevisi2').val();

    $('#napro-revisi').val(napro);
    $('#harga-revisi').val(harga);
    $('#tgl-bayarrevisi').val(tglBayar);
    $('#metodepembayaranrevisi').val(metodepembayaran);
    $('#tgl-bayarrevisi2').val(tglBayar2);
    $('#metodepembayaranrevisi2').val(metodepembayaran2);
    $('#modalawal2').modal('show');
});

$('#bayar3').on('shown.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var projectId = button.data('id');
    var napro = $('#name').val();
    var harga = $('#hargarevisi').val();
    var projectId = $('#projectIdrevisi').val();

    $('#namaprojek').val(napro);
    $('#hargaprojek').val(harga);

    var form = $('#updateForm2');
    var action = form.attr('action');
    action = action.replace(/\/\d+$/, "");
    form.attr('action', action + '/' + projectId);
});

        $('#updateForm2').on('submit', function(event) {
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


    $('.btn-bayar').click(function() {
        var napro = $(this).data('napro');
        var harga = $(this).data('harga');
        var tglBayar = $(this).data('tanggalpembayaran');
        var metodepembayaran = $(this).data('metodepembayaran');
        var projectId = $(this).data('id');

        var setengahHarga = harga / 2;
        var hargaFormatted3 = formatHarga(setengahHarga);

        $('#namaProject').val(napro);
        $('#hargaProject').val(hargaFormatted3);
        $('#tgl-bayar').val(tglBayar);
        $('#metodepembayaran').val(metodepembayaran);
        $('#projectIdCash').val(projectId);
        $('#Modalbayar').modal('show');
    });

    $('.bayar-awal').click(function() {
        var napro = $('#namaProject').val();
        var harga = $('#hargaProject').val();

        var setengahHarga = harga / 2;

        $('#napro-awal').val(napro);
        $('#harga-pro').val(harga);
        $('#tgl-bayar').val(tglBayar);
        $('#metodepembayaran').val(metodepembayaran);
        $('#modalawal').modal('show');
    });

    $('#bayar1').on('shown.bs.modal', function (event){
        var button = $(event.relatedTarget);
        var projectId = button.data('id');
        var napro = $('#namaProject').val();
        var harga = $('#hargaProject').val();
        var projectId = $('#projectIdCash').val();

        $('#namaProjectCash').val(napro);
        $('#hargaProjectCash').val(harga);

        var form = $('#updateForm');
        var action = form.attr('action');
        action = action.replace(/\/\d+$/, "");
        form.attr('action', action + '/' + projectId);
    });
        $('#updateForm').on('submit', function(event) {
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

        <script>
        const selectMetode = document.getElementById('selectMetode');
        const additionalSelectContainer = document.getElementById('additionalSelectContainer');
        const fileInputContainer = document.getElementById('fileInputContainer');

        selectMetode.addEventListener('change', function () {
        const selectedValue = this.value;

        additionalSelectContainer.innerHTML = '';
        fileInputContainer.innerHTML = '';

        if (selectedValue === 'ewallet') {
            const layananLabel = document.createElement('label');
            layananLabel.textContent = 'Layanan';

            const layananSelect = document.createElement('select');
            layananSelect.className = 'form-select form-select-lg mb-3';
            layananSelect.name = 'metode2';
            layananSelect.style.width = '200px';
            layananSelect.style.height = '40px';
            layananSelect.style.fontSize = '16px';
            layananSelect.innerHTML = `
            <option selected class="dropdown-menu" name="layanan" disabled>Pilih E-Wallet</option>
            <option value="dana">DANA</option>
            <option value="ovo">OVO</option>
            <option value="gopay">GoPay</option>
            <option value="linkaja">LinkAja</option>
            `;

            additionalSelectContainer.appendChild(layananLabel);
            additionalSelectContainer.appendChild(layananSelect);

            const fileInputLabel = document.createElement('label');
            fileInputLabel.textContent = 'Bukti Pembayaran';

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'buktipembayaran2';
            fileInput.className = 'form-control';
            fileInput.style.border = 'none';
            fileInput.style.fontFamily = 'ubuntu';
            fileInput.style.height = '40px';
            fileInput.style.width = '200px';
            fileInputLabel.style.marginLeft = '-15px';
            fileInput.style.marginLeft = '-15px';
            fileInput.setAttribute('required', true);

            fileInputContainer.appendChild(fileInputLabel);
            fileInputContainer.appendChild(fileInput);

            const imageContainer = document.createElement('div');
            imageContainer.id = 'imageContainer';
            additionalSelectContainer.appendChild(imageContainer);

            layananSelect.addEventListener('change', function () {
            const selectedLayanan = this.value;
            const imageContainer = document.getElementById('imageContainer');

            imageContainer.innerHTML = '';

            if (selectedLayanan === 'dana') {
                const imageFilename =`{{ $dana->qrcode }}`;

                const imageUrl = 'gambar/qr/' + imageFilename;

                const imageElement = document.createElement('img');
                imageElement.style.width = '200px';
                imageElement.style.height = '200px';
                imageElement.src = imageUrl;

                imageContainer.appendChild(imageElement);
            }

            if (selectedLayanan === 'ovo') {
                const imageFilename = `{{ $ovo->qrcode }}`;

                const imageUrl = 'gambar/qr/' + imageFilename;

                const imageElement = document.createElement('img');
                imageElement.style.width = '200px';
                imageElement.style.height = '200px';
                imageElement.src = imageUrl;

                imageContainer.appendChild(imageElement);
            }

            if (selectedLayanan === 'gopay') {
                const imageFilename = `{{ $gopay->qrcode }}`;

                const imageUrl = 'gambar/qr/' + imageFilename;

                const imageElement = document.createElement('img');
                imageElement.style.width = '200px';
                imageElement.style.height = '200px';
                imageElement.src = imageUrl;

                imageContainer.appendChild(imageElement);
            }

            if (selectedLayanan === 'linkaja') {
                const imageFilename = `{{ $linkaja->qrcode }}`;

                const imageUrl = 'gambar/qr/' + imageFilename;

                const imageElement = document.createElement('img');
                imageElement.style.width = '200px';
                imageElement.style.height = '200px';
                imageElement.src = imageUrl;

                imageContainer.appendChild(imageElement);
            }
            });
        } else if (selectedValue === 'bank') {
            const bankLabel = document.createElement('label');
            bankLabel.textContent = 'Bank';

            const bankSelect = document.createElement('select');
            bankSelect.className = 'form-select form-select-lg mb-3';
            bankSelect.name = 'metode2';
            bankSelect.style.width = '200px';
            bankSelect.style.height = '40px';
            bankSelect.style.fontSize = '16px';
            bankSelect.innerHTML = `
            <option selected class="dropdown-menu" name="bank" disabled>Pilih Bank</option>
            <option value="Bank BRI">Bank BRI</option>
            <option value="Bank BCA">Bank BCA</option>
            <option value="Bank Mandiri">Bank Mandiri</option>
            `;

            const fileInputLabel = document.createElement('label');
            fileInputLabel.textContent = 'Bukti Pembayaran';
            fileInputLabel.style.textAlign = 'center';
            fileInputLabel.style.marginBottom = '5px';
            fileInputLabel.style.position = 'relative';
            fileInputLabel.style.top = '-75px';
            fileInputLabel.style.right = '-245px';

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'buktipembayaran2';
            fileInput.className = 'form-control';
            fileInput.style.border = 'none';
            fileInput.style.fontFamily = 'ubuntu';
            fileInput.style.height = '1%';
            fileInput.style.width = '170%';
            fileInput.style.marginTop = '-79px';
            fileInput.style.marginLeft = 'auto';
            fileInput.style.marginRight = '-330px';
            fileInput.setAttribute('required', true);


            const inputBankLabel = document.createElement('label');
            inputBankLabel.textContent = 'No.Rekening';
            inputBankLabel.style.textAlign = 'center';
            inputBankLabel.style.marginBottom = '5px';
            inputBankLabel.style.position = 'absolute';
            inputBankLabel.style.top = '16px';
            inputBankLabel.style.right = '130px';


            const inputBank = document.createElement('input');
            inputBank.type = 'text';
            inputBank.name = 'rekening';
            inputBank.className = 'form-control';
            inputBank.style.border = 'none';
            inputBank.style.fontFamily = 'ubuntu';
            inputBank.style.height = '15%';
            inputBank.style.width = '40%';
            inputBank.style.position = 'absolute';
            inputBank.style.right = '22px';
            inputBank.style.marginTop = '-137px';
            inputBank.setAttribute('required', true);
            inputBank.setAttribute('disabled', true);

            additionalSelectContainer.appendChild(bankLabel);
            additionalSelectContainer.appendChild(bankSelect);
            additionalSelectContainer.appendChild(inputBankLabel);
            additionalSelectContainer.appendChild(inputBank);
            fileInputContainer.appendChild(fileInputLabel);
            fileInputContainer.appendChild(fileInput);


            bankSelect.addEventListener('change', function () {
            const selectedBank = this.value;
            console.log(selectedBank)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/ambilrek',
                method: 'POST',
                data: { id: selectedBank },
                success: function(response) {
                    console.log(response)
                const rekening = response;

                inputBank.value = rekening;
                },
                error: function(error) {
                console.error('Error:', error);
                }
            });
            });
        }  else if (selectedValue === 'cash') {
    const datetimeLabel = document.createElement('label');
    datetimeLabel.textContent = 'Tanggal Bayar';
    datetimeLabel.style.textAlign = 'center';
    datetimeLabel.style.marginBottom = '5px';
    datetimeLabel.style.position = 'absolute';
    datetimeLabel.style.top = '16px';
    datetimeLabel.style.right = '148px';

    const datetimeInput = document.createElement('input');
    datetimeInput.type = 'datetime-local';
    datetimeInput.name = 'tanggalpembayaran2';
    datetimeInput.className = 'form-control';
    datetimeInput.style.width = '200px';
    datetimeInput.style.height = '40px';
    datetimeInput.style.position = 'absolute';
    datetimeInput.style.right = '45px';
    datetimeInput.style.marginTop = '-56px';
    datetimeInput.style.fontSize = '16px';
    datetimeInput.setAttribute('required', true);

    additionalSelectContainer.appendChild(datetimeLabel);
    additionalSelectContainer.appendChild(datetimeInput);
  }
        });
    </script>
        {{-- akhir metode pembayaran --}}




    {{-- Modal Struk Pembayaran --}}
       <style>
        @media print {
        .modal button {
            display: none;
        }
        .modal {
        background: none;
        box-shadow: none;
        }
        }
       </style>

<div class="d-flex justify-content-end">
    {{ $bayar2->links() }}
</div>
@include('Client.Template.footer')
        </div>
        <!-- Content End -->

@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
