<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
@endphp

@include('Admin.templates.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Admin.templates.navbar')

            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-between">
                    <div class="search-form w-25">
                        <form action="{{ route('project-disetujui-admin') }}">
                            <div class="input-group rounded-pill" style="background: #E9EEF5">
                                <input type="text" name="query" value="{{ request('query') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                                <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <style>
                .nav-link {
                    color: black;
                }
                .avatar {
                    width: 2em;
                    height: 2em;
                }
            </style>

            <div class="wrapper mx-4 mt-4 d-flex justify-content-between">
                <div class="card text-center" style="width: 24em">
                    <div class="card-header d-flex justify-content-between  ">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" aria-current="true" href="#">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Member</a>
                            </li>
                        </ul>
                        <div class="float-end">
                            <button class="btn btn-block btn-sm"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('gambar/backup/group2.png') }}" class="rounded-circle border-0" width="100">
                        <h5 class="card-title">Team</h5>
                        <div class="wrapper text-start my-3 d-flex flex-column">
                            <small class="card-text fw-bold">Project Selesai</small>
                            <small class="card-text">12</small>
                            <small class="card-text fw-bold mt-2">Deskripsi</small>
                            <small class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea perspiciatis cum ducimus ullam adipisci hic provident, quod sint maxime accusamus consequuntur, iusto numquam nihil id ipsam iste quisquam? Dolorem sit deserunt dicta repudiandae, exercitationem, quae quo voluptas eaque atque, sequi nesciunt. Quis dolore necessitatibus quas quaerat quos atque maiores fugiat repudiandae? Commodi fuga et pariatur! Vel fugiat, aspernatur excepturi nisi tempore iusto voluptatem facere!</small>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 34em">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>List Tim</h6>
                        <button class="btn btn-primary btn-sm">Tambah tim</button>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Ketua</th>
                                        <th scope="col" class="text-center" style="width: 6em">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="col">1</td>
                                        <td scope="col">asd</td>
                                        <td scope="col">Tes</td>
                                        <td scope="col" class="d-flex justify-content-evenly">
                                            <button class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></button>
                                            <form action="" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="team_id">
                                                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content End -->
    </div>
    @include('Admin.templates.script')
</body>
