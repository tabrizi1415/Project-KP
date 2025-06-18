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
			<h1 style="margin-left: 200px; margin-top: 100px;">Data Siswa</h1>
		</div>
	</div>
	<div class="content-produk">
		<button class="btn btn-tambahkan-produk" id="btn-tambahkan-produk" data-bs-toggle="modal" data-bs-target="#addSiswa"><a class="fas fa-plus-circle"></a> Tambah Siswa</i></button>
		<div style="height: 50px;"></div>
		<table class="table-produk">
			<tr>
				<th class="text-center align-middle">No</th>
				<th class="text-center align-middle">NIS</th>
				<th class="text-center align-middle">Nama Siswa</th>
				<th class="text-center align-middle">Tanggal Lahir</th>
				<th class="text-center align-middle">Alamat</th>
				<th class="text-center align-middle">Kontak</th>
				<th class="text-center align-middle">Kelas</th>
				<th class="text-center align-middle" colspan="2">Action</th>
			</tr>
			<?php
			$ambildata = mysqli_query($mysqli, "SELECT * FROM siswa left join kelas on siswa.id_kelas=kelas.id_kelas order by siswa.id_kelas asc;");
			$i = 1;
			while ($data = mysqli_fetch_array($ambildata)) {
			?>
				<tr>
					<td style="text-align: center;"><?= $i; ?></td>
					<td><?= $data["nis"]; ?></td>
					<td><?= $data["siswa"]; ?></td>
					<td><?= $data['tanggal_lahir']; ?></td>
					<td><?= $data['alamat']; ?></td>
					<td><?= $data['kontak']; ?></td>
					<td><?= $data['kelas']; ?></td>
					<td style="text-align: center;">
						<a href="#" class="action-edit" data-bs-toggle="modal" data-bs-target="#edit<?= $data['nis']; ?>"><i class="fas fa-edit"></i> Edit</a>
						<a href="#" class="action-hapus" data-bs-toggle="modal" data-bs-target="#delete<?= $data['nis']; ?>"><i class="fas fa-trash"></i> Hapus</a>
					</td>
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