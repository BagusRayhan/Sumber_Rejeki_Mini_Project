<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Halaman Tidak Tersedia</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var goHomeButton = document.querySelector("#notfound a");
			goHomeButton.addEventListener("click", function(event) {
				event.preventDefault();
				history.back();
			});
		});
	</script>

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Oops!</h1>
			</div>
			<h2>404 - Page not found</h2>
			<p>Halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau untuk sementara tidak tersedia.</p>
			<a href="#">Return to previous page</a>
		</div>
	</div>

</body>

</html>
