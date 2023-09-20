<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Method Not Allowed</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var goHomeButton = document.querySelector("#notallowed a");
			goHomeButton.addEventListener("click", function(event) {
				event.preventDefault();
				history.back();
			});
		});
	</script>

</head>

<body>

	<div id="notallowed">
		<div class="notallowed">
			<div class="notallowed-405">
				<h1>Oops!</h1>
			</div>
			<h2>405 - Method not allowed</h2>
			<p>Metode yang Anda gunakan tidak diizinkan.</p>
			<a href="#">Return to previous page</a>
		</div>
	</div>

</body>

</html>
