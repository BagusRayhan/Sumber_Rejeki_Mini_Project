<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .bank-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.bank-container label {
    margin-bottom: 10px;
}

.bank-container select,
.bank-container input {
    width: 900px;
    height: 40px;
    font-size: 16px;    
    margin-bottom: 10px;
}

</style>
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
            <form action="{{ route('bayarclient') }}" method="GET">
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
    </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Project</th>
                                <th scope="col">Harga Project</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($data as $item)
  @if ($item->statusbayar === 'menunggu pembayaran')
    <tr>
      <td>{{ $item->napro }}</td>
      <td>{{ $item->harga }}</td>
      <td><center><span class="badge text-bg-danger">{{ $item->statusbayar }}</span></td></center>
      <td>
        <center>
          <button type="button" data-bs-toggle="modal" data-bs-target="#Modalbayar" data-id="{{ $item->id }}" data-napro="{{ $item->napro }}" data-harga="{{ $item->harga }}" class="btn btn-primary btn-bayar btn-sm">
          <i class="fa-solid fa-wallet"></i>&nbsp;Bayar
          </button>
        </center>
      </td>
    </tr>
  @endif
@endforeach

@if ($data->isEmpty())
  <tr>
    <td class="text-center" colspan="5"><i class="fa-solid fa-empty"></i> Tidak ada data</td>
  </tr>
@endif
</tbody>
</table>

<div class="modal fade" id="Modalbayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
      <div class="modal-header" style="border: none;">
        <img id="profile-image" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}" alt="" style="width:15%; height:15%; margin-top:1%;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="border: none;">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="font-weight: bold;">Pembayaran Awal</h1><br>
        <div style="display: flex; justify-content: space-between; margin-bottom:3%;">
          <h6 style="align-self: center;">Nama Project :</h6>
          <input type="text" name="namaProject" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" id="namaProject" disabled>
        </div>
        <div style="display: flex; justify-content: space-between;">
          <h6>Harga Pembayaran :</h6>
          <input type="text" name="hargaProject" class="form-control" style="border:none; font-style: ubuntu; width:auto; margin-right:22%; height:1%; margin-top: -5px;" id="hargaProject" disabled>
        </div>
        <input type="hidden" id="projectIdCash">
        <br>
      </div>
      <center>
        <button class="btn btn-primary pilih-metode" data-bs-target="#cash" data-bs-toggle="modal" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Pilih Metode Pembayaran</button>
      </center>
      <div class="modal-footer" style="border: none;"></div>
    </div>
  </div>
</div>


<div class="modal fade" id="cash" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
      <div class="modal-header">
        <div style="display: flex; flex-direction: column;">
          <h6 style="opacity: 0.5; margin-bottom: 10px;">Rincian <span style="display: inline-block;">Pembayaran</span></h6>
          <div style="display: flex; align-items: center;">
            <h6 style="align-self: center; margin-right: 10px;">Nama Project :</h6>
            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:60%;" id="namaProjectCash" disabled>
          </div>
          <div style="display: flex; align-items: center; margin-top:3%;">
            <h6 style="align-self: center; margin-right: 10px;">Harga Pembayaran :</h6>
            <input type="text" class="form-control" style="border: none; font-family: ubuntu; height: 1%; width:50%;" id="hargaProjectCash" disabled>
          </div>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button>
      </div>
      <form id="updateForm" action="{{ route('update-status-bayar', '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body" style="border: none;">
          <div class="container m-0 p-0 d-flex justify-content-between">
            <div class="d-grid" style="display: flex; justify-content: space-between;">
              <h6 style="align-self: center; font-size: 16px;">Metode</h6>
              <select class="form-select form-select-lg mb-3" name="metodepembayaran" style="width: 200px; height: 40px; font-size: 16px;" aria-label=".form-select-lg example" id="selectMetode">
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
        <center>
          <button type="submit" class="btn btn-primary" style="border-radius: 33px; font-weight: bold; font-family: 'Ubuntu'; width:70%; height:100%;">Bayar Sekarang</button>
        </center>
        <div class="modal-footer" style="border: none;"></div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('.btn-bayar').click(function() {
        var napro = $(this).data('napro');
        var harga = $(this).data('harga');
        var tglBayar = $(this).data('tanggalpembayaran');
        var metodepembayaran = $(this).data('metodepembayaran');
        var projectId = $(this).data('id');
        alert(projectId);

        var setengahHarga = harga / 2;

        $('#namaProject').val(napro);
        $('#hargaProject').val(setengahHarga);
        $('#tgl-bayar').val(tglBayar);
        $('#metodepembayaran').val(metodepembayaran);
        $('#projectIdCash').val(projectId); // Menetapkan nilai ID proyek pada input tersembunyi
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

    $('.pilih-metode').click(function() {
        var napro = $('#namaProject').val();
        var harga = $('#hargaProject').val();
        var projectId = $('#projectIdCash').val(); // Mengambil nilai ID proyek dari input tersembunyi
        alert(projectId);

        $('#namaProjectCash').val(napro);
        $('#hargaProjectCash').val(harga);

        var form = $('#updateForm');
        var action = form.attr('action');
        action = action.replace(/\/$/, "");
        form.attr('action', action + '/' + projectId);
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
        layananSelect.name = 'metode';
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

        const fileInputLabel = document.createElement('label');
        fileInputLabel.textContent = 'Upload Bukti Pembayaran:';

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'buktipembayaran';
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

          imageContainer.innerHTML = '';

          if (selectedLayanan === 'dana') {
            const imageFilename = 'dana.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'ovo') {
            const imageFilename = 'ovo.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'gopay') {

            const imageFilename = 'gopay.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'linkaja') {
            const imageFilename = 'linkaja.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '100px';
            imageElement.style.height = '100px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }
        });
      } else if (selectedValue === 'bank') {
        const bankLabel = document.createElement('label');
        bankLabel.textContent = 'Bank';

        const bankSelect = document.createElement('select');
        bankSelect.className = 'form-select form-select-lg mb-3';
        bankSelect.name = 'metode';
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
        fileInputLabel.textContent = 'Upload Bukti Pembayaran:';

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'buktipembayaran';
        fileInput.className = 'form-control';
        fileInput.style.border = 'none';
        fileInput.style.fontFamily = 'ubuntu';
        fileInput.style.height = '1%';
        fileInput.style.width = '50%';
        fileInput.setAttribute('required', true);

        const inputBankLabel = document.createElement('label');
        inputBankLabel.textContent = 'No.Rekening:';

        const inputBank = document.createElement('input');
        inputBank.type = 'text';
        inputBank.name = 'rekening';
        inputBank.className = 'form-control';
        inputBank.style.border = 'none';
        inputBank.style.fontFamily = 'ubuntu';
        inputBank.style.height = '1%';
        inputBank.style.width = '50%';
        inputBank.setAttribute('required', true);
        inputBank.setAttribute('disabled', true);

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
      }
    });
  </script>
        </form>
    </div>
</div>

            <div class="d-flex justify-content-end">
                {{ $data->links() }}
            </div>
                    </div>
      </div>
      @include('Client.Template.footer')
        </div>
                    <!-- Content End -->
                
                    @include('Client.Template.script')
                </body>
              
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
