<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$tanggal_transfer=$_POST['tanggal_transfer'];
$nama_karyawan=$_POST['nama_karyawan'];
$jabatan=$_POST['jabatan'];
$gaji_pokok=$_POST['gaji_pokok'];
$uang_transport=$_POST['uang_transport'];
$hari_kerja=$_POST['hari_kerja'];
$kehadiran_kerja=$_POST['kehadiran_kerja'];

$upah_harian=$kehadiran_kerja*80000;
$bonus = $hari_kerja-$kehadiran_kerja;
if($bonus == 0){
	$bonus = 100000;
} else {
	$bonus = 0;
}
/*
$dt=mysql_query("select * from gaji where id_gaji='$id_gaji'");
$data=mysql_fetch_array($dt);
$data['jumlah']-$jumlah;
mysql_query("update pemesanan set jumlah='$jumlah' where id_pesan='$id_pesan'");
*/

$jumlah_lembur=$_POST['jumlah_lembur'];
$uang_lembur=$jumlah_lembur*20000;
$telat1=$_POST['telat1'];
$telat2=$_POST['telat2'];
$telat3=$_POST['telat3'];

$total_gaji=($uang_lembur+$bonus+$uang_transport+$gaji_pokok+$upah_harian)-(($telat1*15000)+($telat2*25000)+($telat3*45000));

$query = "insert into gaji values ('','$bulan','$tahun','$tanggal_transfer','$nama_karyawan','$jabatan','$gaji_pokok','$uang_transport','$hari_kerja','$kehadiran_kerja','$bonus','$jumlah_lembur','$telat1','$telat2','$telat3','$total_gaji')";
//var_dump($query);
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}


?>