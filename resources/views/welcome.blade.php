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
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>PRO<span>REQ</span></h1>
            <h2>Bangun aplikasi yang anda inginkan dengan sekali ketukan</h2>
            <div class="d-flex">
                <a href="{{ route('register') }}" class="btn-get-started scrollto">Get Started</a>
            </div>
        </div>
    </section>
    <!-- End Hero -->
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tentang Kami</h2>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{asset('gambar/whoproreq.png')}}" class="img-fluid w-75 rounded" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <h3>Tentang PROREQ</h3>
                        <p class="fst-italic">{{ $about->about }}</p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Layanan <span>Kami</span></h3>
                    <p>Kami menyediakan beragam layanan yang dirancang untuk memenuhi kebutuhan Anda dalam dunia teknologi dan bisnis. Berikut adalah beberapa layanan unggulan kami</p>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Aplikasi Website</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Aplikasi Mobile</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Desain Grafis</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>F.A.Q</h2>
                    <h3>Frequently Asked <span>Questions</span></h3>
                    <p>Beberapa pertanyaan umum yang sering diajukan ketika menggunakan jasa kami</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <ul class="faq-list">
                            @if (count($faqs) !== 0)
                            @foreach ($faqs as $faq)   
                                <li>
                                    <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{ $faq->id }}">{{ $faq->question }} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                    <div id="faq{{ $faq->id }}" class="collapse" data-bs-parent=".faq-list">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </li>
                            @endforeach
                            @else
                            <div class="wrapper text-center">
                                <h6>Empty</h6>
                            </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Frequently Asked Questions Section -->

    </main>
    <!-- End #main -->

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
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Beranda</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('kebijakan') }}">Kebijakan & Privasi</a></li>
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