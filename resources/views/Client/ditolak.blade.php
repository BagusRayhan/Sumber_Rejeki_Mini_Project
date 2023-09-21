<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
</head>
<style>
    /* Tampilan default untuk laptop */
    @media (min-width: 768px) {
        /* Tambahkan lebar minimum pada kolom agar tidak terlalu rapat */
        .table-responsive table td,
        .table-responsive table th {
            min-width: 120px;
        }
    }

    /* Tampilan untuk perangkat seluler */
    @media (max-width: 767px) {
        /* Atur font ukuran kecil pada seluruh tabel */
        .table-responsive table {
            font-size: 12px;
        }

        /* Atur lebar kolom agar bisa digulirkan secara horizontal */
        .table-responsive table td,
        .table-responsive table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
</style>
<body>
    <div class="container-xxl position-relative bg-white  p-0">
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
     <div class="container-fluid pt-4 px-4">
        <div class="search-form w-25">
            <form action="{{ route('ditolakclient') }}" method="GET">
                <div class="input-group rounded-pill" style="background: #E9EEF5">
                    <input type="text" name="keyword" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ..." value="{{ request('keyword') }}">
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
                                <th scope="col" class="w-50">Alasan</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $row)

                            <tr>
                                <td>{{ $row->napro }}</td>
                                <td>{{ $row->alasan }}</td>
                                <td class="text-center">
                                    <form id="deleteForm-{{ $row->id }}" onsubmit="sendRequest(event, {{ $row->id }});" action="{{ route('destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash"></i></button>
                                    </form>

                                    <!-- Script SweetAlert -->
                                    <script>
                                        function sendRequest(event, id) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: 'Apakah Anda yakin ?',
                                                text: 'Ingin Tolak Project Ini ?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    
                                                    document.getElementById('deleteForm-' + id).submit();
                                                }
                                            });
                                        }
                                    </script>


                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5"><i class="fa-solid fa-empty"></i> Tidak ada data</td>
                        </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div style="float: right;">
        {{ $data->links() }}
    </div>
</div>
</div>
@include('Client.Template.footer')
<!-- Content End -->


@include('Client.Template.script')

</body>


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>
