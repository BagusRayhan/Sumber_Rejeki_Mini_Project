<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/etc/lf/Login_v4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 06:45:50 GMT -->
<head>
<title>Sign Up</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/bootstrap/css/bootstrap.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/fonts/iconic/css/material-design-iconic-font.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/animate/animate.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/css-hamburgers/hamburgers.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/animsition/css/animsition.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/select2/select2.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/vendor/daterangepicker/daterangepicker.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('colorlib/css/main.css') }}">

<meta name="robots" content="noindex, follow">
<script nonce="0b346717-10af-42c9-8801-f9ff4d347d27">(function(w,d){!function(dK,dL,dM,dN){dK[dM]=dK[dM]||{};dK[dM].executed=[];dK.zaraz={deferred:[],listeners:[]};dK.zaraz.q=[];dK.zaraz._f=function(dO){return function(){var dP=Array.prototype.slice.call(arguments);dK.zaraz.q.push({m:dO,a:dP})}};for(const dQ of["track","set","debug"])dK.zaraz[dQ]=dK.zaraz._f(dQ);dK.zaraz.init=()=>{var dR=dL.getElementsByTagName(dN)[0],dS=dL.createElement(dN),dT=dL.getElementsByTagName("title")[0];dT&&(dK[dM].t=dL.getElementsByTagName("title")[0].text);dK[dM].x=Math.random();dK[dM].w=dK.screen.width;dK[dM].h=dK.screen.height;dK[dM].j=dK.innerHeight;dK[dM].e=dK.innerWidth;dK[dM].l=dK.location.href;dK[dM].r=dL.referrer;dK[dM].k=dK.screen.colorDepth;dK[dM].n=dL.characterSet;dK[dM].o=(new Date).getTimezoneOffset();if(dK.dataLayer)for(const dX of Object.entries(Object.entries(dataLayer).reduce(((dY,dZ)=>({...dY[1],...dZ[1]})),{})))zaraz.set(dX[0],dX[1],{scope:"page"});dK[dM].q=[];for(;dK.zaraz.q.length;){const d_=dK.zaraz.q.shift();dK[dM].q.push(d_)}dS.defer=!0;for(const ea of[localStorage,sessionStorage])Object.keys(ea||{}).filter((ec=>ec.startsWith("_zaraz_"))).forEach((eb=>{try{dK[dM]["z_"+eb.slice(7)]=JSON.parse(ea.getItem(eb))}catch{dK[dM]["z_"+eb.slice(7)]=ea.getItem(eb)}}));dS.referrerPolicy="origin";dS.src="../../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(dK[dM])));dR.parentNode.insertBefore(dS,dR)};["complete","interactive"].includes(dL.readyState)?zaraz.init():dK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document);</script></head>
<body>
<div class="limiter">
<div class="container-login100" style="background-image: url('{{ asset('colorlib/images/bg-01.jpg') }}');">
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
<form class="login100-form validate-form">
<span class="login100-form-title p-b-49">
REGISTER
</span>
<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
<span class="label-input100">Name</span>
<input class="input100" type="text" name="username" placeholder="Type your name">
<span class="focus-input100" data-symbol="&#xf206;"></span>
</div>

<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
<span class="label-input100">Email</span>
<input class="input100" type="text" name="username" placeholder="Type your email">
<span class="focus-input100" data-symbol="&#xf206;"></span>
</div>

<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
<span class="label-input100">Password</span>
<input class="input100" type="password" name="pass" placeholder="Type your password">
<span class="focus-input100" data-symbol="&#xf190;"></span>
</div>

<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
<span class="label-input100">Confirm Password</span>
<input class="input100" type="password" name="pass" placeholder="Type your confirm password">
<span class="focus-input100" data-symbol="&#xf190;"></span>
</div>



<div class="text-left p-t-8 p-b-31">
    <input type="checkbox"> <a href="">Kebijakan Privasi</a>
</div>


<div class="container-login100-form-btn">
<div class="wrap-login100-form-btn">
<div class="login100-form-bgbtn"></div>
<button class="login100-form-btn">
SIGN UP
</button>
</div>
</div>

<div class="flex-col-c p-t-50">
 <span class="txt1 p-b-17">
Atau Masuk Menggunakan
</span>
<a href="{{ route('login') }}" class="txt2">
Sign In
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
