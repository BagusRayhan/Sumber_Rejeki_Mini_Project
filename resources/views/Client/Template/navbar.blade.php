<!-- Navbar Start -->

<style>
    .profile {
    position: relative;
    display: inline-block;
  }

  .profile-image {
    width: 200px;
    height: 200px;
    object-fit: cover;
  }

  .change-profile-button {
    position: absolute;
    bottom: 10px;
    right: 6em;
    background-color: #fff;
    border-radius: 50%;
    padding: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  </style>

  <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

      <a href="#" class="sidebar-toggler flex-shrink-0 text-decoration-none">
          <i class="fa fa-bars"></i>
      </a>
      <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
          <a href="#" class="text-dark h4" data-bs-toggle="dropdown">
            <i class="far fa-bell position-relative"></i>
            @if (count($notification) !== 0)
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px">{{ (count($notification) > 9) ? '9+' : count($notification) }}</span>
            @endif
          </a>
          <div class="dropdown-menu mt-3 dropdown-menu-end bg-light border-0 m-0 rounded" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 6px 0 rgba(0, 0, 0, 0.19);">
            @if (count($notification) !== 0)
              @foreach ($notification as $notif)
              <a href="{{ route('notifclient', ['id' => $notif->id]) }}" class="dropdown-item border-bottom border-secondary">
                <h6 class="fw-semibold m-0">{{ $notif->notif }}</h6>
                <small>{{ $notif->deskripsi }}</small>
                <p style="font-size: 12px" class="m-0">{{ $notif->created_at->diffForHumans() }}</p>
              </a>
              @endforeach
              <form action="{{ route('read-all-notif-client') }}" onsubmit="readAllNotif(event)" id="readAllNotif" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-block btn-sm w-100">Tandai semua telah dibaca</button>
              </form>
              <script>
                function readAllNotif(event) {
                  event.preventDefault();
                  Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Menghapus semua notifikasi',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      document.getElementById('readAllNotif').submit();
                    }
                  });
                }
              </script>
            @else
              <a class="dropdown-item text-center rounded">Tidak ada notifikasi masuk</a>
            @endif
          </div>
        </div>
          <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img class="rounded-circle me-lg-2" src="{{ asset('gambar/user-profile/'. $client->profil) }}" alt="" style="width: 40px; height: 40px;">
              </a>
              <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 6px 0 rgba(0, 0, 0, 0.19);">

                <button type="button" class="dropdown-item" id="profile-btn" data-bs-toggle="modal" data-bs-target="#mymodal">My Profile</button>
                 <a href="{{ route('logout') }}" onclick="konfirmasi(event)" class="dropdown-item">Log Out</a>

                 <script>
                    function konfirmasi(event) {
                        event.preventDefault();

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: 'Ingin Logout',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                window.location.href = event.target.href;

                            } else {

                                Swal.fire(
                                    'Logout Dibatalkan',
                                    '',
                                    'info'
                                );
                            }
                        });
                    }
                </script>
              </div>
          </div>
      </div>
  </nav>
  <!-- Navbar End -->
  <style>
    .profile-modal {
        width: 400px;
    }
  </style>
  <div class="modal fade" data-bs-backdrop="static" id="mymodal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered profile-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">My Profile</h1>
        </div>
        <div class="modal-body">
            <form action="{{ route('client.updateProfile') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="profile d-flex justify-content-center">
                <img src="gambar/user-profile/{{ $client->profil }}" class="rounded-circle profile-image">
                <a href="#" type="file" class="change-profile-button d-flex justify-content-center" id="chooseFileButtonA">
                  <i class="fa-sharp fa-solid fa-image"></i>
                  <input type="file" id="fileInputA" name="fileInputA" style="display:none" accept=".jpg,.png,.pdf">
                </a>
              </div>
              <div class="mb-1">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $client->name }}">
              </div>
              <div class="row">
                <div class="col-md-6 mt-2">
                  <div class="form-group">
                    <label for="input1">Email</label>
                    <input type="email" class="form-control mt-1" id="exampleFormControlInput2" name="email" value="{{ $client->email }}">
                  </div>
                </div>
                <div class="col-md-6 mt-2">
                  <div class="form-group">
                    <label for="input2">No.Telpon</label>
                    <input type="number" class="form-control mt-1" id="exampleFormControlInput3" name="no_tlp" value="{{ $client->no_tlp }}">
                  </div>
                </div>
                <div class="mb-1 mt-2">
                  <label for="exampleFormControlInput1" class="form-label">Nama Perusahaan</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_perusahaan" value="{{ $client->nama_perusahaan }}">
                </div>
                <div class="mb-1 mt-2">
                  <label for="input1">Alamat Perusahaan</label>
                  <textarea class="form-control mt-1" id="exampleFormControlInput5" style="height: 100px" name="alamat_perusahaan">{{ $client->alamat_perusahaan }}</textarea>
                </div>
              </div>
              <input type="hidden" name="old_profile" value="{{ $client->profil }}">
            </div>

            <div class="modal-footer">
              <button class="btn btn-danger" class="btn-close" data-bs-dismiss="modal" type="button">Batal</button>
              <button class="btn btn-primary" type="submit" id="saveProfileButton">Simpan</button>
            </div>
          </form>
          </div>

      <script>
        document.getElementById('chooseFileButtonA').addEventListener('click', function() {
        document.getElementById('fileInputA').click();
        });

        document.getElementById('fileInputA').addEventListener('change', function() {
        var selectedFile = this.files[0];
        // Lakukan sesuatu dengan file yang dipilih, misalnya mengunggahnya ke server
        console.log('Selected file:', selectedFile);
        });

    </script>
    <script>
    $(document).ready(function() {
    $('.change-profile-button').on('click', function(e) {
        e.preventDefault();
        // Tambahkan kode yang ingin Anda jalankan ketika tombol perubahan profil diklik
        // Misalnya, tampilkan dialog atau tampilkan form perubahan profil
    });
    });

    </script>
   <script>
     document.getElementById("file-upload").addEventListener("change", function(event) {
         var input = event.target;
         if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
             document.getElementById("profile-image").setAttribute("src", e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
         }
     });
     </script>
    </div>
  </div>

            {{-- <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                            <div class="row mb-3 mt-sm-2">
                                  <button type="button" style="margin-right:2%;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               <div class="form-group">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    <center>
                                        <div class="profile">
                                            <img src="{{ asset('ProjectManagement/dashmin/img/user-new.png') }}" alt="Gambar Profil" class="profile-image">
                                            <a href="#" type="file" class="change-profile-button" id="chooseFileButton" style="width: 45px">
                                              <i class="fa-sharp fa-solid fa-image"></i>
                                              <input type="file" id="fileInput" style="display:none" accept=".jpg,.png,.pdf">
                                            </a>
                                          </div>
                                    <input id="file-upload" type="file" style="display: none;">
                                    </center>
                                </h1>
                                </div>
                                <script>
                                    document.getElementById('chooseFileButton').addEventListener('click', function() {
                                    document.getElementById('fileInput').click();
                                    });

                                    document.getElementById('fileInput').addEventListener('change', function() {
                                    var selectedFile = this.files[0];
                                    // Lakukan sesuatu dengan file yang dipilih, misalnya mengunggahnya ke server
                                    console.log('Selected file:', selectedFile);
                                    });
`
                                </script>
                                <script>
                                $(document).ready(function() {
                                $('.change-profile-button').on('click', function(e) {
                                    e.preventDefault();
                                    // Tambahkan kode yang ingin Anda jalankan ketika tombol perubahan profil diklik
                                    // Misalnya, tampilkan dialog atau tampilkan form perubahan profil
                                });
                                });

                                </script>
                                <script>
                                    document.getElementById("file-upload").addEventListener("change", function(event) {
                                        var input = event.target;
                                        if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById("profile-image").setAttribute("src", e.target.result);
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                        }
                                    });
                                    </script>

                                <div class="form-group w-100 p-3">
                                    <label for="input1">Nama</label>
                                    <input class="form-control mt-1" value="Suharjo" id="textarea1"  name="textarea1" >
                                </div><br><br>
                                <div class="col-md-6 ">
                                    <div class="form-group ">
                                        <label for="input1">Email</label>
                                        <input type="email" value="Harjoya@gmail.com" class="form-control mt-1" id="input1" name="input1" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input2">No.Telpon</label>
                                        <input type="number" value="0867253616173" class="form-control mt-1" id="input2" name="input2">
                                    </div>
                                </div>
                                <div class="form-group w-1 p-3">
                                    <label for="input1">Nama Perusahaan</label>
                                    <input class="form-control mt-1" value="Sumber Rejeki" id="textarea1"  name="textarea1">
                                </div>
                                <div class="form-group w-80 p-3">
                                    <label for="input1">Alamat Perusahaan</label>
                                    <textarea class="form-control mt-1" id="textarea1" style="height: 100px" name="textarea1" >Malang, Jawa Timur Indonesia</textarea>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Batal</button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Simpan</button>
                </div>
                </div>
            </div>
            </div> --}}

            <!-- Navbar End -->
