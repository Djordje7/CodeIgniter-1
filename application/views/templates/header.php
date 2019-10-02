<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= $title ?></title>

	<!-- Bootstrap JS - load here so we can use inline-js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Select2 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= assets_dir() ?>css/site.css">
	<link rel="icon" href="<?= assets_dir() ?>img//favicon.ico" type="image/x-icon">

</head>
<body>


<div class="container">
	<div class="row">
		<div class="col">
			<ul class="nav ">
				<li class="nav-item">
					<a class="nav-link <?= $page == 'not_found' ? 'active' : '' ?>" href="/pages/not_found">Not Found</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= $page == 'zugriff' ? 'active' : '' ?>" href="/pages/zugriff">Zugriff</a>
				</li>
				<?php if ($page == 'add_spiel') { ?>
					<li class="nav-item">
						<a class="nav-link <?= $page == 'add_spiel' ? 'active' : '' ?>" href="/pages/add_spiel">Spiel erfassen</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php
$flashdata = $this->session->flashdata();
if ($flashdata) { ?>
	<div class="container">
		<div class="row">
			<div class="col">
				<?php
				if (isset($flashdata['msg'])) {
					?>
					<div class="alert alert-primary" role="alert"><?= $flashdata['msg'] ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
