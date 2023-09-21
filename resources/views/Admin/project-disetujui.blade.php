<!DOCTYPE html>
<html lang="en">

{{--  <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->  --}}
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
@include('Admin.templates.head')

<body>
    <style>
        @media (min-width: 1199px) {
            .search-form {
                width: 16em;
                height: 2em;
            }
        }
        @media (max-width: 767px) {
            .table-responsive tr th {
                font-size: .5em;
            }
            .search-form {
                width: 14em;
                height: 2em;
            }
            .table-responsive tr td {
                font-size: .5em;
            }
        }
        </style>
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

            <!-- Confirm Payment Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-between">
                    <div class="search-form w-25">
                        <form method="GET" action="{{ route('project-disetujui-admin') }}" class="search-form">
                            <div class="input-group rounded-pill" style="background: #E9EEF5">
                                <input type="text" name="query" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('query') }}">
                                <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Client</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Harga Project</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($project as $pro)
                                            <tr>
                                                <td>{{ $pro->nama }}</td>
                                                <td>{{ $pro->napro }}</td>
                                                <td>{{ isset($pro->biayatambahan) ? 'Rp ' . number_format((float)$pro->harga + (float)$pro->biayatambahan, 0, ',', '.') : 'Rp ' . number_format((float)$pro->harga, 0, ',', '.') }}</td>
                                                <td><span class="badge {{ $pro->status2 == 'telat' ? 'text-bg-danger' : 'bg-warning' }}">{{ $pro->status2 == 'telat' ? $pro->status2 : 'proses' }}</span></td>
                                                <td class="d-flex justify-content-evenly">
                                                    <a href="/detail-project-disetujui/{{ $pro->id }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                    {{-- @if ($pro->status2 == 'telat')
                                                        <form action="{{ route('delete-late-project') }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="project_id" value="{{ $pro->id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Confirm Payment Table End -->
                <div class="wrapper mt-3 w-100 d-flex justify-content-end">
                    {{$project->links()}}
                </div>

        <!-- Content End -->

    </div>

    @include('Admin.templates.script')
</body>
