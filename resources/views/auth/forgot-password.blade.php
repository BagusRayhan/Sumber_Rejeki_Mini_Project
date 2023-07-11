<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/etc/lf/Login_v4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 06:45:50 GMT -->

<head>
    <title>Lupa Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/animsition/css/animsition.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/vendor/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('colorlib.com/css/main.css') }}">

    <meta name="robots" content="noindex, follow">
    </head>

<body>
<div class="limiter">
<div class="container-login100" style="background-image: url('{{ asset('ProjectManagement/dashmin/img/bgl.png') }}');">
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
<span class="login100-form-title p-b-49">
Forgot Password
</span>
<form class="login100-form validate-form" action="{{ route('password.email') }}" method="POST">
@csrf
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if(session()->has ('status'))
<div class="alert alert-success">
{{ session ()->get('status') }}
</div>
@endif

<div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
<span class="label-input100">Email</span>
<input class="input100" type="email" name="email" placeholder="Masukkan email anda" required>
<span class="focus-input100" data-symbol="&#xf15a;"></span>
</div>

    <div class="text-left p-t-8 p-b-31">
        <input type="checkbox" id="acceptCheckbox" onchange="toggleLoginButton()"> <a href="kebijakan">Kebijakan Privasi</a>
    </div>

<div class="container-login100-form-btn">
<div class="wrap-login100-form-btn">
<div class="login100-form-bgbtn"></div>
<input type="submit" value="Reset"  id="resetButton"  class="login100-form-btn bg-primary">
</div>
</div>

<div class="flex-col-c p-t-50">
 <span class="txt1 p-b-17">
Sudah punya akun ?
<a href="{{ route('login') }}" class="txt2">
Login
</a></span>
</div>
</form>
<script>
    function toggleLoginButton() {
        const checkbox = document.getElementById('acceptCheckbox');
        const resetButton = document.getElementById('resetButton');

        resetButton.disabled = !checkbox.checked;
    }
</script>
</div>
</div>
</div>
<div id="dropDownSelect1"></div>

<script src="{{ asset('colorlib.com/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('colorlib.com/vendor/animsition/js/animsition.min.js') }}"></script>

<script src="{{ asset('colorlib.com/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('colorlib.com/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('colorlib.com/vendor/select2/select2.min.js') }}"></script>

<script src="{{ asset('colorlib.com/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('colorlib.com/vendor/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('colorlib.com/vendor/countdowntime/countdowntime.js') }}"></script>


<script src="{{ asset('colorlib.com/js/main.js') }}"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7d3f2afcd8c64acd","version":"2023.4.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}' crossorigin="anonymous"></script>
</body>

<!-- Mirrored from colorlib.com/etc/lf/Login_v4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 06:45:55 GMT -->
</html>
