<?php include 'db.php'; ?>
<?php include 'template/header.php'; ?>
<?php include 'template/sidebar.php'; ?>

<?php
// Tambah data
if (isset($_POST['simpan'])) {
  $kategori = $_POST['kategori'];
  $indikator = $_POST['indikator'];
  $target = $_POST['target'];
  $capaian = $_POST['capaian'];
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $keterangan = $_POST['keterangan'];

  mysqli_query($conn, "INSERT INTO kpi (kategori, indikator, target, capaian, bulan, tahun, keterangan) VALUES ('$kategori', '$indikator', '$target', '$capaian', '$bulan', '$tahun', '$keterangan')");
  header("Location: kpi_crud.php?success=1");

  exit();
}

// Hapus data
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM kpi WHERE id = $id");
  header("Location: kpi_crud.php");
  exit();
}
?>

<h3>Input Data KPI</h3>
<?php if (isset($_GET['success'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i> Data berhasil disimpan!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<form method="post" class="row g-3 mb-4">
  <div class="col-md-6">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-select" required>
      <option value="">Pilih Kategori</option>
      <option value="Maintenance Perangkat">Maintenance Perangkat</option>
      <option value="Instalasi & Maintenance CCTV">Instalasi & Maintenance CCTV</option>
      <option value="Pembuatan Aplikasi Website">Pembuatan Aplikasi Website</option>
      <option value="Monitoring Server">Monitoring Server</option>
      <option value="Membuat Surat/Laporan">Membuat Surat/Laporan</option>
      <option value="Perbantuan">Perbantuan</option>
      <option value="Lainnya..">Lainnya</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Indikator</label>
    <input type="text" name="indikator" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Target</label>
    <input type="number" name="target" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Capaian</label>
    <input type="number" name="capaian" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Bulan</label>
    <select name="bulan" class="form-select" required>
      <option value="">Pilih</option>
      <?php
      $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      foreach ($bulan as $b) {
        echo "<option value='$b'>$b</option>";
      }
      ?>
    </select>
  </div>
  <div class="col-md-2">
    <label class="form-label">Tahun</label>
    <input type="number" name="tahun" class="form-control" value="<?php echo date('Y'); ?>" required>
  </div>
  <div class="col-12">
    <label class="form-label">Keterangan</label>
    <input type="text" name="keterangan" class="form-control">
  </div>
  <div class="col-12">
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <div class="alert alert-info mt-3">
      <strong>Catatan Pengisian:</strong>
      <ul class="mb-0">
        <li><strong>Indikator:</strong> Deskripsikan aktivitas spesifik. Contoh: "Install ulang OS PC kantor", "Pasang CCTV di kandang harimau".</li>
        <li><strong>Target:</strong> Jumlah rencana penyelesaian. Contoh: 5 (unit), 10 (task), dll.</li>
        <li><strong>Capaian:</strong> Jumlah aktual yang berhasil dilakukan. Contoh: 4 (unit), 10 (task).</li>
      </ul>
    </div>
  </div>
</form>
<!-- Overlay Spinner -->
<div id="overlay-spinner" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center d-none" style="z-index: 1050;">
  <div class="text-center text-white">
    <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="mt-2">Menyimpan data...</div>
  </div>
</div>
<script>
  const form = document.querySelector("form");
  const overlay = document.getElementById("overlay-spinner");

  form.addEventListener("submit", function () {
    overlay.classList.remove("d-none");
  });
</script>
<?php include 'template/footer.php'; ?>
