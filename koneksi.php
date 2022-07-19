<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "penggajian";
$koneksi  = mysql_connect($host, $username, $password);
$pilihdatabase = mysql_select_db($database, $koneksi);
if ($pilihdatabase) echo "";
else echo "";
