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
    <div>
      <h1 style="margin-left: 200px;">Ujian</h1>
    </div>
  </div>
  <div class="content-produk">
    <button class="btn btn-tambahkan-produk" id="btn-tambahkan-produk"><i class="fas fa-plus-circle"></i> Tambah Produk</i></button>

    <table class="table-produk">
      <tr>
        <th rowspan="2" class="text-center align-middle">No</th>
        <th rowspan="2" class="text-center align-middle">Mata Pelajaran</th>
        <th rowspan="2" class="text-center align-middle">Nama Guru</th>
        <th colspan="5" class="text-center align-middle">Jenis Ujian</th>
      </tr>
      <tr>
        <?php
        $ambildata = mysqli_query($mysqli, "SELECT * FROM ujian group by jenis_ujian order by id_ujian asc;");
        while ($kelas = mysqli_fetch_array($ambildata)) {
        ?>
          <th class="text-center align-middle"><?= $kelas['jenis_ujian']; ?></th>
        <?php
        }
        ?>
      </tr>
      <?php
      $ambildata = mysqli_query($mysqli, "SELECT * FROM ujian, mapel, guru where ujian.id_mapel=mapel.id_mapel and mapel.id_guru=guru.nip group by mapel order by jenis_ujian desc, mapel asc;");
      while ($data = mysqli_fetch_array($ambildata)) {
        $get_id_product = $data['id_mapel'];
        $i = 1;
      ?>
        <tr>
          <td style="text-align: center;"><?= $i; ?></td>
          <td><?= $data['mapel']; ?></td>
          <td><?= $data["guru"]; ?></td>
          <td style="text-align: center;">
            <?php
            $id_mapel = $data['id_mapel'];
            $id_siswa = $_SESSION['no_induk'];
            $ambilnilai = mysqli_query($mysqli, "SELECT * FROM nilai, ujian, mapel where nilai.id_ujian=ujian.id_ujian  and ujian.id_mapel=mapel.id_mapel and mapel.id_mapel='$id_mapel' and jenis_ujian='Ujian Tengah Semester' and nilai.id_siswa='$id_siswa'");
            $getnilai = mysqli_fetch_array($ambilnilai);
            if ($getnilai) {
            ?>

              <a class="btn btn-warning action-edit"><?= $getnilai['nilai']; ?></a>
              <a href="form_uts.php?id_mapel=<?= $data['id_mapel']; ?>" class="btn btn-primary action-edit"><i class="fas fa-play"></i> Ujian Ulang</a>
            <?php
            } else {
            ?>
              <a href="form_uts.php?id_mapel=<?= $data['id_mapel']; ?>" class="btn btn-success action-edit"><i class="fas fa-play"></i> Mulai Ujian</a>
            <?php
            }
            ?>
          </td>
          <td style="text-align: center;">
            <?php
            $id_mapel = $data['id_mapel'];
            $ambilnilai = mysqli_query($mysqli, "SELECT * FROM nilai, ujian, mapel where nilai.id_ujian=ujian.id_ujian  and ujian.id_mapel=mapel.id_mapel and mapel.id_mapel='$id_mapel' and jenis_ujian='Ujian Akhir Semester' and nilai.id_siswa='$id_siswa'");
            $getnilai = mysqli_fetch_array($ambilnilai);
            if ($getnilai) {
            ?>

              <a class="btn btn-warning action-edit"><?= $getnilai['nilai']; ?></a>
              <a href="form_uas.php?id_mapel=<?= $data['id_mapel']; ?>" class="btn btn-primary action-edit"><i class="fas fa-play"></i> Ujian Ulang</a>
            <?php
            } else {
            ?>
              <a href="form_uas.php?id_mapel=<?= $data['id_mapel']; ?>" class="btn btn-success action-edit"><i class="fas fa-play"></i> Mulai Ujian</a>
            <?php
            }
            ?>
          </td>
        </tr>
      <?php
        $i++;
      }
      ?>
    </table>
  </div>

  <div id="modal-tambah-produk" class="modal">
    <!-- Modal content -->
    <div class="modal-content cf">
      <div class="form-penambahan-produk">
        <form action="" method="post">
          <table>
            <tr>
              <th>
                <label for="id-produk">ID Produk : </label>
              </th>
              <td>
                <input type="text" id="id-produk" name="id-produk" value="<?= $generatedId; ?>" class="readonly" readonly>
              </td>
            </tr>
            <tr>
              <th>
                <label for="nama-produk">Nama : </label>
              </th>
              <td>
                <input type="text" id="nama-produk" name="nama-produk" required>
              </td>
            </tr>
            <tr>
              <th>
                <label for="harga">Harga (Rp) : </label>
              </th>
              <td>
                <input type="number" id="harga" name="harga" min="1" required>
              </td>
            </tr>
            <tr>
              <th>
                <label for="stock">Stock : </label>
              </th>
              <td>
                <input type="number" id="stock" name="stock" min="1" required>
              </td>
            </tr>
          </table>
          <button type="submit" name="tambah_produk_btn" class="btn btn-tambah-produk" id="submit-produk"><i class="fas fa-plus-circle"></i> Tambahkan Produk</button>
        </form>
      </div>
    </div>
  </div>

  <div id="modal-edit-produk" class="modal">
    <!-- Modal content -->
    <div class="modal-content cf">
      <div class="form-penambahan-produk">
        <form action="" method="post">
          <table>
            <tr>
              <th>
                <label for="id-produk">ID Produk : </label>
              </th>
              <td>
                <input type="text" id="id-produk" name="id-produk" value="<?= $generatedId; ?>" class="readonly" readonly>
              </td>
            </tr>
            <tr>
              <th>
                <label for="nama-produk">Nama : </label>
              </th>
              <td>
                <input type="text" id="nama-produk" name="nama-produk" required>
              </td>
            </tr>
            <tr>
              <th>
                <label for="harga">Harga (Rp) : </label>
              </th>
              <td>
                <input type="number" id="harga" name="harga" min="1" required>
              </td>
            </tr>
            <tr>
              <th>
                <label for="stock">Stock : </label>
              </th>
              <td>
                <input type="number" id="stock" name="stock" min="1" required>
              </td>
            </tr>
          </table>
          <button type="submit" name="edit_produk_btn" class="btn btn-edit-produk" id="submit-produk"><i class="fas fa-check-circle"></i> Edit Produk</button>
        </form>
      </div>
    </div>
  </div>

  <div id="modal-product-added" class="modal" <?php if ($isSuccessfullyAdded) : ?> style="display: block;" <?php endif ?>>
    <!-- Modal content -->
    <div class="modal-content modal-notification">
      <div class="notification">
        <i class="fas fa-check-circle notification-icon"></i>
        <p class="notification-text">Produk berhasil ditambahkan!</p>
        <button class="btn btn-confirmation" id="btn-confirmation" onclick="closeModal();">Selesai</button>
      </div>
    </div>
  </div>

  <div id="modal-product-add-failed" class="modal" <?php if (!$isSuccessfullyAdded) : ?> style="display: block;" <?php endif ?>>
    <!-- Modal content -->
    <div class="modal-content modal-notification">
      <div class="notification">
        <i class="fas fa-times-circle notification-icon-failed"></i>
        <p class="notification-text">Produk Gagal Ditambahkan!</p>
        <button class="btn btn-confirmation" id="btn-confirmation" onclick="closeModal();">Tutup</button>
      </div>
    </div>
  </div>

  <div id="modal-delete" class="modal">
    <!-- Modal content -->
    <div class="modal-content modal-notification">
      <div class="notification">
        <i class="fas fa-exclamation-triangle notification-icon" style="color: #BA2929"></i>
        <p class="notification-text">Hapus produk dari daftar?</p>
        <button class="btn btn-batal" id="btn-confirmation">Batal</button>
        <a href="#!" id="btn-confirm-hapus"><button class="btn btn-hapus">Hapus</button></a>
      </div>
    </div>
  </div>
</main>

<?php include "footer.php"; ?>