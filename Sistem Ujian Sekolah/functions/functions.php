<?php
require 'database.php';

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "praktikum_ujian");

if (isset($_POST["addKelas"])) {
	// Ambil data dari setiap elemen dalam form
	$id_kelas = $_POST["id_kelas"];
	$kelas = $_POST["kelas"];
	$ruangan = $_POST["ruangan"];
	$ketua_kelas = $_POST["ketua_kelas"];

	// Query insert data
	$addToTable = mysqli_query($conn, "INSERT INTO kelas (id_kelas, kelas, ruangan, ketua_kelas) VALUES ('$id_kelas', '$kelas', '$ruangan', '$ketua_kelas');");
	if ($addToTable) {
	} else {
	}
}

if (isset($_POST['editKelas'])) {
	$id_kelas = $_POST["id_kelas"];
	$kelas = $_POST["kelas"];
	$ruangan = $_POST["ruangan"];
	$ketua_kelas = $_POST["ketua_kelas"];

	$addToTable = mysqli_query($conn, "UPDATE kelas SET kelas='$kelas', ruangan='$ruangan', ketua_kelas='$ketua_kelas' WHERE id_kelas='$id_kelas'");
	if ($addToTable) {
		// header('location:index.php');
	} else {
	}
}

if (isset($_POST['deleteKelas'])) {
	$id_kelas = $_POST['id_kelas'];

	$addToTable = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");
	if ($addToTable) {
		// header('location:index.php');
	} else {
	}
}

if (isset($_POST["addGuru"])) {
	// Ambil data dari setiap elemen dalam form
	$nip = $_POST["nip"];
	$guru = $_POST["guru"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$alamat = $_POST["alamat"];
	$id_user = $_POST["id_user"];

	// Query insert data
	$tanggalObj = new DateTime($tanggal_lahir);
	$password = $tanggalObj->format('dmy');
	$addToTable2 = mysqli_query($conn, "INSERT INTO user (id_user, no_induk, password, fullname, role) VALUES ('$id_user', '$nip', '$password', '$guru', 'Guru');");
	$addToTable1 = mysqli_query($conn, "INSERT INTO guru (nip, guru, tanggal_lahir, alamat, id_user) VALUES ('$nip', '$guru', '$tanggal_lahir', '$alamat', '$id_user');");
}

if (isset($_POST['editGuru'])) {
	$nip = $_POST["nip"];
	$guru = $_POST["guru"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$alamat = $_POST["alamat"];

	$tanggalObj = new DateTime($tanggal_lahir);
	$password = $tanggalObj->format('dmy');
	$addToTable2 = mysqli_query($conn, "UPDATE user SET no_induk='$nip', password='$password', fullname='$guru' WHERE no_induk='$nip'");
	$addToTable1 = mysqli_query($conn, "UPDATE guru SET guru='$guru', tanggal_lahir='$tanggal_lahir', alamat='$alamat' WHERE nip='$nip'");
}

if (isset($_POST['deleteGuru'])) {
	$nip = $_POST['nip'];

	$addToTable2 = mysqli_query($conn, "DELETE FROM user WHERE no_induk='$nip'");
	$addToTable1 = mysqli_query($conn, "DELETE FROM guru WHERE nip='$nip'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST["addMapel"])) {
	// Ambil data dari setiap elemen dalam form
	$id_mapel = $_POST["id_mapel"];
	$mapel = $_POST["mapel"];
	$id_guru = $_POST["id_guru"];

	// Query insert data
	$addToTable = mysqli_query($conn, "INSERT INTO mapel (id_mapel, mapel, id_guru) VALUES ('$id_mapel', '$mapel', '$id_guru');");
	if ($addToTable) {
		// header('location:jadwal.php');
	} else {
		// header('location:dashboard.php');
	}
}

if (isset($_POST['editMapel'])) {
	$id_mapel = $_POST["id_mapel"];
	$mapel = $_POST["mapel"];
	$id_guru = $_POST["id_guru"];

	$addToTable = mysqli_query($conn, "UPDATE mapel SET mapel='$mapel', id_guru='$id_guru' WHERE id_mapel='$id_mapel'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST['deleteMapel'])) {
	$id_mapel = $_POST['id_mapel'];

	$addToTable = mysqli_query($conn, "DELETE FROM mapel WHERE id_mapel='$id_mapel'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST["addSiswa"])) {
	// Ambil data dari setiap elemen dalam form
	$nis = $_POST["nis"];
	$siswa = $_POST["siswa"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$alamat = $_POST["alamat"];
	$kontak = $_POST["kontak"];
	$id_kelas = $_POST["id_kelas"];
	$id_user = $_POST['id_user'];

	// Query insert data
	$tanggalObj = new DateTime($tanggal_lahir);
	$password = $tanggalObj->format('dmy');
	$addToTable2 = mysqli_query($conn, "INSERT INTO user (id_user, no_induk, password, fullname, role) VALUES ('$id_user', '$nis', '$password', '$siswa', 'Siswa');");
	$addToTable1 = mysqli_query($conn, "INSERT INTO siswa (nis, siswa, tanggal_lahir, alamat, kontak, id_kelas, id_user) VALUES ('$nis', '$siswa', '$tanggal_lahir', '$alamat', '$kontak', '$id_kelas', '$id_user');");
	if ($addToTable1) {
		header('location:dashboard.php');
	} else {
		header('location:user.php');
	}
}

if (isset($_POST['editSiswa'])) {
	$nis = $_POST["nis"];
	$siswa = $_POST["siswa"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$alamat = $_POST["alamat"];
	$kontak = $_POST["kontak"];
	$id_kelas = $_POST["id_kelas"];

	$tanggalObj = new DateTime($tanggal_lahir);
	$password = $tanggalObj->format('dmy');
	$addToTable2 = mysqli_query($conn, "UPDATE user SET no_induk='$nis', password='$password', fullname='$siswa' WHERE no_induk='$nis'");
	$addToTable1 = mysqli_query($conn, "UPDATE siswa SET siswa='$siswa', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kontak='$kontak', id_kelas='$id_kelas' WHERE nis='$nis'");
	if ($addToTable2) {
	} else {
		// header('location:dashboard.php');
	}
}

if (isset($_POST['deleteSiswa'])) {
	$nis = $_POST['nis'];

	$addToTable2 = mysqli_query($conn, "DELETE FROM user WHERE no_induk='$nis'");
	$addToTable1 = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");
}

if (isset($_POST["addUser"])) {
	// Ambil data dari setiap elemen dalam form
	$id_user = $_POST["id_user"];
	$no_induk = $_POST["no_induk"];
	$password = $_POST["password"];
	$fullname = $_POST["fullname"];
	$role = $_POST["role"];

	// Query insert data
	$addToTable = mysqli_query($conn, "INSERT INTO user (id_user, no_induk, password, fullname, role) VALUES ('$id_user', '$no_induk', '$password', '$fullname', '$role');");
	if ($addToTable) {
		// header('location:jadwal.php');
	} else {
		// header('location:dashboard.php');
	}
}

if (isset($_POST['editUser'])) {
	$id_user = $_POST["id_user"];
	$no_induk = $_POST["no_induk"];
	$password = $_POST["password"];
	$fullname = $_POST["fullname"];
	$role = $_POST["role"];

	$addToTable = mysqli_query($conn, "UPDATE user SET no_induk='$no_induk', password='$password', fullname='$fullname', role='$role' WHERE id_user='$id_user'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST['deleteUser'])) {
	$id_user = $_POST['id_user'];

	$addToTable = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST["addJadwal"])) {
	// Ambil data dari setiap elemen dalam form
	$id_jadwal = $_POST["id_jadwal"];
	$hari = $_POST["hari"];
	$jam = $_POST["jam"];
	$id_kelas = $_POST["id_kelas"];
	$id_mapel = $_POST["id_mapel"];

	// Query insert data
	$addToTable = mysqli_query($conn, "INSERT INTO jadwal (id_jadwal, hari, jam, id_kelas, id_mapel) VALUES ('$id_jadwal', '$hari', '$jam', '$id_kelas', '$id_mapel');");
	if ($addToTable) {
		// header('location:hasil_ujian.php');
	} else {
		// header('location:dashboard.php');
	}
}

if (isset($_POST["addSoalUTS"])) {
	// Ambil data dari setiap elemen dalam form
	$id_ujian = $_POST["id_ujian"];


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$soalCount = isset($_POST['soalCount']) ? (int)$_POST['soalCount'] : 0;
		$jenis_ujian = $_POST['jenis_ujian'];
		$i = 0;
		while ($i < $soalCount) {
			$i++;

			$query = "SELECT MAX(id_soal) AS kode FROM soal";
			$sql = mysqli_query($conn, $query);
			$urut = mysqli_fetch_array($sql);
			$kode_input = $urut['kode'];
			$urutan = (int) substr($kode_input, 2, 3);
			$urutan++;
			$id_soal = 'S-' . sprintf("%03s", $urutan);

			$id_ujian = $_POST["id_ujian"];
			$soal = $_POST["soal_$i"];
			$opsiA = $_POST["jawaban_a$i"];
			$opsiB = $_POST["jawaban_b$i"];
			$opsiC = $_POST["jawaban_c$i"];
			$opsiD = $_POST["jawaban_d$i"];
			$opsiE = $_POST["jawaban_e$i"];
			$opsi = $opsiA . "," . $opsiB . "," . $opsiC . "," . $opsiD . "," . $opsiE;
			$benar = $_POST["jawaban_benar$i"];
			$jawaban_benar = $_POST["jawaban_$benar$i"];


			$addToTable = mysqli_query($conn, "INSERT INTO soal (id_soal, id_ujian, soal, opsi, jawaban_benar) VALUES ('$id_soal', '$id_ujian', '$soal', '$opsi', '$jawaban_benar');");
			if ($addToTable) {
				header('location:data_soal_uts.php');
			} else {
				// header('location:dashboard.php');
			}
		}
	}
}
if (isset($_POST["editSoalUAS"])) {
	// Ambil data dari setiap elemen dalam form
	$id_soal = $_POST["id_soal"];
	$soal = $_POST["soal"];
	$opsiA = $_POST["jawabanA"];
	$opsiB = $_POST["jawabanB"];
	$opsiC = $_POST["jawabanC"];
	$opsiD = $_POST["jawabanD"];
	$opsiE = $_POST["jawabanE"];
	$opsi = $opsiA . "," . $opsiB . "," . $opsiC . "," . $opsiD . "," . $opsiE;
	$benar = $_POST["jawaban_benar"];

	$addToTable = mysqli_query($conn, "UPDATE soal SET soal='$soal', opsi='$opsi', jawaban_benar='$benar' WHERE id_soal='$id_soal'");
	if ($addToTable) {
	} else {
		header('location:data_soal_uts.php');
	}
}

if (isset($_POST['deleteSoal'])) {
	$id_soal = $_POST['id_soal'];

	$addToTable = mysqli_query($conn, "DELETE FROM soal WHERE id_soal='$id_soal'");
	if ($addToTable) {
		// header('location:dashboard.php');
	} else {
	}
}

if (isset($_POST["addSoalUAS"])) {
	// Ambil data dari setiap elemen dalam form
	$id_ujian = $_POST["id_ujian"];


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$soalCount = isset($_POST['soalCount']) ? (int)$_POST['soalCount'] : 0;
		$jenis_ujian = $_POST['jenis_ujian'];
		$i = 0;
		while ($i < $soalCount) {
			$i++;

			$query = "SELECT MAX(id_soal) AS kode FROM soal";
			$sql = mysqli_query($conn, $query);
			$urut = mysqli_fetch_array($sql);
			$kode_input = $urut['kode'];
			$urutan = (int) substr($kode_input, 2, 3);
			$urutan++;
			$id_soal = 'S-' . sprintf("%03s", $urutan);

			$id_ujian = $_POST["id_ujian"];
			$soal = $_POST["soal_$i"];
			$opsiA = $_POST["jawaban_a$i"];
			$opsiB = $_POST["jawaban_b$i"];
			$opsiC = $_POST["jawaban_c$i"];
			$opsiD = $_POST["jawaban_d$i"];
			$opsiE = $_POST["jawaban_e$i"];
			$opsi = $opsiA . "," . $opsiB . "," . $opsiC . "," . $opsiD . "," . $opsiE;
			$benar = $_POST["jawaban_benar$i"];
			$jawaban_benar = $_POST["jawaban_$benar$i"];


			$addToTable = mysqli_query($conn, "INSERT INTO soal (id_soal, id_ujian, soal, opsi, jawaban_benar) VALUES ('$id_soal', '$id_ujian', '$soal', '$opsi', '$jawaban_benar');");
			if ($addToTable) {
				header('location:data_soal_uas.php');
			} else {
				// header('location:dashboard.php');
			}
		}
	}
}

if (isset($_POST['submitJawaban'])) {
	$id_ujian = $_POST['id_ujian'];
	$id_siswa = $_POST['id_siswa'];
	$jawaban = $_POST['jawaban']; // Array jawaban yang dipilih
	$jumlah_benar = 0;
	$total_soal = $_POST['total_soal'];

	foreach ($jawaban as $id_soal => $jawab) {
		// hitung nilai
		$ambildata = mysqli_query($mysqli, "SELECT * FROM soal where id_soal='$id_soal';");
		$ambiljawaban = mysqli_fetch_array($ambildata);
		if ($jawab == $ambiljawaban['jawaban_benar']) {
			$jumlah_benar++;
		}
	}

	$nilai = $jumlah_benar / $total_soal * 100;

	$ambilnilai = mysqli_query($mysqli, "SELECT * FROM nilai where id_ujian='$id_ujian' and id_siswa='$id_siswa';");
	$getnilai = mysqli_fetch_array($ambilnilai);
	if ($getnilai) {
		// Query untuk menyimpan jawaban ke database
		$addToTable = mysqli_query($conn, "UPDATE nilai SET total_soal='$total_soal', jawaban_benar='$jumlah_benar', nilai='$nilai' WHERE id_ujian='$id_ujian' and id_siswa='$id_siswa'");
		if ($addToTable) {
			header('location:ujian.php');
		}
	} else {
		$query = "SELECT MAX(id_nilai) AS kode FROM nilai";
		$sql = mysqli_query($conn, $query);
		$urut = mysqli_fetch_array($sql);
		$kode_input = $urut['kode'];
		$urutan = (int) substr($kode_input, 2, 3);
		$urutan++;
		$id_nilai = 'N-' . sprintf("%03s", $urutan);

		// Query untuk menyimpan jawaban ke database
		$addToTable = mysqli_query($conn, "INSERT INTO nilai (id_nilai, id_siswa, id_ujian, total_soal, jawaban_benar, nilai) VALUES ('$id_nilai', '$id_siswa', '$id_ujian', '$total_soal', '$jumlah_benar', '$nilai')");
		if ($addToTable) {
			header('location:ujian.php');
		}
	}
}
