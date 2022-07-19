<?php 
include "../koneksi.php";

$id_jabatan=$_GET['id_jabatan'];

$query = "Delete From jabatan Where id_jabatan='$id_jabatan'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>