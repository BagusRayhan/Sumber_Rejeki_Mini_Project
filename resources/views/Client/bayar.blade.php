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
            
            {{-- Modal Bayar Awal --}}
            <div class="modal fade" id="Modalbayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-image: url('ProjectManagement/dashmin/img/bg.png');">
                  <div class="modal-header" style="border: none;">
                    <div class="wrapper d-flex align-items-center">
                      <img id="profile-image" style="width:4em" class="me-3" src="{{ asset('ProjectManagement/dashmin/img/ikonm.png') }}">
                      <h1 class="modal-title fw-bold fs-5" id="exampleModalToggleLabel">Pembayaran Awal</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom:10%;" aria-label="Close"></button>
                  </div>
                  <div class="modal-body border-0">
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                      <h6>Nama Project</h6>
                      <input type="text" name="namaProject" class="form-control w-50" style="border:none; font-style: ubuntu;" id="namaProject" disabled>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                      <h6>Harga Project</h6>
                      <input type="text" name="hargaProject" class="form-control w-50" style="border:none; font-style: ubuntu;" id="hargaProject" disabled>
                    </div>
                    <input type="hidden" id="projectIdCash">
                  </div>
                  <div class="modal-footer d-flex justify-content-center border-0">
                    <button class="btn btn-primary fw-bold w-75 mb-3 pilih-metode" data-bs-target="#cash" data-bs-toggle="modal" style="border-radius: 33px; font-family: 'Ubuntu';">Pilih Metode Pembayaran</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- Modal Bayar Cash --}}



<div class="modal fade" id="cash" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
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
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin-bottom: 10%;" aria-label="Close"></button> --}}
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
              <div id="additionalSelectContainer"></div>
            </div>
              <div class="w-50" style="flex-direction: row-reverse;">
                  <div id="imageContainer"></div>
              </div>
          </div>
           <div class="mb-5 bg-primary" style="margin-top:3%;">
                <div id="fileInputContainer"></div>
          </div>
          <br>
        </div>
        <div class="modal-footer border-0 d-flex flex-column justify-content-center">
          <button type="submit" class="btn btn-primary fw-bold w-75" style="border-radius: 33px; font-family: 'Ubuntu';">Bayar Sekarang</button>
          <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-target="#Modalbayar" data-bs-toggle="modal">Kembali</a>
        </div>
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

        var setengahHarga = harga / 2;

        $('#namaProject').val(napro);
        $('#hargaProject').val(setengahHarga);
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

    $('.pilih-metode').click(function() {
        var napro = $('#namaProject').val();
        var harga = $('#hargaProject').val();
        var projectId = $('#projectIdCash').val(); 

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
        fileInput.name = 'buktipembayaran';
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
            const imageFilename = 'dana.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '200px';
            imageElement.style.height = '200px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'ovo') {
            const imageFilename = 'ovo.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '200px';
            imageElement.style.height = '200px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'gopay') {

            const imageFilename = 'gopay.png';

            const imageUrl = 'gambar/qr/' + imageFilename;

            const imageElement = document.createElement('img');
            imageElement.style.width = '200px';
            imageElement.style.height = '200px';
            imageElement.src = imageUrl;

            imageContainer.appendChild(imageElement);
          }

          if (selectedLayanan === 'linkaja') {
            const imageFilename = 'linkaja.png';

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
        fileInputLabel.textContent = 'Bukti Pembayaran';
        fileInputLabel.style.textAlign = 'center';
        fileInputLabel.style.marginBottom = '5px';
        fileInputLabel.style.position = 'relative';
        fileInputLabel.style.top = '-75px';
        fileInputLabel.style.right = '-224px';

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'buktipembayaran';
        fileInput.className = 'form-control';
        fileInput.style.border = 'none';
        fileInput.style.fontFamily = 'ubuntu';
        fileInput.style.height = '1%';
        fileInput.style.width = '170%';
        fileInput.style.marginTop = '-79px';
        fileInput.style.marginLeft = 'auto';
        fileInput.style.marginRight = '-310px';
        fileInput.setAttribute('required', true);

        const inputBankLabel = document.createElement('label');
        inputBankLabel.textContent = 'No. Rekening';
            inputBankLabel.style.textAlign = 'center';
            inputBankLabel.style.marginBottom = '5px';
            inputBankLabel.style.position = 'absolute';
            inputBankLabel.style.top = '16px';
            inputBankLabel.style.right = '148px';

        const inputBank = document.createElement('input');
        inputBank.type = 'text';
        inputBank.name = 'rekening';
        inputBank.className = 'form-control';
        inputBank.style.border = 'none';
        inputBank.style.fontFamily = 'ubuntu';
            inputBank.style.height = '15%';
            inputBank.style.width = '45%';
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
    datetimeInput.name = 'tanggalpembayaran';
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
