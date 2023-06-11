 <!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
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

     {{-- //code Search --}}
     <div class="w-25" style="margin-left: 3%; margin-top:2%;">
        <form action="#" method="GET">
            <div class="input-group rounded-pill" style="background: #E9EEF5">
                <div class="input-group">
                    <input type="text" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..."> &nbsp;
                    <script>
                        // Simpan nilai input pencarian ke dalam localStorage setiap kali nilai berubah
                        document.getElementById('search').addEventListener('input', function() {
                            localStorage.setItem('searchValue', this.value);
                        });

                        // Set nilai input pencarian dengan nilai yang disimpan di localStorage (jika ada)
                        var searchInput = document.getElementById('search');
                        var searchValue = localStorage.getItem('searchValue');
                        if (searchValue) {
                            searchInput.value = searchValue;
                        }
                    </script>
                        <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                
                </div>

            </div>
    </div>

       <div class="col-sm-12 col-xl-11" style="margin-left: 2%;     margin-top:5%;">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="d-flex justify-content-end mb-3">
                               <a href="{{ route('createproreq') }}" class="btn btn-primary">Request Project</a>
                            </div>
                           
                            <h6 class="mb-4">Project Request</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Client</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mr.Daniel</td>
                                        <td>Website Sekolah</td>
                                        <td>26-Juni-2023 - 15:00</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mr.Andreans</td>
                                        <td>Website Toko</td>
                                        <td>25-September-2023 - 13:00</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Mr.Johanes</td>
                                        <td>Website Pertanian</td>
                                        <td>20-Desember-2023 - 17:00</td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
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
                    

      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
