<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran Akhir</title>
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
            margin: 0;
            font-size: 1.1em;
            line-height: 1.6;
        }

        #webconfig {
            margin-top: 1em;
        }

        .regards {
            margin-top: 1.5em;
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
            <h3>Konfigurasi Website Selesai</h3>
            <p>Project anda telah selesai sepenuhnya sesuai kriteria yang Anda berikan kepada kami. Jika project Anda belum sepenuhnya sempurna, silahkan ajukan revisi agar kami bisa memberikan yang terbaik untuk Anda. Terima kasih atas kepercayaan Anda kepada kami.</p>
            <div id="webconfig">
                <p><b>Website Information</b></p>
                <p>Website Address : <a href="{{ $project->webaddress }}">{{ $project->webaddress }}</a></p>
                <p>IP Address : <a href="{{ $project->ipaddress }}">{{ $project->ipaddress }}</a></p>
                @if ($project->repository !== null)
                    <p>Repository : <a href="{{ $project->repository }}">{{ $project->repository }}</a></p>
                @endif
                <p><b>Admin Account</b></p>
                <p>Email : {{ $project->adminemail }}</p>
                <p>Password : {{ $project->adminpassword }}</p>
                @if ($project->cpanelusername !== null)
                    <p><b>Database Access</b></p>
                    <p>CPanel Username : {{ $project->cpanelusername }}</p>
                    <p>CPanel Password : {{ $project->cpanelpassword }}</p>
                @endif
            </div>
            <div class="regards">
                <span>Regards, <b>PROREQ</b> Teams.</span>
            </div>
        </div>
        <div class="footer">
            <p>&copy; PROREQ - All Rights Reserved</p>
        </div>
    </div>
</body>
</html>

