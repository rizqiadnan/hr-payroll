<?php 
include "../koneksi.php";

$id_gaji=$_GET['id_gaji'];

$query = "Delete From gaji Where id_gaji='$id_gaji'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>