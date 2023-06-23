<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kebijakan Privasi</title>
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
    <style>
        #kebijakan p {
            margin-bottom: 10px;
        }
    </style>


</head>
<body>

    <div style="padding: 2em">
        <h4>Kebijakan Privasi</h4><br>
        <div class="wrapper">
            {!! nl2br($dataa->kebijakan) !!}
        </div>
    </div><br>

    <div class="text-center">
        <button class="btn btn-primary" onclick="goBack()" style="width: 10em; border-radius: 32px;">Accept</button>
    </div><br>

<script>
  function goBack() {
    window.history.back();
  }
</script>

</body>
</html>
