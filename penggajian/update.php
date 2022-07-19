<?php
include "../koneksi.php";
error_reporting(null);
session_start();
$id_gaji = $_POST['id_gaji'];
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
if(isset($_POST['bonus'])) {
	$bonus = $hari_kerja-$kehadiran_kerja;
	if($bonus == 0){
		$bonus = 100000;
	} else {
		$bonus = 0;
	}
}


$jumlah_lembur=$_POST['jumlah_lembur'];
$uang_lembur=$jumlah_lembur*20000;
$telat1=$_POST['telat1'];
$telat2=$_POST['telat2'];
$telat3=$_POST['telat3'];

if(isset($_POST['total_gaji'])) {
$total_gaji=($uang_lembur+$bonus+$uang_transport+$gaji_pokok+$upah_harian)-(($telat1*15000)+($telat2*25000)+($telat3*45000));
}

$query = "update gaji set bulan='$bulan', tahun='$tahun', tanggal_transfer='$tanggal_transfer', id_karyawan='$nama_karyawan', id_jabatan='$jabatan', gaji_pokok='$gaji_pokok', uang_transport='$uang_transport', hari_kerja='$hari_kerja', kehadiran='$kehadiran_kerja', bonus='$bonus', jumlah_lembur='$jumlah_lembur', telat1='$telat1', telat2='$telat2', telat3='$telat3', total_gaji='$total_gaji' where id_gaji='$id_gaji' ";
//var_dump($query); exit;
$hasil = mysql_query($query);
if($hasil)
{
	header ("location:index.php");
} else {
	echo "Penyimpanan Gagal";
}

?>