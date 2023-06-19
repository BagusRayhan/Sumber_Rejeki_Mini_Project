<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.templates.head')

    <link rel="stylesheet" href="{{ asset('ProjectManagement/summernote/summernote-bs4.css') }}">
    <script src="{{ asset('ProjectManagement/summernote/summernote-bs4.js') }}"></script>
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
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="editor">
                                <h5 class="card-title">Edit Kebijakan Privasi</h5>
                                <textarea id="summernote" name="content"></textarea><br>
                                <button type="button" style="float: right;" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">Edit Sosmed</h5>
                        <label for="">WhatsApp</label><br>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="" id=""><br>

                        <label for="">Instagram</label><br>
                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="" id=""><br>

                        <label for="">Facebook</label><br>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="" id="">
                        <br>
                        <button type="button" style="float: right;" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->

        @include('Client.Template.script')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
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
