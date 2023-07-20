<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PROREQ | Request Project</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('ProjectManagement/BizLand/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('ProjectManagement/BizLand/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ProjectManagement/BizLand/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
        <a href="#">
            <img src="{{ asset('ProjectManagement/dashmin/img/logo.png') }}" class="w-25">
        </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ route('welcome') }}#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('welcome') }}#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('welcome') }}#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
    <main id="main">
        <!-- ======= Services Section ======= -->
        <section id="privacypolicy" class="privacypolicy">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Privacy Policy</h2>
                    <h3>Kebijakan <span>Privasi</span></h3>
                    <p>Silahkan baca dengan seksama kebijakan privasi kami untuk memahami bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi yang Anda berikan kepada kami.</p>
                </div>
                <div class="row d-flex justify-content-center">
                    {!! $privacypolicy->kebijakan !!}
                </div>
            </div>
        </section>
        <!-- End Services Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>PROREQ</h3>
                        <p>Penyedia layanan pembuatan website.</p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Peta Situs</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('welcome') }}#hero">Beranda</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('welcome') }}#about">Tentang Kami</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('welcome') }}#services">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Kebijakan & Privasi</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Layanan Kami</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Aplikasi Website</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Aplikasi Mobile</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Desain Grafis</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Media Sosial</h4>
                        <p>Hubungi kami untuk info lebih lanjut</p>
                        <div class="social-links mt-3">
                            @foreach ($sosmed as $s)
                                <a href="https://wa.me/62{{ $s->wa }}" target="_blank" class="facebook"><i class="bx bxl-whatsapp"></i></a>
                            @endforeach
                            @foreach ($sosmed as $s)
                            <a href="https://instagram.com/{{ $s->ig }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                            @endforeach
                            @foreach ($sosmed as $s)
                            <a href="mailto:{{ $s->email }}" target="_blank" class="google-plus"><i class="bx bi-envelope"></i></a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>PROREQ</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('ProjectManagement/BizLand/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('ProjectManagement/BizLand/assets/js/main.js') }}"></script>

</body>

</html>