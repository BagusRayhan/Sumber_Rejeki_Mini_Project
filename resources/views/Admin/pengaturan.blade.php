<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.templates.head')
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

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">
            @include('Admin.templates.navbar')


            <div class="d-flex justify-content-between">
                <!-- Privacy Policy Start -->
                <div class="d-flex justify-content-start w-50">
                <div class="container mt-4">
                    <div class="card" style="background: #f3f6f9">
                        <div class="card-body">
                            <div id="editor">
                                <h5 class="card-title">Edit Kebijakan Privasi</h5>
                                <form action="{{ route('updatekebijakan') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                {{-- @foreach ($data1 as $item) collection
                                <textarea id="summernote" name="content">{{ $item->kebijakan }}</textarea><br>
                                @endforeach --}}
                                <textarea id="summernote" name="content">{{ $data1->kebijakan }}</textarea><br>
                                <button type="submit" style="float: right;" class="btn btn-primary">Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end w-50">
                <div class="container mt-4 d-flex">
                    <div class="card w-100" style="background: #f3f6f9">
                        <div class="card-body">
                          <h5 class="card-title">Edit Sosmed</h5>
                          <form action="{{ route('updatesosmed') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">WhatsApp</label><br>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="wa" id="wa" value="{{ $data->wa }}"><br>

                            <label for="">Instagram</label><br>
                            <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="ig" id="ig" value="{{ $data->ig }}"><br>

                            <label for="">Email</label><br>
                            <input type="email" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email" value="{{ $data->email }}">

                            <br>
                            <button type="submit" style="float: right;" class="btn btn-primary">Simpan</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Content End -->

        @include('Admin.templates.script')


        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300,
                    minHeight: 300,
                    maxHeight: 300,
                    focus: true
                });

                let content = $('#summernote').summernote('code');
                console.log(content);
            });
        </script>
    </div>
</body>
</html>
