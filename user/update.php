<?php
include "../koneksi.php";

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "update user set username='$username', password='$password' where id_user='$id_user' ";
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}

?>