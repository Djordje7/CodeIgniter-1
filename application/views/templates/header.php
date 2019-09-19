<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title><?=$title?></title>

	<style>
		.active {
			color: rebeccapurple;
		}
	</style>
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link <?=$page=='genres'?'active':''?>" href="/pages">Genres</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=$page=='herkunft'?'active':''?>" href="/pages/herkunft">Herkunft</a>
				</li>
			</ul>
		</div>
	</div>

	<button class="btn btn-toggle btn-danger" >Hide</button>


</div>

