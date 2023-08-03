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
                        <a href="{{ route('detailsetujui', ['id' => $estimasisetuju->id]) }}" class="d-flex w-100" style="text-decoration: none; color: inherit;">
                            <img class="rounded-circle flex-shrink-0" style="width: 3em; height: 3em; object-fit: cover;" src="/gambar/user-profile/{{ $estimasisetuju->user->profil }}">
                            <div class="ms-3 flex-grow-1">
                                <h6 class="mb-2">{{ $estimasisetuju->napro }}</h6>
                                <span class="mb-5">Rp. {{ number_format($estimasisetuju->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="col-sm-12 col-xl-5" >
                                <div class="bg-light rounded h-100 p-10">
                                    <div class="pg-bar mb-3">
                                        @if ($estimasisetuju->progress == null)
                                            <h6 class="mb-2"></h6>
                                            @if ($estimasisetuju->estimasi != null)
                                                <span class="float-end"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;{{ $estimasisetuju->estimasi->diffForHumans() }}</span>
                                            @else
                                                <span class="float-end">Estimasi belum diatur</span>
                                            @endif
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
                    <p>Belum Ada Project</p>
                </div>
            @endif
             </div>
            </div>


            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-start mb-2">
                        <h6 class="mb-0">Pesan</h6>
                    </div>
                    <div class="chat-list">
                        @if (count($message) !== 0)
                            @foreach ($message->where('user_id', Auth::user()->id)->sortByDesc('created_at') as $msg)
                                @if ($msg->status == 'setuju' || $msg->status == 'pengajuan revisi')
                                    <button class="btn btn-block mb-2 w-100 d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#adminChat{{ $msg->id }}" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="wrapper d-flex">
                                            <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $admin->profil }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="wrapper mx-2 d-flex flex-column align-items-start">
                                                <h6 class="mb-1">{{ ucfirst($admin->name) }}</h6>
                                                <span style="font-size: 12px">{{ $msg->napro }}</span>
                                            </div>
                                        </div>
                                        <small>{{ Carbon::parse($msg->chat_time)->locale('id')->isoFormat('HH:MM') }}</small>
                                    </button>
                                    <div class="collapse" id="adminChat{{ $msg->id }}" data-bs-parent=".chat-list">
                                        <div class="list-group d-flex flex-column-reverse">
                                            @if (count($msg->projectchat) !== 0)
                                                @foreach ($msg->projectchat->whereIn('user_id', $admin_id)->sortByDesc('created_at')->take(3) as $cht)
                                                    <a href="{{ ($msg->status == 'setuju') ? route('detailsetujui', ['id' => $msg->id]) : (($msg->status == 'pengajuan revisi') ? route('revisibutton', ['id'=>$msg->id]) : '') }}" class="list-group-item list-group-item-action" style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap">{{ $cht->chat }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('detail-disetujui-admin', ['id' => $msg->id]) }}" style="text-decoration: none; color: inherit;">
                                        <div class="collapse message-content">
                                            @if (count($msg->projectchat) !== 0)
                                                @foreach ($msg->projectchat as $chat)
                                                    <p>{{ $chat->chat }}</p>
                                                @endforeach
                                            @else
                                                <p>Tidak ada pesan</p>
                                            @endif
                                        </div>
                                    </a>
                                @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada pesan masuk</p>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                <p>Tidak ada pesan masuk</p>
                            </div>
                        @endif
                    </div>
                    {{-- @if (count($pesancht) !== 0)
                        @foreach ($pesancht as $pesan)
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $pesan->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h6 class="mb-0">{{ $pesan->user->name }}</h6> &nbsp; &nbsp;
                                        <small>{{ Carbon::parse($pesan->chat_time)->locale('id')->isoFormat('HH:mm') }}</small>
                                        <button class="btn btn-link ms-auto mt-10 toggle-messages-btn" data-target="#messageContent{{ $loop->index }}">
                                            <i class="fas fa-sort-desc"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <a href="{{ route('detailsetujui', ['id' => $pesan->id]) }}" style="text-decoration: none; color: inherit;">
                            <div class="collapse message-content" id="messageContent{{ $loop->index }}">
                                <p>{{ $pesan->chat }}</p>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                            <img src="gambar/empty-icon/empty-directory.png" style="width: 65px;">
                            <p>Pesan tidak tersedia</p>
                        </div>
                    @endif --}}
                </div>
            </div>


            <!-- Moved the script below the HTML content to ensure the elements are loaded before applying the script -->
            <script>
                $(document).ready(function () {
                    $('.toggle-messages-btn').on('click', function () {
                        var target = $(this).data('target');
                        $(target).collapse('toggle');
                        $(this).find('i').toggleClass('fa-sort-desc fa-sort-up');
                    });
                });
            </script>




                         {{-- <span>{{ $pesan->chat }}</span>
                            </div>
                        </div>
                        <div id="messageContent{{ $pesan->id }}" class="collapse message-content">
                        </div> --}}




                    </div>
                </div>
                @include('Client.Template.footer')
                </div>
            </div>
            @include('Client.Template.script')

</body>


</html>



{{-- <a href="{{ route('detailsetujui', ['id' => $pesan->id]) }}" style="text-decoration: none; color: inherit;">
    <div class="collapse message-content" id="messageContent{{ $loop->index }}">
        @if (count($pesan->projectchat) !== 0)
            @foreach ($pesan->projectchat as $chatt)
                <p>{{ $pesan->chat }}</p>
            @endforeach
        @else
            <p>Tidak ada pesan</p>
        @endif
        </div>
        </a> --}}
