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
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px">{{ (count($notification) >= 4) ? '4+' : count($notification) }}</span>
                @endif
            </a>
            <div class="dropdown-menu mt-3 dropdown-menu-end bg-light border-0 m-0 rounded" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 6px 0 rgba(0, 0, 0, 0.19);">
              @if (count($notification) !== 0)
                @foreach ($notification as $notif)
                <a href="{{ route('notif-redirect', ['id' => $notif->id]) }}" class="dropdown-item border-bottom border-secondary">
                  <h6 class="fw-semibold m-0">{{ $notif->notif }}</h6>
                  <small>{{ $notif->deskripsi }}</small>
                  <p style="font-size: 12px" class="m-0">{{ $notif->created_at->diffForHumans() }}</p>
                </a>
                @endforeach
              @else
                <a href="#" class="dropdown-item text-center rounded">Tidak ada notifikasi masuk</a>
              @endif
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{ asset('gambar/user-profile/'. $admin->profil) }}" alt="" style="width: 40px; height: 40px;">
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 6px 0 rgba(0, 0, 0, 0.19);">

              <button type="button" class="dropdown-item" id="profile-btn" data-bs-toggle="modal" data-bs-target="#mymodal">My Profile</button>
              <a href="{{ route('logout') }}" onclick="return confirmasi(event)" class="dropdown-item">Log Out</a>

              <script>
                  function confirmasi(event) {
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
        <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="profile d-flex justify-content-center">
                <img src="gambar/user-profile/{{ $admin->profil }}" class="rounded-circle profile-image">
                <label for="fileInputA" class="change-profile-button d-flex justify-content-center" id="chooseFileButtonA">
                    <i class="fa-sharp fa-solid fa-image text-primary"></i>
                </label>
                <input type="file" id="fileInputA" name="fileInputA" style="display: none" accept=".jpg,.png,.pdf">
            </div>
          <div class="mb-1">
              <label for="exampleFormControlInput1" class="form-label">Nama</label>
              <input type="text" class="form-control" id="exampleFormControlInput1"  name="name" value="{{ $admin->name }}">
            </div>
          <div class="row">
              <div class="mb-1">
                    <label for="input1">Email</label>
                    <input type="email" class="form-control mt-1" id="exampleFormControlInput2" name="email" value="{{ $admin->email }}">
                </div>
              </div>
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

        $(document).ready(function() {
            $('.change-profile-button').on('click', function(e) {
                e.preventDefault();
                // Tambahkan kode yang ingin Anda jalankan ketika tombol perubahan profil diklik
                // Misalnya, tampilkan dialog atau tampilkan form perubahan profil
            });
        });

        document.getElementById("fileInputA").addEventListener("change", function(event) {
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
