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
		<?php include "headerdata.php"; ?>
		<div>
			<?php
			$getUserLogin  = $_SESSION['fullname'];
			?>
			<h1 style="margin-left: 200px; margin-top: 100px;">Data Nilai</h1>
		</div>
	</div>
	<div class="content-produk">
		<div style="height: 50px;"></div>
		<table class="table-produk">
			<tr>
				<th class="text-center align-middle" rowspan="2">No</th>
				<th class="text-center align-middle" rowspan="2">NIS</th>
				<th class="text-center align-middle" rowspan="2">Nama Siswa</th>
				<th class="text-center align-middle" rowspan="2">Mata Pelajaran</th>
				<th class="text-center align-middle" colspan="5">Ujian</th>
			</tr>
			<tr>

				<th class="text-center align-middle">Ujian Tengah Semester</th>
				<th class="text-center align-middle">Ujian Akhir Semester</th>
				<th class="text-center align-middle">Batas Nilai Minimum</th>
				<th class="text-center align-middle">Nilai Akhir</th>
				<th class="text-center align-middle">Hasil Akhir</th>
			</tr>
			<?php
			$ambildata = mysqli_query($mysqli, "SELECT * FROM siswa, nilai, ujian, mapel where nilai.id_siswa=siswa.nis and nilai.id_ujian=ujian.id_ujian and ujian.id_mapel=mapel.id_mapel group by siswa, mapel order by siswa asc;");
			$i = 1;
			while ($data = mysqli_fetch_array($ambildata)) {
			?>
				<tr>
					<td style="text-align: center;"><?= $i; ?></td>
					<td><?= $data["nis"]; ?></td>
					<td><?= $data["siswa"]; ?></td>
					<td><?= $data["mapel"]; ?></td>
					<?php
					$siswa = $data['nis'];
					$mapel = $data['id_mapel'];
					$ambilnilai = mysqli_query($mysqli, "SELECT * FROM nilai, ujian where nilai.id_ujian=ujian.id_ujian and nilai.id_siswa='$siswa' and ujian.id_mapel='$mapel';");
					$i = 1;
					$nilaiawal = 0;
					while ($nilai = mysqli_fetch_array($ambilnilai)) {
						$nilaiawal += $nilai['nilai'];
					?>
						<td class="text-center"><?= $nilai['nilai']; ?></td>
					<?php
					}
					$nilaiakhir = $nilaiawal / 2;
					?>
					<td class="text-center">65</td>
					<td class="text-center"><?= $nilaiakhir; ?></td>
					<?php
					if ($nilaiakhir < 65) {
					?>
						<td class="text-center"><i class="btn btn-danger">Gagal</i></td>
					<?php
					} else {
					?>
						<td class="text-center"><i class="btn btn-success">Lulus</i></td>
					<?php
					}
					?>
				</tr>
				<!-- Modal Add -->
				<div class="modal fade" id="addSiswa">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<?php
							$query = "SELECT MAX(id_user) AS kode FROM user";
							$sql = mysqli_query($conn, $query);
							$urut = mysqli_fetch_array($sql);
							$kode_input = $urut['kode'];
							$urutan = (int) substr($kode_input, 2, 3);
							$urutan++;
							$id_user = 'U-' . sprintf("%03s", $urutan);
							?>
							<div class="modal-header m-3">
								<h4 class="modal-title">Add Siswa</h4>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="nis" class="form-label fw-bold mt-2">NIS</label>
										<input type="text" name="id_user" class="form-control" hidden value="<?= $id_user; ?>">
										<input type="text" name="nis" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="siswa" class="form-label fw-bold mt-2">Nama Siswa</label>
										<input type="text" name="siswa" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="tanggal_lahir" class="form-label fw-bold mt-2">Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="alamat" class="form-label fw-bold mt-2">Alamat</label>
										<input type="text" name="alamat" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="kontak" class="form-label fw-bold mt-2">Kontak</label>
										<input type="text" name="kontak" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="id_kelas" class="form-label fw-bold mt-2">Kelas</label>
										<select class="form-control add-guru" name="id_kelas" id="id_kelas">
											<option value="">-- Select Kelas --</option>
											<?php
											$ambilkelas = mysqli_query($mysqli, "SELECT * FROM kelas;");
											while ($row = mysqli_fetch_array($ambilkelas)) {
												$id_kelas = $row['id_kelas'];
												$kelas = $row['kelas'];
												echo "<option value='$id_kelas'>$kelas</option>";
											}
											?>
										</select>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary mt-3" name="addSiswa">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal Edit -->
				<div class="modal fade" id="edit<?= $data['nis']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Edit Siswa</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="nis" class="form-label fw-bold mt-2">NIS</label>
										<input type="text" name="nis" class="form-control" value="<?= $data['nis'] ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="siswa" class="form-label fw-bold mt-2">Nama Siswa</label>
										<input type="text" name="siswa" class="form-control" value="<?= $data['siswa'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="tanggal_lahir" class="form-label fw-bold mt-2">Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="alamat" class="form-label fw-bold mt-2">Alamat</label>
										<input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="kontak" class="form-label fw-bold mt-2">Kontak</label>
										<input type="text" name="kontak" class="form-control" value="<?= $data['kontak'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="id_kelas" class="form-label fw-bold mt-2">id_kelas</label>
										<select class="form-control add-kelas" name="id_kelas">
											<?php
											$ambilkelas = mysqli_query($mysqli, "SELECT * FROM kelas;");
											while ($row = mysqli_fetch_array($ambilkelas)) {
												$id_kelas = $row['id_kelas'];
												$kelas = $row['kelas'];
												$id_kelas_data = $data['id_kelas'];

												echo "<option value='$id_kelas'" . ($id_kelas_data == $id_kelas ? ' selected' : '') . ">$kelas	</option>";
											}
											?>
										</select>
									</div>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="editSiswa">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Delete Modal -->
				<div class="modal fade" id="delete<?= $data['nis']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete Siswa</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post">
								<div class="modal-body">
									Apakah anda yakin ingin menghapus <strong><?= $data['siswa']; ?></strong> ?
									<input type="hidden" name="nis" value="<?= $data['nis']; ?>">
									<br>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="deleteSiswa">Delete</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			<?php
				$i++;
			}
			?>
		</table>
	</div>
</main>

<?php include "footer.php"; ?>