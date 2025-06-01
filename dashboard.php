<?php include 'db.php'; ?>
<?php include 'template/header.php'; ?>
<?php include 'template/sidebar.php'; ?>

<?php
// Ambil data capaian per bulan untuk tahun aktif (default: tahun sekarang)
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$query = "SELECT bulan, SUM(capaian) as total_capaian FROM kpi WHERE tahun = '$tahun' GROUP BY bulan ORDER BY FIELD(bulan, 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember')";
$result = mysqli_query($conn, $query);

$bulan = [];
$capaian = [];
while ($row = mysqli_fetch_assoc($result)) {
  $bulan[] = $row['bulan'];
  $capaian[] = $row['total_capaian'];
}
?>

<div class="container mt-4">
  <h3>Dashboard Performa KPI Staf IT PDTSKBS</h3>

  <form method="get" class="mb-4">
    <label>Pilih Tahun:</label>
    <select name="tahun" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
      <?php
      $tahunSekarang = date('Y');
      for ($t = $tahunSekarang; $t >= $tahunSekarang - 5; $t--) {
        $selected = ($t == $tahun) ? 'selected' : '';
        echo "<option value='$t' $selected>$t</option>";
      }
      ?>
    </select>
  </form>

  <div class="card mb-4">
    <div class="card-body">
      <canvas id="grafikPerforma"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('grafikPerforma');
  const grafik = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($bulan); ?>,
      datasets: [{
        label: 'Capaian Bulanan (<?php echo $tahun; ?>)',
        data: <?php echo json_encode($capaian); ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: 'Grafik Performa Berdasarkan Capaian Bulanan'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Jumlah Capaian'
          }
        }
      }
    }
  });
</script>

<?php include 'template/footer.php'; ?>
