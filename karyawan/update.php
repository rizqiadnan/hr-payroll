<?php
include "../koneksi.php";
error_reporting(null);
session_start();
$id_karyawan = $_POST['id_karyawan'];
$nama_karyawan = $_POST['nama_karyawan'];
$id_jabatan = $_POST['id_jabatan'];
$gaji_pokok = $_POST['gaji_pokok'];
$uang_transport = $_POST['uang_transport'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$status = $_POST['status'];
$awal = $_POST['awal'];
$akhir = $_POST['akhir'];

// Cek apakah ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_foto'])){ // Jika menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$sumber = $_FILES['foto']['name'];
	$nama_gambar = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal upload
	$fotobaru = date('d-m-Y').$sumber;
	
	// Set path folder tempat menyimpan fotonya
	$path = "gambar/".$fotobaru;

	if(move_uploaded_file($nama_gambar, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data 
		$query = "SELECT karyawan.id_karyawan, karyawan.foto, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, karyawan.alamat, karyawan.no_telepon, karyawan.status , karyawan.awal , karyawan.akhir from penggajian.jabatan inner join penggajian.karyawan on (jabatan.id_jabatan = karyawan.id_jabatan) where id_karyawan='$id_karyawan' ";
		$sql = mysql_query($query);
		$data = mysql_fetch_array($sql);

		// Cek apakah file gambar sebelumnya ada di folder gambar
		if(is_file("gambar/".$data['foto'])) // Jika gambar ada
			unlink("gambar/".$data['foto']); // Hapus file gambar sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$query = "update karyawan set foto='$fotobaru', nama_karyawan='$nama_karyawan', id_jabatan='$id_jabatan', gaji_pokok='$gaji_pokok', uang_transport='$uang_transport', alamat='$alamat', no_telepon='$no_telepon', status='$status', awal='$awal', akhir='$akhir' where id_karyawan='$id_karyawan'";
		$sql = mysql_query($query); // Eksekusi/ Jalankan query dari variabel $query

		if($sql){ // Cek jika proses simpan ke database sukses atau tidak
			// Jika Sukses, Lakukan :
			header("location: index.php"); // Redirect ke halaman index.php
		}else{
			// Jika Gagal, Lakukan :
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
		}
	}else{
		// Jika gambar gagal diupload, Lakukan :
		echo   "<script> alert('Maaf, Gambar gagal untuk diupload'); 
				location = 'index.php'; 
				</script>";
	}
}else{ // Jika tidak menceklis checkbox yang ada di form ubah, lakukan :
	// Proses ubah data ke Database
	$query = "update karyawan set nama_karyawan='$nama_karyawan', id_jabatan='$id_jabatan', gaji_pokok='$gaji_pokok', uang_transport='$uang_transport', alamat='$alamat', no_telepon='$no_telepon', status='$status', awal='$awal', akhir='$akhir' where id_karyawan='$id_karyawan'";
	$sql = mysql_query($query); // Eksekusi/ Jalankan query dari variabel $query

	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		header("location: index.php"); // Redirect ke halaman index.php
	}else{
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
}
