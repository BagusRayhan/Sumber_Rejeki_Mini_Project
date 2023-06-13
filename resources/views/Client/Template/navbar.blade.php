            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">
                    <div >
                       
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#"  class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-bell fa-lg" style="float:right; margin-right:400%;"></i>
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
                    <div class="nav-item dropdown" >
                        <a href="#" style="float:right; margin-right:58%;" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#MyModal">My Profile</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

<!-- Modal -->
        <div class="modal" id="MyModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                                <div class="row mb-3 mt-sm-2">
                                  <button type="button" style="margin-right:2%;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="form-group">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><center><img src="{{ asset('ProjectManagement/dashmin/img/user2.png') }}" alt="" style="width:40%; height:40%;"><br>Suharjo</center></h1>
                                </div>
                                <div class="form-group w-100 p-3">
                                    <label for="input1">Nama</label>
                                    <input class="form-control mt-1" value="Suharjo" id="textarea1"  name="textarea1" disabled>
                                </div><br><br>
                                <div class="col-md-6 ">
                                    <div class="form-group ">
                                        <label for="input1">Email</label>
                                        <input type="email" value="Halaman Login" class="form-control mt-1" id="input1" name="input1" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input2">No.Telpon</label>
                                        <input type="number" value="0867253616173" class="form-control mt-1" id="input2" name="input2" disabled>
                                    </div>
                                </div>
                                <div class="form-group w-1 p-3">
                                    <label for="input1">Nama Perusahaan</label>
                                    <input class="form-control mt-1" value="Sumber Rejeki" id="textarea1"  name="textarea1" disabled>
                                </div>
                                <div class="form-group w-80 p-3">
                                    <label for="input1">Alamat Perusahaan</label>
                                    <textarea class="form-control mt-1" id="textarea1" style="height: 100px" name="textarea1" disabled>Malang, Jawa Timur Indonesia</textarea>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Edit Profil</button>
                </div>
                </div>
            </div>
            </div>
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                            <div class="row mb-3 mt-sm-2">
                                  <button type="button" style="margin-right:2%;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               <div class="form-group">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    <center>
                                    <label for="file-upload">
                                        <img id="profile-image" src="{{ asset('ProjectManagement/dashmin/img/user.png') }}" alt="" style="width:40%; height:40%; border-radius: 50%;">
                                        <br>Suharjo
                                    </label>
                                    <input id="file-upload" type="file" style="display: none;">
                                    </center>
                                </h1>
                                </div>
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
                                        <input type="email" value="Halaman Login" class="form-control mt-1" id="input1" name="input1" >
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
            </div>
           
            <!-- Navbar End -->