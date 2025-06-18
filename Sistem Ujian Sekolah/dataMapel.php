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
			<h1 style="margin-left: 200px; margin-top: 100px;">Data Mapel</h1>
		</div>
	</div>
	<div class="content-produk">
		<button class="btn btn-tambahkan-produk" id="btn-tambahkan-produk" data-bs-toggle="modal" data-bs-target="#addMapel"><a class="fas fa-plus-circle"></a> Tambah Mapel</i></button>
		<div style="height: 50px;"></div>
		<table class="table-produk">
			<tr>
				<th class="text-center align-middle">No</th>
				<th class="text-center align-middle">ID Mapel</th>
				<th class="text-center align-middle">Mata Pelajaran</th>
				<th class="text-center align-middle">Nama Guru</th>
				<th class="text-center align-middle" colspan="2">Action</th>
			</tr>
			<?php
			$ambildata = mysqli_query($mysqli, "SELECT * FROM guru, mapel where mapel.id_guru=guru.nip group by mapel order by mapel.id_mapel asc;");
			$i = 1;
			while ($data = mysqli_fetch_array($ambildata)) {
				$get_id_product = $data['nip'];
			?>
				<tr>
					<td style="text-align: center;"><?= $i; ?></td>
					<td><?= $data["id_mapel"]; ?></td>
					<td><?= $data["mapel"]; ?></td>
					<td><?= $data['guru']; ?></td>
					<td style="text-align: center;">
						<a href="#" class="action-edit" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_mapel']; ?>"><i class="fas fa-edit"></i> Edit</a>
						<a href="#" class="action-hapus" data-bs-toggle="modal" data-bs-target="#delete<?= $data['id_mapel']; ?>"><i class="fas fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<!-- Modal Add -->
				<div class="modal fade" id="addMapel">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Add Mapel</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_mapel" class="form-label fw-bold mt-2">ID Mapel</label>
										<input type="text" name="id_mapel" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="mapel" class="form-label fw-bold mt-2">Mata Pelajaran</label>
										<input type="text" name="mapel" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="alamat" class="form-label fw-bold mt-2">Guru</label>
										<select class="form-control add-guru" name="id_guru" id="id_guru">
											<option value="">-- Select Guru --</option>
											<?php
											$ambilguru = mysqli_query($mysqli, "SELECT * FROM guru;");
											while ($row = mysqli_fetch_array($ambilguru)) {
												$id_guru = $row['nip'];
												$guru = $row['guru'];
												echo "<option value='$id_guru'>$guru</option>";
											}
											?>
										</select>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary mt-3" name="addMapel">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal Edit -->
				<div class="modal fade" id="edit<?= $data['id_mapel']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Edit Mapel</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_mapel" class="form-label fw-bold mt-2">ID Mapel</label>
										<input type="text" name="id_mapel" class="form-control" value="<?= $data['id_mapel'] ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="mapel" class="form-label fw-bold mt-2">Mata Pelajaran</label>
										<input type="text" name="mapel" class="form-control" value="<?= $data['mapel'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="id_guru" class="form-label fw-bold mt-2">Guru</label>
										<select class="form-control add-mapel" name="id_guru">
											<?php
											$ambilguru = mysqli_query($mysqli, "SELECT * FROM guru;");
											while ($row = mysqli_fetch_array($ambilguru)) {
												$id_guru = $row['nip'];
												$guru = $row['guru'];
												$id_guru_data = $data['nip'];

												echo "<option value='$id_guru'" . ($id_guru_data == $id_guru ? ' selected' : '') . ">$guru	</option>";
											}
											?>
										</select>
									</div>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="editMapel">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Delete Modal -->
				<div class="modal fade" id="delete<?= $data['id_mapel']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete Mapel</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post">
								<div class="modal-body">
									Apakah anda yakin ingin menghapus <strong><?= $data['mapel']; ?></strong> ?
									<input type="hidden" name="id_mapel" value="<?= $data['id_mapel']; ?>">
									<br>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="deleteMapel">Delete</button>
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