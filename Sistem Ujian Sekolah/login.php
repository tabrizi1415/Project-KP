<?php

session_start();
require 'functions/functions.php';
if (isset($_COOKIE['siposid'])) {
	$siposid = $_COOKIE['siposid'];

	$result = mysqli_query($conn, "SELECT * FROM user where no_induk = '$siposid'");
	$row = mysqli_fetch_assoc($result);
}
if (isset($_SESSION["login"])) {
	header("Location: dashboard.php");
	exit();
}
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result =  mysqli_query($conn, "SELECT * FROM user WHERE no_induk = '$username'");

	// $hasil = mysqli_query($conn, "SELECT * FROM user, guru, siswa where guru.id_user=user.id_user and siswa.id_user=user.id_user and no_induk = '$siposid'");
	// $hasil = mysqli_query($conn, "SELECT * FROM user, guru, siswa where guru.id_user=user.id_user and siswa.id_user=user.id_user and no_induk = '$username'");
	// $baris = mysqli_fetch_assoc($hasil);


	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if ($password = $row["password"]) {
			$_SESSION["login"] = true;
			$_SESSION['fullname'] = $row['fullname'];
			$_SESSION['no_induk'] = $row['no_induk'];
			$_SESSION['role'] = $row['role'];
			setcookie('siposid', hash('sha256', $row['username']));
			header("Location: dashboard.php");
			exit;
		}
	}
	$error = true;
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login - Sistem Ujian</title>
	<link rel="shortcut icon" type="image/ico" href="assets/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="assets/styles/reset.css">
	<link rel="stylesheet" type="text/css" href="assets/styles/style.css">
	<script type="text/javascript" src="assets/js/login.js"></script>
	<script src="https://kit.fontawesome.com/6606a30803.js" crossorigin="anonymous"></script>
</head>

<body style="background: #dfe6e9;">
	<div class="login-box-container">

		<!-- LOGIN FORM START -->
		<div class="login-box">
			<h2 class="login-title">Login</h2>
			<div>
				<form action="" method="post">
					<input type="username" placeholder="Username" name="username" class="form-login" required>
					<input type="password" placeholder="Password" name="password" class="form-login" required>
					<button type="submit" class="btn-login" name="login">Login</button>
				</form>
				<br>
			</div>
		</div>
		<!-- LOGIN FORM END -->

		<!-- MODAL FAILED LOGIN START -->
		<div id="modal-login-failed" class="modal" <?php if ($error) : ?> style="display: block;" <?php endif ?>>
			<!-- Modal content -->
			<div class="modal-content modal-notification">
				<div class="notification">
					<i class="fas fa-times-circle notification-icon-failed"></i>
					<p class="notification-text">Kombinasi username dan password salah!</p>
					<button class="btn btn-confirmation" id="btn-confirmation" onclick="closeModal();">Tutup</button>
				</div>
			</div>
		</div>
		<!-- MODAL FAILED LOGIN END -->

		<!-- SIDE CONTENT START -->
		<div class="login-side-box">
			<h2 class="login-siposweb-title">SMK AL HUSNA</h2>
			<p class="login-desc">Sistem Informasi Ujian Berbasis Website</p>
		</div>
		<!-- SIDE CONTENT END -->
	</div>

</body>

</html>