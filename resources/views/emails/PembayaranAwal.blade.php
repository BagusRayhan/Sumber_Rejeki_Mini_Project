<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran Awal</title>
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
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
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
            <img src="https://i.postimg.cc/xTt6vNQN/logo.png" alt="PROREQ Logo">
            <h2>PROREQ Company</h2>
        </div>
        <div class="container">
            <h3>Pembayaran Awal Disetujui</h3>
            <p>Transaksi Anda untuk pembayaran awal project <b>{{ $project->napro }}</b> telah disetujui. Tim kami akan bekerja keras untuk memenuhi semua permintaan Anda agar kami bisa memberikan yang terbaik untuk Anda. Terima kasih atas kepercayaan Anda kepada kami.</p>
        </div>
        <div class="footer">
            <p>&copy; PROREQ - All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
