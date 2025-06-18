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
		<h1 style="margin-left: 200px; margin-top: 100px;">Data User</h1>
	</div>
	<div class="content-produk">
		<div style="height: 50px;"></div>
		<table class="table-produk">
			<tr>
				<th class="text-center align-middle">No</th>
				<th class="text-center align-middle">ID User</th>
				<th class="text-center align-middle">No Induk</th>
				<th class="text-center align-middle">Password</th>
				<th class="text-center align-middle">Full Name</th>
				<th class="text-center align-middle">Role</th>
			</tr>
			<?php
			$ambildata = mysqli_query($mysqli, "SELECT * FROM user;");
			$i = 1;
			while ($data = mysqli_fetch_array($ambildata)) {
				$get_id_product = $data['id_user'];
			?>
				<tr>
					<td style="text-align: center;"><?= $i; ?></td>
					<td><?= $data["id_user"]; ?></td>
					<td><?= $data["no_induk"]; ?></td>
					<td><?= $data['password']; ?></td>
					<td><?= $data['fullname']; ?></td>
					<td><?= $data['role']; ?></td>
				</tr>
				<!-- Modal Add -->
				<div class="modal fade" id="addUser">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Add User</h4>
							</div>

							<!-- Modal body -->
							<?php
							$query = "SELECT MAX(id_user) AS kode FROM user";
							$sql = mysqli_query($conn, $query);
							$urut = mysqli_fetch_array($sql);
							$kode_input = $urut['kode'];
							$urutan = (int) substr($kode_input, 2, 3);
							$urutan++;
							$id_user = 'U-' . sprintf("%03s", $urutan);
							?>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_user" class="form-label fw-bold mt-2">ID User</label>
										<input type="text" name="id_user" class="form-control" value="<?= $id_user ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="no_induk" class="form-label fw-bold mt-2">No Induk</label>
										<input type="text" name="no_induk" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="password" class="form-label fw-bold mt-2">Password</label>
										<input type="text" name="password" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="fullname" class="form-label fw-bold mt-2">Full Name</label>
										<input type="text" name="fullname" class="form-control">
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="role" class="form-label fw-bold mt-2">Role</label>
										<select class="form-control" name="role" id="role">
											<option disabled>-- Select Role --</option>
											<option value="admin">Admin</option>
											<option value="guru">Guru</option>
											<option value="siswa">Siswa</option>
										</select>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary mt-3" name="addUser">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal Edit -->
				<div class="modal fade" id="edit<?= $data['id_user']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header m-3">
								<h4 class="modal-title">Edit User</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post" enctype="multipart/form-data">
								<div class="p-4">
									<div style="display: flex;">
										<label style="width: 170px;" for="id_user" class="form-label fw-bold mt-2">ID User</label>
										<input type="text" name="id_user" class="form-control" value="<?= $data['id_user'] ?>" readonly>
									</div>
									<br>
									<div style="display: flex;">
										<label style="width: 170px;" for="no_induk" class="form-label fw-bold mt-2">No Induk</label>
										<input type="text" name="no_induk" class="form-control" value="<?= $data['no_induk'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="password" class="form-label fw-bold mt-2">Password</label>
										<input type="text" name="password" class="form-control" value="<?= $data['password'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="fullname" class="form-label fw-bold mt-2">Full Name</label>
										<input type="text" name="fullname" class="form-control" value="<?= $data['fullname'] ?>">
									</div>
									<br>
									<div style=" display: flex;">
										<label style="width: 170px;" for="role" class="form-label fw-bold mt-2">Role</label>
										<input type="text" name="role" class="form-control" value="<?= $data['role'] ?>">
									</div>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="editUser">Submit</button>
										<button type="submit" class="btn btn-outline-primary mt-3">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Delete Modal -->
				<div class="modal fade" id="delete<?= $data['id_user']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete User</h4>
							</div>

							<!-- Modal body -->
							<form action="" method="post">
								<div class="modal-body">
									Apakah anda yakin ingin menghapus <strong><?= $data['fullname']; ?></strong> ?
									<input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
									<br>
									<div class=" text-center">
										<button type="submit" class="btn btn-primary mt-3" name="deleteUser">Delete</button>
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