<?php
include "../koneksi.php";
error_reporting(null);
session_start();
$id_karyawan = $_POST['id_karyawan'];
$sumber = $_FILES['foto']['tmp_name'];
	$target = 'gambar/';
	$nama_gambar = $_FILES['foto']['name'];
$nama_karyawan = $_POST['nama_karyawan'];
$id_jabatan = $_POST['id_jabatan'];
$gaji_pokok = $_POST['gaji_pokok'];
$uang_transport = $_POST['uang_transport'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$status = $_POST['status'];
$awal = $_POST['awal'];
$akhir = $_POST['akhir'];

$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
if($pindah){
$query = "insert into karyawan values('$id_karyawan','$nama_gambar','$nama_karyawan','$id_jabatan','$gaji_pokok','$uang_transport','$alamat','$no_telepon','$status','$awal','$akhir')";
$hasil = mysql_query($query);
}
if($hasil)
{
header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}
?>