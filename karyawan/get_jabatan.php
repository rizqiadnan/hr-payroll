<?php 
include '../koneksi.php';
$jabatan=$_POST['id_jabatan'];
$hasil = mysql_query("select * from jabatan where id_jabatan='$jabatan'");
$result = mysql_fetch_array($hasil);
echo json_encode($result);
?>