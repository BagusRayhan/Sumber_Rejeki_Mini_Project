<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/etc/lf/Login_v4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 06:45:50 GMT -->
@include('template.head')
<body>
<div class="limiter">
<div class="container-login100" style="background-image: url('{{ asset('colorlib/images/bg-01.jpg') }}');">
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
<form class="login100-form validate-form">
<span class="login100-form-title p-b-49">
Login
</span>
<div class="wrap-input100 validate-input m-b-23" data-validate="Email is reauired">
    <span class="label-input100">Email</span>
    <input class="input100" type="text" name="email" placeholder="Type your email">
    <span class="focus-input100" data-symbol="&#xf15a;"></span>
  </div>

<div class="wrap-input100 validate-input" data-validate="Password is required">
<span class="label-input100">Password</span>
<input class="input100" type="password" name="pass" placeholder="Type your password">
<span class="focus-input100" data-symbol="&#xf190;"></span>
</div>

<div class="text-right p-t-8 p-b-31">
<a href="{{ route('forgot') }}">
Forgot password?
</a>
</div>


<div class="container-login100-form-btn">
<div class="wrap-login100-form-btn">
<div class="login100-form-bgbtn"></div>
<button class="login100-form-btn">
SIGN IN
</button>
</div>
</div>
<div class="flex-col-c p-t-50">
 <span class="txt1 p-b-17">
Don't have a account?
</span>
<a href="{{ route('register') }}" class="txt2">
Sign Up
</a>
</div>
</form>
</div>
</div>
</div>
<div id="dropDownSelect1"></div>

<script src="{{ asset('colorlib/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('colorlib/vendor/animsition/js/animsition.min.js') }}"></script>

<script src="{{ asset('colorlib/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('colorlib/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('colorlib/vendor/select2/select2.min.js') }}"></script>

<script src="{{ asset('colorlib/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('colorlib/vendor/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('colorlib/vendor/countdowntime/countdowntime.js') }}"></script>

<script src="js/main.js"></script>

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
