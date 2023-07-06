 <!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')



</head>

<body>

    <style>
        #buttonContainer {
        display: none;
        margin-top: 10px;
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
            <form action="">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
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
        <div id="buttonContainer"></div>
    </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                    <input class="form-check-input master-checkbox" onchange="toggleCheckboxes(this)" type="checkbox" value="" id="myCheckbox">
                                    </div>
                                </th>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Harga Project</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bayar2 as $client2)
                            @if ( $client2->statusbayar === 'belum lunas' || $client2->statusbayar === 'lunas')
                            <tr>
                                <td><div class="form-check">
                                    <input class="form-check-input child-checkbox" type="checkbox" value="" id="myCheckbox">
                                </div></td>
                                <td>{{ $client2->napro }}</td>
                                <td>{{ $client2->harga }}</td>
                               
                                <td class="text-center ">
                                    @if ($client2->statusbayar == 'lunas')
                                      <span class="badge text-bg-success">{{ $client2->statusbayar }}</span>
                                    @elseif ($client2->statusbayar == 'belum lunas')
                                      <span class="badge text-bg-warning text-white">{{ $client2->statusbayar }}</span>
                                    @else
                                      <span class="badge">{{ $client2->statusbayar }}</span>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if ($client2->statusbayar == 'lunas')
                                      <button type="button" data-bs-toggle="modal" data-bs-target="#strukPembayaranModal" class="btn btn-warning text-white btn-sm" style="background-color: none">
                                        <i class="fa-sharp fa-solid fa-print"></i>&nbsp;Struk</button>
                                    @elseif ($client2->statusbayar == 'belum lunas')
                                      <button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar{{ $client2->id }}" class="btn btn-primary btn-sm" style="background-color: none">
                                        <i class="fa-solid fa-wallet"></i>&nbsp;Bayar</button>
                                    @endif
                                  </td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                        function toggleCheckboxes(masterCheckbox) {
                          var checkboxes = document.getElementsByClassName('child-checkbox');
                          for (var i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].checked = masterCheckbox.checked;
                          }
                        }
                      </script>
                    <script>
                        var checkbox = document.getElementById("myCheckbox");
                        var buttonContainer = document.getElementById("buttonContainer");

                        checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            buttonContainer.innerHTML = '<button type="button" class="btn btn-danger btn-sm">Delete All</button>';
                            buttonContainer.style.display = 'block';
                        } else {
                            buttonContainer.innerHTML = '';
                            buttonContainer.style.display = 'none';
                        }
                        });
                    </script>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mt-sm-3">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

{{-- modal pembayaran akhir --}}
    <div class="modal fade" id="Modalbayar{{ $client2->id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
           <div class="modal-header" style="border: none;">
               <img id="profile-image" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}" alt="" style="width:15%; height:15%; margin-top:1%;">
               <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
           </div>
           <div class="modal-body" style="border: none;">
               <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="font-weight: bold;">Pembayaran Akhir</h1><br>
                       <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
                           <h6 style="align-self: center;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->napro }}" disabled>
                       </div>
                       <div style="display: flex; justify-content: space-between;">
                           <h6>Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->harga }}" disabled>
                       </div>
               <br>
           </div>
           <center><button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Pilih Metode Pembayaran</button></center><br>
           <center><a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#modalawal" data-bs-toggle="modal">Lihat Pembayaran Awal</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
       {{-- akhir pembayaran akhir --}}

       {{-- Modal pembayaran awal --}}
    <div class="modal fade" id="modalawal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1 " tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
           <div class="modal-header" style="border: none;">
               <img id="profile-image" src="{{ asset('ProjectManagement/dashmin/img/ikond.png') }}" alt="" style="width:15%; height:15%; margin-top:1%;">
               <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
           </div>
           <div class="modal-body" style="border: none;">
               <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="font-weight: bold;">Pembayaran Awal</h1><br>
                       <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
                           <h6 style="align-self: center;">Nama Project:</h6>
                           <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->napro }}" disabled>
                       </div>
                       <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
                           <h6 style="align-self: center;">Harga Pembayaran:</h6>
                           <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->harga }}" disabled>
                       </div>
                       <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
                           <h6 style="align-self: center;">Tanggal Pembayaran:</h6>
                           <input type="datetime" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->tanggalpembayaran }}" disabled>
                       </div>
                       <div style="display: flex; justify-content: space-between;">
                           <h6>Metode Pembayaran:</h6>
                           <input type="text" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" value="{{ $client2->metode }}" disabled>
                       </div>
               <br>
           </div>
           <center><button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;" disabled>Selesai</button></center><br>
           <center><a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar" data-bs-toggle="modal">Kembali</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
{{-- akhir code lihat pembayaran--}}

{{-- modal metode pembayaran --}}
       <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered" >
        <form action="{{ route('update-status-bayarakhir', $data->first()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
               <div class="modal-header" >
                   <div style="display: flex; flex-direction: column;">
                       <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                       <div style="display: flex; align-items: center;">
                           <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="{{ $client2->napro }}" disabled>
                       </div>
                       <div style="display: flex; align-items: center; margin-top:3%;">
                           <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="{{ $client2->harga }}" disabled>
                       </div>
                   </div>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
               </div>
                <div class="modal-body" style="border: none;">
                    <div class="container m-0 p-0 d-flex justify-content-between">
                        <div class="d-grid" style="display: flex; justify-content: space-between;">
                            <h6 style="align-self: center; font-size: 16px;">Metode</h6>
                            <select class="form-select form-select-lg mb-3" name="metodepembayaran2" style="width: 200px; height: 40px; font-size: 16px;" aria-label=".form-select-lg example" id="selectMetode">
                                <option selected class="dropdown-menu" disabled>Pilih Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="ewallet">E-Wallet</option>
                                <option value="bank">Bank</option>
                            </select>
                        </div>
                    </div>
                    <div id="additionalSelectContainer"></div>
                    <div id="fileInputContainer"></div>
                    <div id="imageContainer"></div>
                    <br>
                </div>
           <center><button type="submit" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</button></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
          </form>
         </div>
       </div>
        <script>
    const selectMetode = document.getElementById('selectMetode');
    const additionalSelectContainer = document.getElementById('additionalSelectContainer');
    const fileInputContainer = document.getElementById('fileInputContainer');

    selectMetode.addEventListener('change', function () {
      const selectedValue = this.value;

      // Hapus select, input file, dan input text sebelumnya jika ada
      additionalSelectContainer.innerHTML = '';
      fileInputContainer.innerHTML = '';

      if (selectedValue === 'ewallet') {
        // Buat label "Layanan" baru
        const layananLabel = document.createElement('label');
        layananLabel.textContent = 'Layanan';

        // Buat select "Layanan" baru
        const layananSelect = document.createElement('select');
        layananSelect.className = 'form-select form-select-lg mb-3';
        layananSelect.name = 'metode2';
        layananSelect.style.width = '200px';
        layananSelect.style.height = '40px';
        layananSelect.style.fontSize = '16px';
        layananSelect.innerHTML = `
          <option selected class="dropdown-menu" name="layanan" disabled>Pilih E-Wallet</option>
          <option value="dana">Dana</option>
          <option value="ovo">Ovo</option>
          <option value="gopay">Gopay</option>
          <option value="linkaja">Linkaja</option>
        `;

        additionalSelectContainer.appendChild(layananLabel);
        additionalSelectContainer.appendChild(layananSelect);

        // Buat label "Upload Bukti Pembayaran" baru
        const fileInputLabel = document.createElement('label');
        fileInputLabel.textContent = 'Upload Bukti Pembayaran:';

        // Buat input file baru
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'buktipembayaran2';
        fileInput.className = 'form-control';
        fileInput.style.border = 'none';
        fileInput.style.fontFamily = 'ubuntu';
        fileInput.style.height = '1%';
        fileInput.style.width = '50%';
        fileInput.setAttribute('required', true);

        fileInputContainer.appendChild(fileInputLabel);
        fileInputContainer.appendChild(fileInput);

        // Tambahkan kode berikut untuk menampilkan gambar
        const imageContainer = document.createElement('div');
        imageContainer.id = 'imageContainer';
        additionalSelectContainer.appendChild(imageContainer);

        layananSelect.addEventListener('change', function () {
          const selectedLayanan = this.value;
          const imageContainer = document.getElementById('imageContainer');

          // Hapus gambar sebelumnya jika ada
          imageContainer.innerHTML = '';

          if (selectedLayanan === 'dana') {
            // Ambil nama file gambar dari database
            const imageFilename = 'dana.png';

            // Bangun URL gambar berdasarkan direktori gambar dan nama file gambar
            const imageUrl = 'gambar/qr/' + imageFilename;

            // Buat elemen <img> untuk menampilkan gambar
            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            // Tambahkan elemen <img> ke dalam container gambar
            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'ovo') {
            // Ambil nama file gambar dari database
            const imageFilename = 'ovo.png';

            // Bangun URL gambar berdasarkan direktori gambar dan nama file gambar
            const imageUrl = 'gambar/qr/' + imageFilename;

            // Buat elemen <img> untuk menampilkan gambar
            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            // Tambahkan elemen <img> ke dalam container gambar
            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'gopay') {
            // Ambil nama file gambar dari database
            const imageFilename = 'gopay.png';

            // Bangun URL gambar berdasarkan direktori gambar dan nama file gambar
            const imageUrl = 'gambar/qr/' + imageFilename;

            // Buat elemen <img> untuk menampilkan gambar
            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            // Tambahkan elemen <img> ke dalam container gambar
            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'linkaja') {
            // Ambil nama file gambar dari database
            const imageFilename = 'linkaja.png';

            // Bangun URL gambar berdasarkan direktori gambar dan nama file gambar
            const imageUrl = 'gambar/qr/' + imageFilename;

            // Buat elemen <img> untuk menampilkan gambar
            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            // Tambahkan elemen <img> ke dalam container gambar
            imageContainer.appendChild(imageElement);
          }
        });
      } else if (selectedValue === 'bank') {
        // Buat label "Bank" baru
        const bankLabel = document.createElement('label');
        bankLabel.textContent = 'Bank';

        // Buat select "Bank" baru
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

        // Buat label "Upload Bukti Pembayaran" baru
        const fileInputLabel = document.createElement('label');
        fileInputLabel.textContent = 'Upload Bukti Pembayaran:';

        // Buat input file baru
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'buktipembayaran2';
        fileInput.className = 'form-control';
        fileInput.style.border = 'none';
        fileInput.style.fontFamily = 'ubuntu';
        fileInput.style.height = '1%';
        fileInput.style.width = '50%';
        fileInput.setAttribute('required', true);

        // Buat label "Input Bank" baru
        const inputBankLabel = document.createElement('label');
        inputBankLabel.textContent = 'No.Rekening:';

        // Buat input teks baru untuk memasukkan nama bank
        const inputBank = document.createElement('input');
        inputBank.type = 'text';
        inputBank.name = 'rekening';
        inputBank.className = 'form-control';
        inputBank.style.border = 'none';
        inputBank.style.fontFamily = 'ubuntu';
        inputBank.style.height = '1%';
        inputBank.style.width = '50%';
        inputBank.setAttribute('required', true);

        additionalSelectContainer.appendChild(bankLabel);
        additionalSelectContainer.appendChild(bankSelect);
        additionalSelectContainer.appendChild(inputBankLabel);
        additionalSelectContainer.appendChild(inputBank);
        fileInputContainer.appendChild(fileInputLabel);
        fileInputContainer.appendChild(fileInput);

// Menambahkan event listener ke select "Pilih Bank"
bankSelect.addEventListener('change', function () {
  const selectedBank = this.value;
console.log(selectedBank)
  // Menggunakan jQuery untuk mengambil data rekening dari database
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

      // Menampilkan data rekening ke dalam input "No.Rekening"
      inputBank.value = rekening;
    },
    error: function(error) {
      console.error('Error:', error);
    }
  });
});


        
      }
    });
  </script>
       {{-- akhir metode pembayaran --}}


{{-- modal rincian pembayaran cash --}}
   <div class="modal fade" id="cash" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
               <div class="modal-header" >
                   <div style="display: flex; flex-direction: column;">
                       <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                       <div style="display: flex; align-items: center;">
                           <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                       </div>
                       <div style="display: flex; align-items: center; margin-top:3%;">
                           <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                       </div>
                   </div>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
               </div>
               <div class="modal-body" style="border: none;">
                   <div class="container m-0 p-0 d-flex justify-content-between">
                       <div class="d-grid" style="display: flex; justify-content: space-between;">
                           <h6 style="align-self: center;">Metode</h6>
                           <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   Cash &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                               </button>
                               <ul class="dropdown-menu">
                                   <li><a class="dropdown-item active" href="#">Cash</a></li>
                                   <li><a class="dropdown-item" href="#" data-bs-target="#wallet" data-bs-toggle="modal">E-Wallet</a></li>
                                   <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                               </ul>
                           </div>
                       </div>
                       <div class="mb-7">
                           <h6 style="">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" value="2.000.000" disabled>
                       </div>
                   </div>
               <br>
           </div>
           <center><a href="{{ route('bayar2client') }}" class="btn btn-primary" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
       {{-- akhir rinci pembayaran --}}

{{-- modal rincian pembayaran ewallet --}}
   <div class="modal fade" id="wallet" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
               <div class="modal-header" >
                   <div style="display: flex; flex-direction: column;">
                       <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                       <div style="display: flex; align-items: center;">
                           <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                       </div>
                       <div style="display: flex; align-items: center; margin-top:3%;">
                           <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                       </div>
                   </div>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
               </div>
               <div class="modal-body" style="border: none;">
                   <div class="container m-0 p-0 d-flex justify-content-between">
                       <div class="d-grid" style="display: flex; justify-content: space-between;">
                           <h6 style="align-self: center;">Metode</h6>
                           <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                               </button>
                               <ul class="dropdown-menu">
                                   <li><a class="dropdown-item" href="#" data-bs-target="#cash" data-bs-toggle="modal">Cash</a></li>
                                   <li><a class="dropdown-item active" href="#">E-Wallet</a></li>
                                   <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>

                       <div class="d-grid" style="display: flex; justify-content: space-between; margin-top:3%;">
                           <h6 style="align-self: center;">Layanan</h6>
                           <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   Pilih E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                               </button>
                               <ul class="dropdown-menu">
                                   <li><a class="dropdown-item" href="#" data-bs-target="#dana" data-bs-toggle="modal" >Dana</a></li>
                                   <li><a class="dropdown-item " href="#">Ovo</a></li>
                                   <li><a class="dropdown-item" href="#">Gopay</a></li>
                                   <li><a class="dropdown-item" href="#">LinkAja</a></li>
                               </ul>
                           </div>
                       </div>

                       <div class="mb-3" style="margin-top:3%; width:110%;">
                           <h6 style="align-self: center;">Bukti Pembayaran</h6>
                           <input class="form-control" type="file" id="formFile" style="width: 35%">
                       </div>
           </div>
           <center><a href="{{ route('bayar2client') }}" class="btn btn-primary"  style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
       {{-- akhir rincian pembayaran ewallet --}}


       {{-- modal rincian pembayaran ewallet bukti pembayaran --}}
        <div class="modal fade" id="dana" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
               <div class="modal-header" >
                   <div style="display: flex; flex-direction: column;">
                       <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                       <div style="display: flex; align-items: center;">
                           <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                       </div>
                       <div style="display: flex; align-items: center; margin-top:3%;">
                           <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                       </div>
                   </div>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
               </div>
               <div class="modal-body" style="border: none;">
                   <div class="mb-3 d-flex justify-content-between">
                       <div class="container m-0 p-0 w-50">
                           <div class="d-grid" style="display: flex; justify-content: space-between;">
                               <h6 style="align-self: center;">Metode</h6>
                               <div class="dropdown">
                                   <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       E-Wallet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                   </button>
                                   <ul class="dropdown-menu">
                                       <li><a class="dropdown-item" href="#" data-bs-target="#cash" data-bs-toggle="modal">Cash</a></li>
                                       <li><a class="dropdown-item active" href="#">E-Wallet</a></li>
                                       <li><a class="dropdown-item" href="#" data-bs-target="#bank" data-bs-toggle="modal">Bank</a></li>
                                   </ul>
                               </div>
                           </div>
                           <div class="d-grid" style="display: flex; justify-content: space-between; margin-top:3%;">
                               <h6 style="align-self: center;">Layanan</h6>
                               <div class="dropdown">
                                   <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       Dana &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
                                   </button>
                                   <ul class="dropdown-menu">
                                       <li><a class="dropdown-item active" href="#">Dana</a></li>
                                       <li><a class="dropdown-item " href="#">Ovo</a></li>
                                       <li><a class="dropdown-item" href="#">Gopay</a></li>
                                       <li><a class="dropdown-item" href="#">LinkAja</a></li>
                                   </ul>
                               </div>
                           </div>
                           <div class="mb-3" style="margin-top:3%; width:120%;">
                           <h6 style="align-self: center;">Bukti Pembayaran</h6>
                           <input class="form-control" type="file" id="formFile" style="width: 70%;">
                       </div>
                       </div>
                       <div class="w-50">
                           <img class="w-100" src="{{ asset('ProjectManagement/dashmin/img/qr.png') }}">
                       </div>
                   </div>
               </div>
           <center><a href="{{ route('bayar2client') }}" class="btn btn-primary" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
{{-- akhir modal pembayaran ewallet --}}


    {{-- modal pembayaran bank --}}
   <div class="modal fade" id="bank" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered" >
           <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
               <div class="modal-header" >
                   <div style="display: flex; flex-direction: column;">
                       <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
                       <div style="display: flex; align-items: center;">
                           <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" value="Website Berita" disabled>
                       </div>
                       <div style="display: flex; align-items: center; margin-top:3%;">
                           <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
                           <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" value="2.000.000" disabled>
                       </div>
                   </div>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
               </div>
               <div class="modal-body" style="border: none;">
                   <div class="container m-0 p-0 d-flex justify-content-between">
                       <div class="d-grid" style="display: flex; justify-content: space-between;">
                           <h6 style="align-self: center;">Metode</h6>
                           <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   Bank &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                               </button>
                               <ul class="dropdown-menu">
                                   <li><a class="dropdown-item" href="#">Cash</a></li>
                                   <li><a class="dropdown-item" href="#" data-bs-target="#wallet" data-bs-toggle="modal">E-Wallet</a></li>
                                   <li><a class="dropdown-item  active" href="#">Bank</a></li>
                               </ul>
                           </div>
                       </div>
                       <div class="mb-7" style="margin-right: 10%;">
                           <h6 style="">Layanan</h6>
                           <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   Layanan Bank &nbsp; &nbsp; &nbsp; &nbsp;
                               </button>
                               <ul class="dropdown-menu">
                                   <li><a class="dropdown-item" href="#">BRI</a></li>
                                   <li><a class="dropdown-item" href="#">BCA</a></li>
                                   <li><a class="dropdown-item" href="#">Mandiri</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>

                   <div class="container m-0 p-0 d-flex justify-content-between">
                       <div class="d-grid" style="display: flex; justify-content: space-between;">
                          <div class="mb-3" style="margin-top:3%; width:130%;">
                           <h6 style="">Bukti Pembayaran </h6>
                           <input class="form-control" type="file" id="formFile" style="width: 58%;">
                       </div>
                       </div>
                       <div class="mb-7" style="margin-top: 2%; margin-right:10%; width:50%;">
                           <h6 style="">No. Rekening </h6>
                           <input type="text" class="form-control"  disabled>
                       </div>
                   </div>
               <br>
           </div>
           <center><a href="{{ route('bayar2client') }}" class="btn btn-primary" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</a></center>
           <div class="modal-footer" style="border: none;">
           </div>
           </div>
         </div>
       </div>
   {{-- akhir modal pembayaran bank --}}

    {{-- Modal Struk Pembayaran --}}
       <style>
        @media print {
        /* Sembunyikan button saat cetakan */
        .modal button {
            display: none;
        }
        .modal {
        background: none;
        box-shadow: none;
        }
        }
       </style>

        <div class="modal fade" id="strukPembayaranModal" tabindex="-1" aria-hidden="true">
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
                    <h4 class="fw-bold text-center mt-1 border-bottom border-dark pb-2">{{ $client2->harga }}</h4>
                    <div class="d-flex justify-content-between">
                        <div class="d-grid">
                            <p class="text-center">Pembayaran Awal</p>
                            <p class="fw-bold text-center">2.500.000</p>
                        </div>
                        <div class="d-grid">
                            <p class="text-center">Pembayaran Awal</p>
                            <p class="fw-bold text-center">2.500.000</p>
                        </div>
                    </div>
                    <div class="container m-0 p-0">
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Tanggal Pembayaran Awal</p>
                        <p>{{ \Carbon\Carbon::parse($client2->tanggalpembayaran)->format('Y-m-d') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="text-secondary fs-10">Tanggal Pembayaran Akhir</p>
                        <p >{{ \Carbon\Carbon::parse($client2->tanggalpembayaran2)->format('Y-m-d') }}</p>
                    </div>
                        <div class="d-flex pb-0 justify-content-between">
                            <p class="text-secondary fs-10">Metode Pembayaran Awal</p>
                            <p>{{ $client2->metodepembayaran }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-secondary fs-10">Metode Pembayaran Akhir</p>
                            <p>{{ $client2->metodepembayaran2 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-secondary fs-10">Biaya Tambahan</p>
                            <p>-</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-secondary fs-10">Total Bayar</p>
                            <p>{{ $client2->harga }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button id="printBtn" class="btn btn-primary w-100 fw-bold"><i class="fa-solid fa-print"></i> Cetak PDF</button>
                </div>
            </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <script>
                document.getElementById('printBtn').addEventListener('click', function() {
                  // Logika untuk mencetak PDF modal

                  // Contoh: Menggunakan window.print() untuk mencetak halaman saat ini
                  window.print();
                });
              </script>

        </div>
        </div>

                            @endif
                            @empty
                            <tr>
                                <td class="text-center" colspan="5"><i class="fa-solid fa-empty"></i> Tidak ada data</td>
                            </tr>
                            @endforelse
      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
