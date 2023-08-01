<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
@endphp

<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link href="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.3/dist/apexcharts.min.js"></script>

<!-- Add the script for the ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>

@include('Admin.templates.head')

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

            <!-- Counter Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-regular fa-user fa-2x text-primary"></i>
                            <div class="ms-1">
                                <p class="mb-2">Jumlah Client</p>
                                <h6 class="mb-0">{{ $clientCounter }}</h6>
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
                                <h6 class="mb-0">{{ $progressCounter }}</h6>
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
            <!-- Counter End -->

            <!-- Monthly Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="w-100">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-start mb-4">
                            <div class="" style="width: 1100px">
                                <div id="myChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Chart End -->

            <!-- Annualy Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="w-100">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-start mb-4">
                            <div class="" style="width: 1100px">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Annualy Chart End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 mb-5">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <h6 class="mb-0">Project Masuk</h6>
                            </div>
                            @if (count($incomeProject) !== 0)
                                @foreach ($incomeProject as $inc)
                                    <div class="border-bottom py-3">
                                        <a href="{{ route('detailproreq', ['id' => $inc->id]) }}" class="text-decoration-none d-flex text-dark">
                                            <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $inc->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                            {{-- <img class="rounded-circle flex-shrink-0" src="{{ asset('ProjectManagement/dashmin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;"> --}}
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-0">{{ $inc->user->name }}</h6>
                                                    {{-- <small>{{ $inc->harga }}</small> --}}
                                                </div>
                                                <span>{{ $inc->napro }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada project masuk</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <h6 class="mb-0">Pembayaran Masuk</h6>
                            </div>
                            @if (isset($incomePayment) && count($incomePayment) !== 0)
                                @foreach ($incomePayment as $inc)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <a href="{{ route('pending-bayar-admin', ['id' => $inc->id]) }}" style="text-decoration: none; color: inherit;">
                                            <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $inc->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-0">{{ $inc->user->name }}</h6>
                                                    {{-- <small>{{ $inc->harga }}</small> --}}
                                                    <small>Rp.{{ number_format($inc->harga, 0, ',', '.') }}</small>
                                                </div>
                                                <span>{{ $inc->napro }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                    <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                    <p>Tidak ada pembayaran masuk</p>
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
                                    @foreach ($message->sortByDesc('created_at') as $msg)
                                    @if ($msg->status == 'setuju' || $msg->status == 'pengajuan revisi')
                                    <button class="btn btn-block mb-2 w-100 d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#clientChat{{ $msg->id }}" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="wrapper d-flex">
                                            <img class="rounded-circle flex-shrink-0" src="/gambar/user-profile/{{ $msg->user->profil }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="wrapper mx-2 d-flex flex-column align-items-start">
                                                <h6 class="mb-1">{{ $msg->user->name }}</h6>
                                                <span style="font-size: 12px">{{ $msg->napro }}</span>
                                            </div>
                                        </div>
                                        <small>{{ Carbon::parse($msg->chat_time)->locale('id')->isoFormat('HH:MM') }}</small>
                                    </button>
                                    <div class="collapse" id="clientChat{{ $msg->id }}" data-bs-parent=".chat-list">
                                        <div class="list-group d-flex flex-column-reverse">
                                            @if (count($msg->projectchat) !== 0)
                                                @foreach ($msg->projectchat->sortByDesc('created_at')->take(3) as $cht)
                                                    <a href="{{ ($msg->status == 'setuju') ? route('detail-disetujui-admin', ['id' => $msg->id]) : (($msg->status == 'pengajuan revisi') ?  : '') }}" class="list-group-item list-group-item-action" style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap">{{ $cht->chat }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('detail-disetujui-admin', ['id' => $msg->id]) }}" style="text-decoration: none; color: inherit;">
                                        <div class="collapse message-content" id="messageContent{{ $loop->index }}">
                                            @if (count($msg->projectchat) !== 0)
                                                @foreach ($msg->projectchat as $chat)
                                                    <p>{{ $chat->chat }}</p>
                                                @endforeach
                                            @else
                                                <p>Tidak ada pesan</p>
                                            @endif
                                        </div>
                                    </a>
                                    @endif
                                    @endforeach
                                @else
                                    <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                                        <img src="gambar/empty-icon/empty-directory.png" class="w-50">
                                        <p>Tidak ada pesan masuk</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('.toggle-messages-btn').on('click', function () {
                                var target = $(this).data('target');
                                $(target).collapse('toggle');
                                $(this).find('i').toggleClass('fa-sort-desc fa-sort-up');
                            });
                        });
                    </script>


            <!-- Widgets End -->
        </div>
        <!-- Content End -->

    </div>

    {{-- <script src="{{ $chart->cdn() }}"></script> --}}
    {{-- {{ $chart->script() }} --}}


    {{ $ychart->script() }}

    @include('Admin.templates.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js" integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>


        var options = {
          chart: {
            height: 350,
            type: "line",
            stacked: false
          },
          dataLabels: {
            enabled: false
          },
          colors: ["#FF1654", "#247BA0"],
          series: [
            {
              name: "Series A",
              data: [{{ $tahun22 }}, {{ $tahun23 }}, {{ $tahun24 }}, {{ $tahun25 }}] // Replace the sample data with the yearData array
            },

          ],
          stroke: {
            width: [8, 8]
          },
          plotOptions: {
            bar: {
              columnWidth: "20%"
            }
          },
          xaxis: {
            categories: ['2022', '2023', '2024', '2025'] // Replace the sample categories with the labels array
          },
          yaxis: [
            {
              axisTicks: {
                show: true
              },
              axisBorder: {
                show: true,
                color: "#FF1654"
              },
              labels: {
                style: {
                  colors: "#FF1654"
                }
              },
              title: {
                text: "Project Selesai",
                style: {
                  color: "#FF1654"
                }
              }
            },

          ],
          tooltip: {
            shared: false,
            intersect: true,
            x: {
              show: false
            }
          },
          legend: {
            horizontalAlign: "left",
            offsetX: 40
          }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

    <script>
        // Assuming you have the PHP variable $selesaiProjectsyear available in JavaScript
        const selesaiProjects = @JSON($selesaiProjects);

        // Function to get month name from month number
        function getMonthName(monthNumber) {
          const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
          return monthNames[monthNumber - 1];
        };

        // Prepare an array with count data for each month (initialize with zeros)
        const countData = Array(12).fill(0);

        // Update count data with actual counts from the $selesaiProjects variable
        selesaiProjects.forEach(project => {
          const monthIndex = project.month - 1;
          countData[monthIndex] = project.count;
        });

        // Get month names for the labels
        const labels = countData.map((_, index) => getMonthName(index + 1));

        var options = {
          series: [{
            data: countData, // Use the countData array here instead of hardcoded values
          }],
          chart: {
            type: 'bar',
            height: 350,
          },
          plotOptions: {
            bar: {
              borderRadius: 4,
              horizontal: false,
            }
          },
          dataLabels: {
            enabled: false,
          },
          xaxis: {
            categories: labels, // Use the labels array to show month names on the x-axis
          }
        };

        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
    </script>
    <script>
        // Sample data (replace this with your actual data)
        const chartData = [
            {
                x: 'Jan',
                y: 30,
            },
            {
                x: 'Feb',
                y: 40,
            },
            {
                x: 'Mar',
                y: 25,
            },
            // Add more data points as needed
        ];

        // Chart options
        const chartOptions = {
            chart: {
                type: 'line',
            },
            series: [
                {
                    name: 'Sales',
                    data: chartData,
                },
            ],
            xaxis: {
                type: 'category',
            },
        };

        // Initialize the chart
        const apexChart = new ApexCharts(document.querySelector('#apexChart'), chartOptions);
        apexChart.render();
    </script>








</body>
