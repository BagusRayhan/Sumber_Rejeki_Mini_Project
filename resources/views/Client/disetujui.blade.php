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

        <div class="container-fluid pt-4 px-4">
            <div class="search-form w-25">
                <form action="{{ route('setujuclient') }}" method="GET">
                    <div class="input-group rounded-pill" style="background: #E9EEF5">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                        <button class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Estimasi</th>
                                    <th scope="col">Harga Project</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($project) !== 0)
                                    @foreach ($project as $pro)
                                        <tr>
                                            <td>{{ $pro->napro }}</td>
                                            <td>{{ $pro->estimasi }}</td>
                                            <td>{{ $pro->harga }}</td>
                                            <td class="d-flex justify-content-evenly">
                                                <a href="/detailsetujui/{{ $pro->id }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="float: right;">
            {{ $project->links() }}
            </div>
    </div>


    @include('Client.Template.footer')
</div>
<!-- Content End -->


@include('Client.Template.script')
</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
