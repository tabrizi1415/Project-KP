<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: index.php");
	exit();
}

require 'functions/functions.php';

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["tambah_produk_btn"])) {
	// Ambil data dari setiap elemen dalam form
	$id = $_POST["id-produk"];
	$nama = $_POST["nama-produk"];
	$harga = $_POST["harga"];
	$stock = $_POST["stock"];

	// Query insert data
	$query = "INSERT INTO produk VALUES ('$id', '$nama', $harga, $stock)";
}

// Cek apakah tombol edit sudah ditekan
if (isset($_POST["edit_produk_btn"])) {
	// Ambil data dari setiap elemen dalam form
	$id = $_POST["id-produk"];
	$nama = $_POST["nama-produk"];
	$harga = $_POST["harga"];
	$stock = $_POST["stock"];

	// Query insert data
	$query = "UPDATE produk SET nama = '$nama', harga = $harga, stock = $stock WHERE id = '$id'";
}
?>
<?php include "header.php"; ?>

<main>
	<div>
		<h1 style="margin-left: 200px;">Jadwal Ujian</h1>
	</div>
	<div class="content-produk">
		<button class="btn btn-tambahkan-produk" id="btn-tambahkan-produk" data-bs-toggle="modal" data-bs-target="#addJadwal"><a class="fas fa-plus-circle"></a> Tambah Jadwal</i></button>
		<table class="table-produk">
			<thead>
				<tr>
					<th rowspan="2" class="text-center align-middle">No</th>
					<th rowspan="2" class="text-center align-middle">Hari</th>
					<th rowspan="2" class="text-center align-middle">Jam</th>
					<th colspan="5" class="text-center align-middle">Kelas</th>
				</tr>
				<tr>
					<?php
					$ambildata = mysqli_query($mysqli, "SELECT * FROM kelas order by id_kelas asc;");
					while ($kelas = mysqli_fetch_array($ambildata)) {
					?>
						<th class="text-center align-middle"><?= $kelas['kelas']; ?></th>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$ambildata = mysqli_query($mysqli, "SELECT * FROM jadwal, kelas, mapel, guru where jadwal.id_kelas=kelas.id_kelas and jadwal.id_mapel=mapel.id_mapel and mapel.id_guru=guru.nip group by hari, jam order by id_jadwal asc;");
				while ($data = mysqli_fetch_array($ambildata)) {
					$get_id_product = $data['id_jadwal'];
				?>
					<tr>
						<td style="text-align: center;"><?= $i; ?></td>
						<td><?= $data["hari"]; ?></td>
						<td><?= $data["jam"]; ?></td>
						<?php
						$jam = $data['jam'];
						$ambilmapel2 = mysqli_query($mysqli, "SELECT * FROM jadwal
JOIN kelas ON jadwal.id_kelas = kelas.id_kelas
JOIN mapel ON jadwal.id_mapel = mapel.id_mapel
JOIN guru ON mapel.id_guru = guru.nip
WHERE jadwal.jam = '$jam' 
ORDER BY jadwal.id_jadwal ASC");
						while ($baris = mysqli_fetch_array($ambilmapel2)) {
						?>
							<td><?= $baris["mapel"]; ?></td>
						<?php
						}
						?>
					</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- Modal Add -->
	<div class="modal fade" id="addJadwal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header m-3">
					<h4 class="modal-title">Add Jadwal</h4>
				</div>

				<!-- Modal body -->
				<?php
				$query = "SELECT MAX(id_jadwal) AS kode FROM jadwal";
				$sql = mysqli_query($conn, $query);
				$urut = mysqli_fetch_array($sql);
				$kode_input = $urut['kode'];
				$urutan = (int) substr($kode_input, 2, 3);
				$urutan++;
				$id_jadwal = 'J-' . sprintf("%03s", $urutan);
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="p-4">
						<div style="display: flex;">
							<label style="width: 170px;" for="id_jadwal" class="form-label fw-bold mt-2">ID Jadwal</label>
							<input type="text" name="id_jadwal" class="form-control" value="<?= $id_jadwal ?>" readonly>
						</div>
						<br>
						<div style="display: flex;">
							<label style="width: 170px;" for="hari" class="form-label fw-bold mt-2">Hari</label>
							<input type="text" name="hari" class="form-control">
						</div>
						<br>
						<div style="display: flex;">
							<label style="width: 170px;" for="jam" class="form-label fw-bold mt-2">jam</label>
							<input type="text" name="jam" class="form-control">
						</div>
						<br>
						<div style="display: flex;">
							<label style="width: 170px;" for="id_mapel" class="form-label fw-bold mt-2">Mata Pelajaran</label>
							<select class="form-control add-guru" name="id_mapel" id="id_mapel">
								<option value="">-- Select Mata Pelajaran --</option>
								<?php
								$ambilmapel = mysqli_query($mysqli, "SELECT * FROM mapel;");
								while ($row = mysqli_fetch_array($ambilmapel)) {
									$id_mapel = $row['id_mapel'];
									$mapel = $row['mapel'];
									echo "<option value='$id_mapel'>$mapel</option>";
								}
								?>
							</select>
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
							<button type="submit" class="btn btn-primary mt-3" name="addJadwal">Submit</button>
							<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?php include "footer.php"; ?>