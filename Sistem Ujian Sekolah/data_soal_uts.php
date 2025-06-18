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
	<div>
		<div class="d-flex">
			<ul style="display: flex;">
				<li class="mx-1"><a class="btn btn-primary" href="data_soal_uts.php">Ujian Tengah Semester</a></li>
				<li class="mx-1"><a class="btn btn-primary" href="data_soal_uas.php">Ujian Akhir Semester</a></li>
			</ul>
			<?php
			$getUserLogin  = $_SESSION['fullname'];
			$ambildata = mysqli_query($mysqli, "SELECT * FROM mapel, guru where mapel.id_guru=guru.nip and guru='$getUserLogin';");
			$ambilmapel = mysqli_fetch_array($ambildata);
			?>
		</div>
		<div>
			<h2 style="margin-left: 200px; margin-top: 100px;">Data Soal - Ujian Tengah Semester - <?= $ambilmapel['mapel']; ?></h2>
		</div>
	</div>
	<div class="container mt-5">
		<div class="content-produk">
			<a href="buat_soal_uts.php" class="btn btn-tambahkan-produk">
				<i class="fas fa-plus-circle"></i> Tambah Soal
			</a>
			<div style="height: 50px;"></div>
			<?php
			$getUserLogin  = $_SESSION['fullname'];
			$ambildata = mysqli_query($mysqli, "SELECT * FROM mapel, guru WHERE mapel.id_guru=guru.nip AND guru='$getUserLogin';");
			$ambilmapel = mysqli_fetch_array($ambildata);

			$getmapel = $ambilmapel['id_mapel'];
			$soalQuery = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian IN (
                SELECT id_ujian FROM ujian WHERE id_mapel='$getmapel' and jenis_ujian='Ujian Tengah Semester'
            );");
			?>
			<table class="table-produk">
				<thead>
					<tr>
						<th>No</th>
						<th>Soal</th>
						<th>Pilihan</th>
						<th>Jawaban Benar</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					while ($soal = mysqli_fetch_array($soalQuery)) {
						$opsi = explode(",", $soal['opsi']);
					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $soal['soal']; ?></td>
							<td>
								<ul>
									<?php foreach ($opsi as $pilihan) : ?>
										<li><?= $pilihan; ?></li>
									<?php endforeach; ?>
								</ul>
							</td>
							<td><?= $soal['jawaban_benar']; ?></td>
							<td style="text-align: center; width: 100px;">
								<a href="#" class="action-edit" data-bs-toggle="modal" data-bs-target="#edit<?= $soal['id_soal']; ?>"><i class="fas fa-edit"></i> Edit</a>
								<br>
								<br>
								<a href="#" class="action-hapus" data-bs-toggle="modal" data-bs-target="#delete<?= $soal['id_soal']; ?>"><i class="fas fa-trash"></i> Hapus</a>
							</td>
						</tr>


						<!-- Modal Edit -->
						<div class="modal fade" id="edit<?= $soal['id_soal']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header m-3">
										<h4 class="modal-title">Edit Soal</h4>
									</div>

									<!-- Modal body -->
									<form action="" method="post" enctype="multipart/form-data">
										<div class="container p-4">
											<!-- Soal Input -->
											<div class="row mb-3">
												<label for="soal" class="col-sm-3 col-form-label fw-bold">Soal</label>
												<input type="text" name="id_soal" class="form-control" value="<?= $soal['id_soal'] ?>" hidden>
												<div class="col-sm-9">
													<textarea name="soal" class="form-control" rows="4"><?= $soal['soal'] ?></textarea>
												</div>
											</div>

											<!-- Opsi Input -->
											<div class="mb-4">
												<?php
												$opsi = explode(",", $soal['opsi']);
												$alphabet = ['A', 'B', 'C', 'D', 'E']; // Mengatur kunci opsi A, B, C, D, E
												foreach ($opsi as $index => $ops) {
												?>
													<div class="row mb-3">
														<label for="opsi" class="col-sm-3 col-form-label fw-bold">Opsi <?= $alphabet[$index] ?></label>
														<div class="col-sm-9">
															<textarea name="jawaban<?= $alphabet[$index] ?>" class="form-control" rows="2"><?= $ops ?></textarea>
														</div>
													</div>
												<?php
												}
												?>
											</div>

											<!-- Jawaban Benar -->
											<div class="row mb-3">
												<label for="jawaban_benar" class="col-sm-3 col-form-label fw-bold">Jawaban Benar</label>
												<div class="col-sm-9">
													<textarea name="jawaban_benar" class="form-control" rows="2"><?= $soal['jawaban_benar'] ?></textarea>
												</div>
											</div>

											<!-- Tombol Submit -->
											<div class="text-center">
												<button type="submit" class="btn btn-primary btn-lg mt-3" name="editSoalUAS">Submit</button>
												<button class="btn btn-outline-secondary btn-lg mt-3">Close</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div>

						<!-- Modal Delete -->
						<div class="modal fade" id="delete<?= $soal['id_soal']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Delete Soal</h4>
									</div>

									<!-- Modal body -->
									<form action="" method="post">
										<div class="modal-body">
											Apakah anda yakin ingin menghapus soal <strong><?= $soal['id_soal']; ?></strong> ?
											<input type="hidden" name="id_soal" value="<?= $soal['id_soal']; ?>">
											<br>
											<div class=" text-center">
												<button type="submit" class="btn btn-primary mt-3" name="deleteSoal">Delete</button>
												<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</main>

<?php include "footer.php"; ?>