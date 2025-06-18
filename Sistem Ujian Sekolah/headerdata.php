<ul style="display: flex;">
  <?php
  if (isset($_SESSION['role']) && $_SESSION['role'] == "Kesiswaan") {
  ?>
    <li class="mx-1"><a class="btn btn-primary" href="dataMapel.php">Data Mapel</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataKelas.php">Data Kelas</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataGuru.php">Data Guru</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataSiswa.php">Data Siswa</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataNilai1.php">Data Nilai</a></li>
  <?php
  }
  ?>
  <?php
  if (isset($_SESSION['role']) && $_SESSION['role'] == "Guru") {
  ?>
    <li class="mx-1"><a class="btn btn-primary" href="dataMapel.php">Data Mapel</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataKelas.php">Data Kelas</a></li>
    <li class="mx-1"><a class="btn btn-primary" href="dataNilai2.php">Data Nilai</a></li>
  <?php
  }
  ?>
  <?php
  if (isset($_SESSION['role']) && $_SESSION['role'] == "Siswa") {
  ?>
    <li class="mx-1"><a class="btn btn-primary" href="dataNilai3.php">Data Nilai</a></li>
  <?php
  }
  ?>
</ul>