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
			<h1 style="margin-left: 200px; margin-top: 100px;">Data Kelas</h1>
		</div>
	</div>
	<div class="content-produk">
		<button class="btn btn-tambahkan-produk" id="btn-tambahkan-produk" data-bs-toggle="modal" data-bs-target="#addKelas"><a class="fas fa-plus-circle"></a> Tambah Kelas</i></button>
		<div style="height: 50px;"></div>
		<table class="table-produk">
			<tr>
				<th class="text-center align-middle">No</th>
				<th class="text-center align-middle">ID Kelas</th>
				<th class="text-center align-middle">Kelas</th>
				<th class="text-center align-middle">Ruangan</th>
				<th class="text-center align-middle">Ketua Kelas</th>
				<th class="text-center align-middle" colspan="2">Action</th>
			</tr>
			<?php
			$ambildata = mysqli_query($mysqli, "SELECT * FROM kelas;");
			$i = 1;
			while ($data = mysqli_fetch_array($ambildata)) {
				$get_id_product = $data['id_kelas'];
			?>
				<tr>
					<td style="text-align: center;"><?= $i; ?></td>
					<td><?= $data["id_kelas"]; ?></td>
					<td><?= $data["kelas"]; ?></td>
					<td><?= $data['ruangan']; ?></td>
					<td><?= $data['ketua_kelas']; ?></td>
					<td style="text-align: center;">
						<a href="#" class="action-edit" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_kelas']; ?>"><i class="fas fa-edit"></i> Edit</a>
						<a href="#" class="action-hapus" data-bs-toggle="modal" data-bs-target="#delete<?= $data['id_kelas']; ?>"><i class="fas fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<!-- Modal Add -->
				<div class="modal fade" id="addKelas">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Add Kelas</h4>
							</div>

							<!-- Modal body -->
							<?php
							$query = "SELECT MAX(id_kelas) AS kode FROM kelas";
							$sql = mysqli_query($conn, $query);
							$urut = mysqli_fetch_array($sql);
							$kode_input = $urut['kode'];
							$urutan = (int) substr($kode_input, 2, 3);
							$urutan++;
							$id_kelas = 'K-' . sprintf("%03s", $urutan);
							?>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_kelas" class="form-label fw-bold mt-2">ID Kelas</label>
										<input type="text" name="id_kelas" class="form-control" value="<?= $id_kelas ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="kelas" class="form-label fw-bold mt-2">Kelas</label>
										<input type="text" name="kelas" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="ruangan" class="form-label fw-bold mt-2">Ruangan</label>
										<input type="text" name="ruangan" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="ketua_kelas" class="form-label fw-bold mt-2">Ketua Kelas</label>
										<input type="text" name="ketua_kelas" class="form-control">
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary mt-3" name="addKelas">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal Edit -->
				<div class="modal fade" id="edit<?= $data['id_kelas']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Edit Kelas</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_kelas" class="form-label fw-bold mt-2">ID Kelas</label>
										<input type="text" name="id_kelas" class="form-control" value="<?= $data['id_kelas'] ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="kelas" class="form-label fw-bold mt-2">Kelas</label>
										<input type="text" name="kelas" class="form-control" value="<?= $data['kelas'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="ruangan" class="form-label fw-bold mt-2">Ruangan</label>
										<input type="text" name="ruangan" class="form-control" value="<?= $data['ruangan'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="ketua_kelas" class="form-label fw-bold mt-2">Ketua Kelas</label>
										<input type="text" name="ketua_kelas" class="form-control" value="<?= $data['ketua_kelas'] ?>">
									</div>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="editKelas">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Delete Modal -->
				<div class="modal fade" id="delete<?= $data['id_kelas']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete Kelas</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post">
								<div class="modal-body">
									Apakah anda yakin ingin menghapus <strong><?= $data['kelas']; ?></strong> ?
									<input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">
									<br>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="deleteKelas">Delete</button>
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