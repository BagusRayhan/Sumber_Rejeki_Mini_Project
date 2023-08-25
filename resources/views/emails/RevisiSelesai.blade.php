<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revisi Selesai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .coupon {
            border: 5px solid #bbb;
            width: 80%;
            border-radius: 15px;
            margin: 0 auto;
            max-width: 600px;
            background-color: white;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #f1f1f1;
        }

        .header img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .container {
            padding: 20px;
        }

        h3 {
            font-size: 1.5em;
            margin-top: 0;
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
        }

        .footer {
            padding: 15px;
            text-align: center;
            background-color: #f1f1f1;
            font-size: 0.9em;
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
            <p>Revisi untuk project <b>{{ $project->napro }}</b> Anda telah berhasil diselesaikan.Kami senang memberitahu Anda bahwa revisi proyek Anda telah selesai dikerjakan. Kami telah memperhatikan setiap detail untuk memastikan kepuasan Anda.

                Mohon untuk segera melunasi biaya revisi sesuai dengan kesepakatan. Setelah pembayaran berhasil, kami akan memberikan Anda hasil revisi sesegera mungkin.

                Terima kasih atas kerjasama Anda dalam menghadirkan proyek ini ke tingkat yang lebih baik. Kami menantikan respons Anda.</p>
        </div>
        <div class="container" style="padding: 9px; text-align:center;">
            <span>Copyright, &copy; PROREQ - All Right Reserved</span>
        </div>
    </div>
</body>
</html>
