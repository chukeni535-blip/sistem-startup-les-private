<?php
include "koneksi.php";

// Data dari form pendaftaran
$nama   = $_POST['nama'];
$email  = $_POST['email'];
$alamat = $_POST['alamat'];

// Data dari pilihan bimbingan belajar
$biaya  = $_POST['biaya'];              // contoh: 100000
$status_transaksi = $_POST['status'];   // sukses / pending / belum
$order_id = rand(100000, 999999);       // order ID otomatis
$transaksi_id = "";                     // kosong dulu, nanti untuk Payment Gateway

// Simpan ke database
$query = "INSERT INTO tbl_data 
(nama, email, alamat, biaya, status_transaksi, order_id, transaksi_id)
VALUES 
('$nama', '$email', '$alamat', '$biaya', '$status_transaksi', '$order_id', '$transaksi_id')";

mysqli_query($koneksi, $query);

// kembali ke data.php
header("Location: data.php");
exit;
?>
