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
				<li class="mx-1"><a class="btn btn-primary" href="data_soal_uts.php">Ujian Tengah Semester</a></li>
				<li class="mx-1"><a class="btn btn-primary" href="data_soal_uas.php">Ujian Akhir Semester</a></li>
			</ul>
			<?php
			$getUserLogin  = $_SESSION['fullname'];
			$ambildata = mysqli_query($mysqli, "SELECT * FROM mapel, guru where mapel.id_guru=guru.nip and guru='$getUserLogin';");
			$ambilmapel = mysqli_fetch_array($ambildata);
			?>
		</div>
		<div>
			<h2 style="margin-left: 200px; margin-top: 100px;">Buat Soal - Ujian Akhir Semester - <?= $ambilmapel['mapel']; ?></h2>
		</div>
	</div>
	<div class="container mt-5">
		<div class="card p-4">
			<form id="soalForm" action="" method="post">
				<div id="soalContainer">
					<?php
					$getmapel = $ambilmapel['id_mapel'];
					$getdata = mysqli_query($mysqli, "SELECT * FROM ujian, mapel where ujian.id_mapel=mapel.id_mapel and mapel.id_mapel='$getmapel' and ujian.jenis_ujian='Ujian Akhir Semester';");
					$ambilujian = mysqli_fetch_array($getdata);
					?>
					<input type="hidden" id="soalCount" name="soalCount" value="0">
					<input type="text" name="id_ujian" value="<?= $ambilujian['id_ujian']; ?>" hidden>
					<input type="text" name="jenis_ujian" value="Ujian Akhir Semester" hidden>
					<!-- Soal will be appended here -->
				</div>
				<div class="text-end">
					<button type="button" class="btn btn-secondary me-2" id="tambahSoalBtn">Tambah Soal</button>
					<button type="submit" class="btn btn-primary" name="addSoalUAS">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</main>

<script>
	$(document).ready(function() {
		let soalCount = 0;

		// Function to add a new soal
		function addSoal() {
			soalCount++;
			$('#soalCount').val(soalCount); // Perbarui nilai input tersembunyi
			const soalHtml = `
          <div class="mb-4" id="soal_${soalCount}">
            <div class="row mb-2">
              <div class="col-1 d-flex align-items-center justify-content-end">
                <h5>${soalCount}.</h5>
              </div>
              <div class="col-10">
                <input type="text" class="form-control" name="soal_${soalCount}" placeholder="Masukkan pertanyaan ${soalCount}">
              </div>
              <div class="col-1 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm remove-soal" data-id="${soalCount}">Hapus</button>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-1"></div>
              <div class="col-11">
                ${['A', 'B', 'C', 'D', 'E'].map(option => `
                  <div class="input-group mb-2">
                    <span class="input-group-text">${option}.</span>
                    <input type="text" class="form-control" name="jawaban_${option.toLowerCase()}${soalCount}" placeholder="Pilihan ${option}">
                    <div class="input-group-text">
                      <input class="form-check-input mt-0" type="radio" name="jawaban_benar${soalCount}" value="${option.toLowerCase()}" aria-label="Pilih sebagai jawaban benar">
                    </div>
                  </div>
                `).join('')}
              </div>
            </div>
          </div>
        `;
			$('#soalContainer').append(soalHtml);
		}

		// Add the first soal on page load
		addSoal();

		// Event listener for adding new soal
		$('#tambahSoalBtn').click(function() {
			addSoal();
		});

		// Event delegation for removing soal
		$('#soalContainer').on('click', '.remove-soal', function() {
			const id = $(this).data('id');
			$(`#soal_${id}`).remove();
			// Re-index remaining soals
			soalCount--;
			$('#soalCount').val(soalCount); // Perbarui nilai input tersembunyi
			$('#soalContainer .mb-4').each(function(index) {
				$(this).attr('id', `soal_${index + 1}`);
				$(this).find('h5').text(`${index + 1}.`);
				$(this).find('input[type="text"]').each(function() {
					const name = $(this).attr('name').replace(/\d+$/, index + 1);
					$(this).attr('name', name);
					$(this).attr('placeholder', name.replace(/_/g, ' '));
				});
				$(this).find('.remove-soal').data('id', index + 1);
				$(this).find('input[type="radio"]').each(function() {
					const name = $(this).attr('name').replace(/\d+$/, index + 1);
					$(this).attr('name', name);
				});
			});
		});
	});
</script>

<?php include "footer.php"; ?>