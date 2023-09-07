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
                <div class="d-flex w-50">
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
                                    <textarea id="summernote" name="content">{{ $data1->kebijakan}}</textarea><br>
                                    <button type="submit" style="float: right;" class="btn btn-primary">Simpan</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex w-50">
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
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email" value="{{ $data->email }}">
                                <br>
                                <button type="submit" style="float: right;" class="btn btn-primary">Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex w-50">
                    <div class="container mt-4 d-flex">
                        <div class="card w-100" style="background: #f3f6f9">
                            <div class="card-body">
                            <h5 class="card-title">Edit About Us</h5>
                            <form action="{{ route('update-aboutus') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <textarea class="form-control" name="about" id="aboutUs" rows="12">{{ $about->about }}</textarea>
                                <button type="submit" class="btn btn-primary float-end mt-3">Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex w-50">
                    <div class="container mt-4 d-flex">
                        <div class="card w-100" style="background: #f3f6f9">
                            <div class="card-body">
                                <div class="wrapper w-100 d-flex justify-content-between">
                                    <h5 class="card-title">FAQ</h5>
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addFAQModal"><i class="fa-solid fa-circle-plus"></i></button>
                                    {{-- add FAQ Modal --}}
                                    <div class="modal fade" id="addFAQModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah FAQ</h1>
                                                </div>
                                                <form action="{{ route('add-faq') }}" method="post">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <div class="input-group mb-3 d-flex flex-column">
                                                                <label for="question" class="form-label">Pertanyaan</label>
                                                                <input type="text" name="question" id="question" class="form-control w-100" placeholder="Masukkan pertanyaan ...">
                                                            </div>
                                                            <div class="input-group mb-3 d-flex flex-column">
                                                                <label for="answer" class="form-label">Jawaban</label>
                                                                <textarea name="answer" id="answer" rows="8" class="form-control w-100" placeholder="Masukkan jawaban ..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                @if (count($faqs) !== 0)
                                <ul class="list-group px-3" style="overflow-y: scroll; height: 24em;">
                                    @foreach ($faqs as $faq)
                                        <li class="list-group-item mb-1 d-flex justify-content-between">
                                            <style>
                                            .p-question {
                                                max-height: 50px;
                                                overflow: hidden;
                                            }
                                            </style>
                                            <p class="my-auto p-question">{{ $faq->question }}</p>
                                            <div class="d-flex align-items-center">
                                                <div class="wrapper">
                                                    <button class="btn btn-block p-0 mx-2" type="button" data-bs-toggle="modal" data-bs-target="#editFAQModal{{ $faq->id }}"><i class="fa-solid fa-pen-to-square fs-6"></i></button>
                                                </div>
                                                <form action="{{ route('delete-faq', ['faq_id' => $faq->id]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-block p-0 mx-2 delete-button">
                                                        <i class="fa-solid fa-trash fs-6"></i>
                                                    </button>
                                                </form>                                                                                                                                            
                                                <script>
                                                    document.querySelectorAll('.delete-button').forEach(function(button) {
                                                        button.addEventListener('click', function(event) {
                                                            event.preventDefault();
                                                            const form = this.parentElement; // Dapatkan form terkait dengan tombol yang diklik
                                                            Swal.fire({
                                                                title: 'Apakah Anda yakin?',
                                                                text: 'Menghapus FAQ',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    form.submit(); // Submit form jika pengguna mengonfirmasi
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>                                                
                                            </div>
                                            {{-- Edit FAQ Modal --}}
                                            <div class="modal fade" id="editFAQModal{{ $faq->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit FAQ</h1>
                                                        </div>
                                                        <form action="{{ route('edit-faq') }}" method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="faq_id" value="{{ $faq->id }}">
                                                                <div class="mb-3">
                                                                    <div class="input-group mb-3 d-flex flex-column">
                                                                        <label for="question" class="form-label">Pertanyaan</label>
                                                                        <input type="text" name="question" id="question" value="{{ $faq->question }}" class="form-control w-100" placeholder="Masukkan pertanyaan ...">
                                                                    </div>
                                                                    <div class="input-group mb-3 d-flex flex-column">
                                                                        <label for="answer" class="form-label">Jawaban</label>
                                                                        <textarea name="answer" id="answer" rows="8" class="form-control w-100" placeholder="Masukkan jawaban ...">{{ $faq->answer }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @else
                                    <div class="wrapper h-100 w-100 d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{ asset('gambar/empty-icon/empty-directory.png') }}" class="w-25">
                                        <p>Tidak ada data</p>
                                    </div>
                                @endif
                            </div>
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
