<?php
error_reporting(null);
session_start(); //mulai session, krena kita akan menggunakan session pd file php ini
include 'koneksi.php'; //hubungkan dengan config.php untuk berhubungan dengan database


$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];


// $username=$_POST['username']; //tangkap data yg di input dari form login input username
// $password=$_POST['password']; //tangkap data yg di input dari form login input password

$query = mysql_query("select * from user where username='$username' and password='$password'");
$hasil = mysql_fetch_array($query);


if ($hasil) { // melakukan pemeriksaan kecocokan dengan percabangan.
	$_SESSION['id_user']	= $hasil['id_user'];
	$_SESSION['username'] 	= $hasil['username'];
	$_SESSION['password']  	= $hasil['password'];
	// $_SESSION['username']=$username; //jika cocok, buat session dengan nama sesuai dengan username
	header("location:dashboard/index.php"); // dan alihkan ke index.php
} else { //jika tidak tampilkan pesan gagal login
	echo "<script> 
	alert('Username atau Password Salah'); 
	location = 'index.php'; 
	</script>";
}
