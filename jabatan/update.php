<?php
include "../koneksi.php";

$id_jabatan = $_POST['id_jabatan'];
$nama_jabatan = $_POST['nama_jabatan'];
$gaji_pokok = $_POST['gaji_pokok'];
$uang_transport = $_POST['uang_transport'];

$query = "update jabatan set nama_jabatan='$nama_jabatan', gaji_pokok='$gaji_pokok', uang_transport='$uang_transport' where id_jabatan='$id_jabatan' ";
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}

?>