    <!DOCTYPE html>
    <html lang="en">
    <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
    @include('Client.Template.head')
    </head>
@php
    use \Carbon\Carbon;
@endphp
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


        <!-- Confirm Payment Table Start -->
        <div class="container-fluid pt-4 px-4" style="margi">
            <div class="py-4 d-flex justify-content-between ">
            <div class="row">
                <div class="col-10 col-md-6">
                    <div class="search-form">
                        <form action="{{ route('drequestclient') }}" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill" placeholder="Search ...">
                                <button class="btn btn-primary rounded-circle"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="col-15 col-md-9">
                <div class="wrapper">
                    <a href="{{ route('showproj') }}" class="btn btn-primary btn-sm">Request Project</a>
                </div>
            </div>
            </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Client</th>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col" class="text-center" style="width: 8em">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) !== 0)
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->napro }}</td>
                                    <td><span class="badge {{ ($item->status == 'draft') ? 'text-bg-danger' : 'bg-warning' }}">{{ $item->status }}</span></td>
                                    <td>{{ Carbon::parse($item->deadline)->locale('id')->isoFormat('HH:MM, DD MMMM YYYY') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('editproreq', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('destroy-pending-request') }}" method="post" onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="project_id" value="{{ $item->id }}">
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        </div>
                                        <!-- Sweet Alert JS -->
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

                               <script>
                                    function confirmDelete(event) {
                                        event.preventDefault();

                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: 'Ingin membatalkan project ini!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, batalkan!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                event.target.submit();
                                            }
                                        });
                                    }
                                    
                                    document.querySelector('.btn-danger').addEventListener('click', confirmDelete);
                                </script>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data</td>
                                </tr>
                                @endif
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
    <div class="bottom" style="">
        
    </div>
</div>
@include('Client.Template.footer')
<!-- Content End -->
    
</body>
        @include('Client.Template.script')
        @include('sweetalert::alert')


    <!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:45:02 GMT -->
    </html>
