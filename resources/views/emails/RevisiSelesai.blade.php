<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revisi Selesai</title>
    <style>
        body {
        font-family: Arial;
        }

        .coupon {
        border: 5px #bbb;
        width: 80%;
        border-radius: 15px;
        margin: 0 auto;
        max-width: 600px;
        }
        .header {
            display: flex;
            padding: 2px 16px;
            background-color: #f1f1f1;
        }
        .container {
        padding: 2px 16px;
        background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="coupon">
        <div class="header">
            <img src="https://i.postimg.cc/xTt6vNQN/logo.png" style="width: 4em; height: 4em; margin: 1em 0">
            <div class="wrapper" style="display: grid; align-items:center; padding:0;">
                <h2><b>PROREQ Company</b></h2>
            </div>
        </div>
        <div class="container" style="background-color:white">
            <h3 style="font-size: 1.3em">Revisi Project Selesai</h3>
            <h3 style="font-weight: normal;">Revisi untuk project <b>{{ $project->napro }}</b> Anda telah berhasil diselesaikan. Silahkan melakukan pembayaran revisi sesuai petunjuk yang telah kami berikan.</h3>
        </div>
        <div class="container" style="padding: 9px; text-align:center;">
            <span>Copyright, &copy; PROREQ - All Right Reserved</span>
        </div>
    </div>
</body>
</html>
