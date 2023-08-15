<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran Revisi</title>
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
        .container span {
            margin-top: 20px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="coupon">
        <div class="header">
            <img src="https://i.postimg.cc/xTt6vNQN/logo.png" style="width: 3em; height: 2em; margin: 1em 0">
            <div class="wrapper" style="display: grid; align-items:center; padding:0;">
                <h2><b>PROREQ Company</b></h2>
            </div>
        </div>
        <div class="container" style="background-color:white">
            <h3 style="font-size: 1.3em">Pembayaran Revisi Disetujui</h3>
            <h3 style="font-weight: normal;">Transaksi Anda untuk pembayaran revisi project <b>{{ $project->napro }}</b> telah disetujui. Revisi yang anda ajukan telah selesai sepenuhnya sesuai kriteria yang Anda berikan kepada kami. Terima kasih atas kepercayaan Anda kepada kami.</h3>
            <span>Regards, <b>PROREQ</b> Teams.</span>
        </div>
        <div class="container" style="padding: 9px; text-align:center;">
            <span>Copyright, &copy; PROREQ - All Right Reserved</span>
        </div>
    </div>
</body>
</html>