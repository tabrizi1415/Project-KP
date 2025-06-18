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
        <li class="mx-1"><a class="btn btn-primary" href="ujian.php">Kembali</a></li>
      </ul>
      <?php
      $getUserLogin  = $_SESSION['fullname'];
      $pilihmapel = $_GET['id_mapel'];
      $ambildata = mysqli_query($mysqli, "SELECT * FROM mapel where id_mapel='$pilihmapel';");
      $ambilmapel = mysqli_fetch_array($ambildata);
      ?>
    </div>
    <div>
      <h2 style="margin-left: 200px; margin-top: 100px;"> Ujian Akhir Semester - <?= $ambilmapel['mapel']; ?></h2>
    </div>
  </div>
  <div class="container mt-5">
    <div class="card p-4">
      <form id="soalForm" action="" method="post">
        <div id="soalContainer" class="container mt-4">
          <?php
          // Mengambil soal dan jawabannya dari database
          $getmapel = $ambilmapel['id_mapel'];
          $getdata = mysqli_query($mysqli, "SELECT * FROM ujian, mapel, soal WHERE ujian.id_mapel=mapel.id_mapel AND mapel.id_mapel='$getmapel' AND ujian.jenis_ujian='Ujian Akhir Semester' AND soal.id_ujian=ujian.id_ujian;");
          $soalCount = 1; // Menandai soal yang sedang ditampilkan
          while ($soal = mysqli_fetch_array($getdata)) {
          ?>
            <div class="mb-4 card p-3" id="soal-<?= $soalCount ?>">
              <h5 class="card-title fw-bold" style="font-size: 1.3rem;"><?= $soalCount ?>) <?= $soal['soal'] ?></h5>
              <div style="height: 20px;"></div>
              <?php
              // Cek jika soal memiliki opsi jawaban (misalnya untuk pilihan ganda)
              if (!empty($soal['opsi'])) {
                $opsi = explode(",", $soal['opsi']); // Misalkan opsi jawaban disimpan dalam format koma
                $opsiCount = 1;
                foreach ($opsi as $op) {
              ?>
                  <div class="form-check mb-2 ms-4">
                    <input class="form-check-input" type="radio" name="jawaban[<?= $soal['id_soal'] ?>]" id="opsi<?= $soalCount ?>-<?= $opsiCount ?>" value="<?= $op ?>" style="width: 20px; height: 20px; border: 2px solid #000000; margin-right: 15px;">
                    <label class="form-check-label" for="opsi<?= $soalCount ?>-<?= $opsiCount ?>" style="font-size: 1.1rem;">
                      <?= $op ?>
                    </label>
                  </div>
                <?php
                  $opsiCount++;
                }
              } else { // Soal esai
                ?>
                <div class="mb-3">
                  <textarea class="form-control" name="jawaban[<?= $soal['id_soal'] ?>]" rows="3" placeholder="Masukkan jawaban Anda..." style="resize: none; font-size: 1.1rem;"></textarea>
                </div>
              <?php } ?>
            </div>
          <?php
            $soalCount++;
          }
          $ambilujian = mysqli_query($mysqli, "SELECT * FROM ujian where id_mapel='$pilihmapel' and jenis_ujian='Ujian Akhir Semester';");
          $ujian = mysqli_fetch_array($ambilujian);

          $nis = $_SESSION['no_induk'];
          ?>

          <input type="text" name="total_soal" class="form-control" value="<?= $soalCount - 1 ?>" hidden>
          <input type="text" name="id_ujian" class="form-control" value="<?= $ujian['id_ujian'] ?>" hidden>
          <input type="text" name="id_siswa" class="form-control" value="<?= $nis ?>" hidden>
        </div>

        <?php
        $id_ujian = $ujian['id_ujian'];

        // Ambil data soal berdasarkan id_ujian
        $ambilsoal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$id_ujian' LIMIT 1");

        // Cek apakah ada data soal
        if ($getsoal = mysqli_fetch_array($ambilsoal)) {
        ?>
          <!-- Form Input -->
          <div class="text-center mb-4">
            <!-- Input Tersembunyi untuk ID Soal -->
            <input type="hidden" name="id_soal" value="<?= htmlspecialchars($getsoal['id_soal']) ?>">

            <!-- Tombol Kirim Jawaban -->
            <button type="submit" class="btn btn-success btn-lg" name="submitJawaban" style="font-size: 1.2rem;">
              Kirim Jawaban
            </button>
          </div>
        <?php
        } else {
          // Pesan jika tidak ada soal ditemukan
          echo "<p class='text-center text-danger'>Tidak ada soal ditemukan untuk ujian ini.</p>";
        }
        ?>

      </form>

    </div>
  </div>
</main>

<?php include "footer.php"; ?>