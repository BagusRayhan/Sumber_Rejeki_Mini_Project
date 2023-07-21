<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
@endphp

<head>
    @include('Client.Template.head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon1.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Disetujui</p>
                                <h6 class="mb-0">{{ $setujuCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon2.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Ditolak</p>
                                <h6 class="mb-0">{{ $tolakCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon3.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Dikerjakan</p>
                                <h6 class="mb-0">{{ $kerjaCounter }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <img class="w-25" src="{{ asset('ProjectManagement/dashmin/img/icon4.png') }}" alt="">
                            <div class="ms-1">
                                <p class="mb-2">Project Selesai</p>
                                <h6 class="mb-0">{{ $selesaiCounter }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4" style="width: 66%;">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Estimasi</h6>
                            </div>

                            @if (count($estimasi) > 0)
                                @foreach ($estimasi as $estimasisetuju)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <a href="{{ route('setujuclient', ['id' => $estimasisetuju->id]) }}" class="d-flex w-100" style="text-decoration: none; color: inherit;">
                                            <img class="rounded-circle flex-shrink-0" style="width: 3em; height: 3em; object-fit: cover;" src="/gambar/user-profile/{{ $estimasisetuju->user->profil }}">
                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="mb-2">{{ $estimasisetuju->napro }}</h6>
                                                @if ($estimasisetuju->estimasi != null)
                                                    <span><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;{{ $estimasisetuju->estimasi->diffForHumans() }}</span>
                                                @else
                                                    <span>Estimasi tidak tersedia</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-xl-5" style="margin-left:26%;">
                                                <div class="bg-light rounded h-100 p-10">
                                                    <div class="pg-bar mb-3">
                                                @if ($estimasisetuju->progress == null)
                                                    <div class="wrapper">
                                                        <h6>Progress Project</h6>
                                                        <div class="pg-bar">
                                                            <div class="progress">
                                                                <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress }}%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        var progressBar = document.getElementById('progress-bar');
                                                        var totalFeatures = {{ count($fitur) }};
                                                        var completedFeatures = 0;
                                                        var progress = 0;

                                                        @foreach ($fitur as $f)
                                                        @if ($f->status == 'selesai' && $f->project_id == $client->id)
                                                            completedFeatures++;
                                                        @endif
                                                        @endforeach

                                                        function animateProgressBar() {
                                                            if (progress < (completedFeatures / totalFeatures) * 100) {
                                                                progress += 1; 
                                                                progressBar.style.width = progress + '%';
                                                                progressBar.setAttribute('aria-valuenow', progress);
                                                                requestAnimationFrame(animateProgressBar);
                                                            }
                                                        }

                                                        animateProgressBar();
                                                    </script>
                                                @else
                                                <div class="wrapper mt-3">
                                                    <h6>Progress Project</h6>
                                                    <div class="pg-bar">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $estimasisetuju->progress }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    var progressBar = document.getElementById('progress-bar');
                                                    var totalFeatures = {{ count($fitur) }};
                                                    var completedFeatures = 0;
                                                    var progress = 0;
                                                    var projectProgress = {{ $estimasisetuju->progress }};

                                                    @foreach ($fitur as $f)
                                                        @if ($f->status == 'selesai' && $f->project_id == $client->id)
                                                            completedFeatures++;
                                                        @endif
                                                    @endforeach

                                                    function animateProgressBar() {
                                                        if (completedFeatures > 0) {
                                                            if (progress < (completedFeatures / totalFeatures) * 100) {
                                                                progress += 1; 
                                                                progressBar.style.width = progress + '%';
                                                                progressBar.setAttribute('aria-valuenow', progress);
                                                                requestAnimationFrame(animateProgressBar);
                                                            }
                                                        } else {
                                                            progress = projectProgress;
                                                        }

                                                        if (progress < 100) {
                                                            progressBar.style.width = progress + '%';
                                                            progressBar.setAttribute('aria-valuenow', progress);
                                                            requestAnimationFrame(animateProgressBar);
                                                        }
                                                    }

                                                    animateProgressBar();
                                                </script>
                                                @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" style="width:65px;">
                                    <p>Estimasi tidak tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>



                        <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Pesan</h6>
                        {{-- <a class="link-offset-2 link-underline link-underline-opacity-0" href="#">Tampilkan Semua</a> --}}
                        </div>
                        @if (count($pesancht) !== 0)
                        @foreach ($pesancht as $pesan)
                            <div class="d-flex align-items-center border-bottom py-3">
                                {{-- <a href="{{ route('detailsetujui', ['id' => $pesan->id]) }}" style="text-decoration: none; color: inherit;"> --}}
                                    <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $pesan->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                    <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{ $pesan->user->name }}</h6>
                                        <small>{{ Carbon::parse($pesan->chat_time)->locale('id')->isoFormat('HH:MM') }}</small>
                                        </div>
                                        <span>{{ $pesan->chat }}</span>
                        </div>
                        </a>
                </div>
            @endforeach
        @else
        <div class="d-flex flex-column h-100 justify-content-center align-items-center">
            <img src="gambar/empty-icon/empty-directory.png" style="width:65px;" >
            <p>Pesan tidak tersedia</p>
        </div>
        @endif
    </div>
</div>

                    </div>
                </div>


                @include('Client.Template.footer')
                        </div>
                    </div>
                </div>
            </div>
            @include('Client.Template.script')

</body>


</html>
