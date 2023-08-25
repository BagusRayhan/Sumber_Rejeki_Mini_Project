<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tidak Tersedia</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>4<span>0</span>4</h1>
            </div>
            <h2>Halaman yang Anda minta tidak dapat ditemukan</h2>
            <a href="{{ url()->previous() }}" class="back-button">Kembali</a>
            {{-- <form class="notfound-search">
                <input type="text" placeholder="Search...">
                <button type="button"><span></span></button>
            </form> --}}
        </div>
    </div>

</body>

</html>
