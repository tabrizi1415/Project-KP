  <?php
  require 'database.php';
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Sistem Ujian - SMK AL-HUSNA</title>
    <link rel="shortcut icon" type="image/ico" href="assets/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="assets/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6606a30803.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
    <header>
      <nav class="nav-menu d-flex ">
        <ul>
          <h1 class="logo"><a href="#" title="SIPOSWEB"><img src="assets/images/" alt="SMK AL-HUSNA" height="35px"></a></h1>
          <li><a class="active" href="dashboard.php"><i class="fa fa-shopping-cart"></i> Dashboard</a></li>
          <li><a href="jadwal.php"><i class="fas fa-box-open"></i> Jadwal Ujian</a></li>
          <li><a href="dataKelas.php"><i class="fas fa-clipboard-list"></i> Data</a></li>
          <?php
          if (isset($_SESSION['role']) && $_SESSION['role'] == "Kesiswaan") {
          ?>
            <li><a href="user.php"><i class="fas fa-user-cog"></i> User</a></li>

          <?php
          }
          ?>

          <?php
          if (isset($_SESSION['role']) && $_SESSION['role'] == "Guru") {
          ?>
            <li><a href="data_soal_uts.php"><i class="fas fa-user-cog"></i> Soal</a></li>
          <?php
          }
          ?>

          <?php
          if (isset($_SESSION['role']) && $_SESSION['role'] == "Siswa") {
          ?>
            <li><a href="ujian.php"><i class="fas fa-user-cog"></i> Ujian</a></li>
          <?php
          }
          ?>
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
        <div class="d-flex" style="margin-left: 300px; font-size: 20px;">
          <li> <a><i class="fas fa-user-alt"></i> <?= $_SESSION['fullname']; ?></a></li>
        </div>
      </nav>
    </header>