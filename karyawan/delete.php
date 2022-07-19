<?php 
include "../koneksi.php";

$id_karyawan=$_GET['id_karyawan'];

$query = "Delete From karyawan Where id_karyawan='$id_karyawan'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>