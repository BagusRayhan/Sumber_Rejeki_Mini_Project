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

        
        <div class="container-fluid pt-3 px-4">
            <div class="mb-3 d-flex justify-content-between">
                <div class="form-group" style="width:480px">
                    <label for="exampleFormControlInput1" class="form-label">Nama Project</label>
                    <input type="text" value="{{ $data->napro }}" class="form-control" placeholder="" disabled>
                </div>
                <div class="form-group" style="width:480px">
                    <label for="exampleFormControlInput1" class="form-label">Dokumen Pendukung</label>
                    <div class="input-group">
                        <button type="button" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#suppDocs" aria-describedby="suppdocsBtn">
                            <i class="fa-solid fa-eye pe-2"></i> lihat dokumen
                        </button>
                        @if ($data->dokumen == null)
                            <a onclick="emptyDocsDown()" class="input-group-text" id="suppdocsBtn"><i class="fa-solid fa-file-arrow-down"></i></a>
                        @else
                            <a href="{{ route('download-suppdocs-client', ['dokumen' => $data->dokumen]) }}" class="input-group-text" id="suppdocsBtn"><i class="fa-solid fa-file-arrow-down"></i></a>
                        @endif
                    </div>
                    <div class="modal fade" id="suppDocs" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Dokumen Pendukung</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <iframe class="w-100" src="{{ asset('document/'.$data->dokumen) }}" frameborder="0" style="height: 400px"></iframe>
                                    </div>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="form-group" style="width:480px">
                    <label for="exampleFormControlInput1" class="form-label">Deadline</label>
                    <input type="datetime-local" value="{{ $data->deadline }}" class="form-control" placeholder="" disabled>
                </div>
                <div class="form-group" style="width:480px">
                    <label for="exampleFormControlInput1" class="form-label">Total Harga</label>
                    <input type="text" value="{{ $data->harga }}" class="form-control" placeholder="" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Fitur</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Harga Fitur</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($dataa) !== 0)
                                    @foreach ($dataa as $f)
                                        <tr>
                                            <td>{{ $f->namafitur }}</td>
                                            <td>{{ $f->status }}</td>
                                            <td>{{ $f->hargafitur }}</td>
                                            <td class="d-flex justify-content-evenly">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#detailFitur{{ $f->id }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal Box Detail Fitur Start -->
                                        <div class="modal fade" id="detailFitur{{ $f->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Fitur</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="">
                                                            <div class="mb-2 d-flex justify-content-between">
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Nama Fitur</label>
                                                                    <input type="text" class="form-control" value="{{ $f->namafitur }}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Harga Fitur</label>
                                                                    <input type="text" class="form-control" value="{{ $f->hargafitur }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" disabled>{{ $f->deskripsi }}</textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Box Detail Fitur End -->
                                    @endforeach
                                @else
                                    <td class="text-center" colspan="4">Tidak ada fitur</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="my-3 mx-1 d-flex justify-content-between" style="width: 10em">
                <form action="{{ route('reject-revision') }}" id="rejectRevision" onsubmit="rejectRevision(event)" method="post">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $data->id }}">
                    <button class="btn btn-danger btn-sm" name="submit" type="submit"><i class="fa-solid fa-circle-xmark"></i> Tolak</button>
                </form>
                <form action="{{ route('accept-revision') }}" id="acceptRevision" onsubmit="acceptRevision(event)" method="post">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $data->id }}">
                    <button class="btn btn-primary btn-sm" name="submit" type="submit"><i class="fa-solid fa-circle-check"></i> Setuju</button>
                </form>
                {{-- <script>
                    function acceptRevision(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Setuju?',
                            text: "Perubahan project oleh admin",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#0d6efd',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Setuju',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('acceptRevision').submit();
                            }  
                        })
                    }
                    function rejectRevision(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Tolak?',
                            text: "Perubahan project oleh admin",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#0d6efd',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Tolak',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('rejectRevision').submit();
                            }
                        })
                    }
                </script> --}}
            </div>
            @include('Client.Template.footer')
        </div>
        <!-- Content End -->


    </body>
    @include('Client.Template.script')


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>

