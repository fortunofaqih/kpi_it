<?php include 'db.php'; ?>
<?php include 'template/header.php'; ?>
<?php include 'template/sidebar.php'; ?>

<h3>Laporan KPI</h3>
<table id="laporanTable" class="table table-bordered table-striped" style="width:100%">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Kategori</th>
      <th>Indikator</th>
      <th>Target</th>
      <th>Capaian</th>
      <th>Bulan</th>
      <th>Tahun</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $result = mysqli_query($conn, "SELECT * FROM kpi ORDER BY tahun DESC, bulan DESC");
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
              <td>{$no}</td>
              <td>{$row['kategori']}</td>
              <td>{$row['indikator']}</td>
              <td>{$row['target']}</td>
              <td>{$row['capaian']}</td>
              <td>{$row['bulan']}</td>
              <td>{$row['tahun']}</td>
              <td>{$row['keterangan']}</td>
            </tr>";
      $no++;
    }
    ?>
  </tbody>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
  $(document).ready(function () {
    $('#laporanTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5',
        'print'
      ]
    });
  });
</script>

<?php include 'template/footer.php'; ?>
