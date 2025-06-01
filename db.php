<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'kpi_it';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
