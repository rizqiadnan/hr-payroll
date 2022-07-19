<?php
include "../koneksi.php";

$nama_jabatan=$_POST['nama_jabatan'];
$gaji_pokok=$_POST['gaji_pokok'];
$uang_transport=$_POST['uang_transport'];

$query = "insert into jabatan values ('','$nama_jabatan','$gaji_pokok','$uang_transport')";
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}

?>