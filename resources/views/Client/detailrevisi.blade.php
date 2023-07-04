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

      <div class="container-fluid">
            <h4 class="mb-3 mt-3" style="margin-left: 2%;">Detail Project</h4>
            <form action="#" method="GET">
                {{ csrf_field() }}
            <div class="mb-3 d-flex justify-content-between">
                <div class="wrapper w-50 px-3 d-flex flex-column">
                    <div class="form-group">
                        <label for="input1">Nama Project</label>
                        <input type="text" class="form-control" id="input1" value="{{ $data->napro }}" disabled>
                    </div><br>
                    <div class="form-group">
                        <label for="input2">Deadline</label>
                        <input type="text" class="form-control" id="input2" value="{{ $data->deadline }}" disabled>
                    </div><br>
                </div>
                <div class="wrapper w-50 px-3 d-flex flex-column">
                <div class="form-group mb-3">
                    <div class="form-group">
                        <label for="input3">Dokumen Pendukung</label>
                        <input type="text" class="form-control" id="input3" value="{{ $data->bukti }}" disabled>
                    </div><br>
                    <div class="form-group">
                        <label for="input4">Total Harga</label>
                        <input type="text" class="form-control" id="input4" value="{{ $data->harga }}" disabled>
                    </div>
                </div>
            </div>
                </div>
                </form>
        </div>


        {{-- table  --}}
     <div class="col-sm-12 col-xl-11 d-flex justify-content-between" style="margin-left: 2%; margin">
         <div class="w-25">
             <form action="#" method="GET">
             </form>
         </div>
     </div>
       <div class="col-sm-12 col-xl-11" style="margin-left: 2%;">
                        <div class="col-12">
                            <div class="table-responsive">
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama fitur</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Harga Fitur</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $dataa as $item )
                                    <tr>
                                        <td>{{ $item->namafitur }}</td>
                                        <td><span class="badge text-bg-success">{{ $item->status }}</span></td>
                                        <td>{{ $item->hargafitur }}</td>
                                        <td><a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailfitur{{ $item->id }}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-start mb-3">
                                <td><center><a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-check"></i>&nbsp;Setuju</a>&nbsp;
                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-xmark"></i>&nbsp;Tolak</button></center></td>
                            </div>
                        </div>
                    </div>


                     <!-- Modal Box Edit Bank Start -->
            <div class="modal fade" id="detailfitur{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="detailfiturLabel{{ $item->id }}">Detail Fitur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="col-sm-12 col-xl-11 d-flex justify-content-between" style="margin-left: 2%; margin">
                                    <div class="mb-3" style="width: 13em">
                                        <div class="form-group">
                                            <label for="input1">Nama Fitur</label>
                                            <input type="text" class="form-control" id="input1" value="{{ $item->namafitur }}" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3" style="width: 13em">
                                        <div class="form-group">
                                            <label for="input3">Harga Fitur</label>
                                            <input type="text" class="form-control" id="input3" value="{{ $item->hargafitur }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $item->deskripsi }}</textarea>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

        <!-- Modal Box Edit Bank End-->


      @include('Client.Template.footer')
        </div>
        <!-- Content End -->


    </body>
    @include('Client.Template.script')


<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
</html>

