<?php
include "../koneksi.php";

$username=$_POST['username'];
$password = md5($_POST['password']);

$query = "insert into user values ('','$username','$password')";
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}

?>