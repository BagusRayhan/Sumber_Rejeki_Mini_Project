<!-- Navbar Start -->
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
                <button type="button" class="dropdown-item" id="profile-btn" data-bs-toggle="modal" data-bs-target="#profileModal">My Profile</button>
                <a href="#" class="dropdown-item">Log Out</a>
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
<!-- Profile Start -->
<div class="modal fade" id="profileModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered profile-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">My Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 d-flex flex-column align-items-center justify-content-center">
            <img class="rounded-circle border border-dark" style="width: 8em" src="{{ asset('ProjectManagement/dashmin/img/default-pp.jpg') }}" alt="">
            <h5 class="mt-2">Kaja</h5>
        </div>
        <div class="mb-1">
          <label for="exampleFormControlInput1" class="form-label">Nama</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="Kaja" disabled>
        </div>
        <div class="mb-1">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="kaja@gmail.com" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#editProfileModal" data-bs-toggle="modal">Edit</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editProfileModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered profile-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">My Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 d-flex flex-column align-items-center justify-content-center">
            <img class="rounded-circle border border-dark" style="width: 8em" src="{{ asset('ProjectManagement/dashmin/img/default-pp.jpg') }}" alt="">
            <h5 class="mt-2">Kaja</h5>
        </div>
        <div class="mb-1">
          <label for="exampleFormControlInput1" class="form-label">Nama</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="Kaja">
        </div>
        <div class="mb-1">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="kaja@gmail.com">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#profileModal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
{{-- Profile End --}}