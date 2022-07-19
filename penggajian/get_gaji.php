<?php 
include '../koneksi.php';
$gaji=$_POST['gaji'];
$hasil = mysql_query("SELECT karyawan.id_karyawan, karyawan.nama_karyawan, jabatan.id_jabatan, karyawan.gaji_pokok, karyawan.uang_transport from penggajian.jabatan inner join penggajian.karyawan on (jabatan.id_jabatan = karyawan.id_jabatan) where id_karyawan='$gaji'");
$result = mysql_fetch_array($hasil);
echo json_encode($result);
