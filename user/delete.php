<?php 
include "../koneksi.php";

$id_user=$_GET['id_user'];

$query = "Delete From user Where id_user='$id_user'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>