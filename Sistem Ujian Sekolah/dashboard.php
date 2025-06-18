<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: index.php");
	exit();
}

require 'functions/functions.php';

?>

<?php include "header.php"; ?>

<main>
	<h1>Daftar Mata Pelajaran</h1>
	<br class="mb-5">
	<div class="row d-flex">
		<?php
		$ambildata = mysqli_query($mysqli, "SELECT * FROM guru, mapel where mapel.id_guru=guru.nip;");
		while ($data = mysqli_fetch_array($ambildata)) {
		?>
			<div class="card col-4 m-4 p-3">
				<h2><?= $data['mapel']; ?></h2>
				<p><?= $data['guru']; ?> - <?= $data['nip']; ?></p>
				<?php
				if (isset($_SESSION['role']) && $_SESSION['role'] == "Guru") {
				?>
					<a href="soal.php" class="btn btn-primary">Ke Halaman Soal</a>
				<?php
				} else if (isset($_SESSION['role']) && $_SESSION['role'] == "Siswa") {
				?>
					<a href="ujian.php" class="btn btn-primary">Ke Halaman Ujian</a>
				<?php
				} else {
				?>
					<a href="dataMapel.php" class="btn btn-primary">Ke Halaman Mapel</a>
				<?php
				}
				?>

			</div>
		<?php
		}
		?>
	</div>

</main>

<?php include "footer.php"; ?>