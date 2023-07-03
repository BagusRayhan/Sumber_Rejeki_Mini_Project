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
    right: 10px;
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
                
                  <button type="button" class="dropdown-item" id="profile-btn" data-bs-toggle="modal" data-bs-target="#MyModal">My Profile</button>
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
<!-- Modal -->
<div class="modal fade" id="MyModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered profile-modal">
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
                          <input typ e="file" id="fileInput" style="display:none" accept=".jpg,.png,.pdf">
                        </a>
                      </div>
                        <input id="file-upload" type="file" style="display: none;">
                </center>
                {{-- <center><img src="{{ asset('ProjectManagement/dashmin/img/user-new.png') }}" alt="" style="width:40%; height:40%;"><br></center> --}}
              </h1>
            </div>
            <div class="mb-1">
              <label for="exampleFormControlInput1" class="form-label">Nama</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $client->name }}" disabled>
            </div><br><br>
            <div class="col-md-6">
              <div class="form-group">
                <label for="input1">Email</label>
                <input type="email" class="form-control mt-1" id="exampleFormControlInput2" value="{{ $client->email }}" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="input2">No.Telpon</label>
                <input type="number" class="form-control mt-1" id="exampleFormControlInput3" value="{{ $client->no_tlp }}" disabled>
              </div>
            </div>
            <div class="form-group w-1 p-3">
              <label for="input1">Nama Perusahaan</label>
              <input type="text" class="form-control mt-1" id="exampleFormControlInput4" value="{{ $client->nama_perusahaan }}" disabled>
            </div>
            <div class="form-group w-80 p-3">
              <label for="input1">Alamat Perusahaan</label>
              <textarea class="form-control mt-1" id="exampleFormControlInput5" style="height: 100px" disabled>{{ $client->alamat_perusahaan }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="editProfileButton">Edit Profil</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('editProfileButton').addEventListener('click', function() {
      var inputs = document.querySelectorAll('#MyModal input, #MyModal textarea');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = false;
      }
    });
  </script>

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
