<!-- Navbar Start -->

<style>
  .profile {
  position: relative;
  display: inline-block;
}

.profile-image {
  width: 40%;
  height: 40%;
  object-fit: cover;
}

.change-profile-button {
  width: 34px;
  position: absolute;
  bottom: 10px;
  right: 7em;
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
                <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <button type="button" class="dropdown-item" id="profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">My Profile</button>
                <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
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
<div class="modal fade" data-bs-backdrop="static" id="editProfileModal" aria-hidden="true" tabindex="-1">
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
                <a href="#" type="file" class="change-profile-button d-flex justify-content-center" id="chooseFileButtonA">
                  <i class="fa-sharp fa-solid fa-image"></i>
                  <input type="file" id="fileInputA" name="fileInputA" style="display:none" accept=".jpg,.png,.pdf">
                </a>
            </div>
          <div class="mb-1">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $admin->name }}">
          </div>
          <div class="mb-1">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="email" value="{{ $admin->email }}">
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
{{-- Profile End --}}
