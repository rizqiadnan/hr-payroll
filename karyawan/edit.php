<?php
error_reporting(null);
session_start();
$root = '../';
$out = '../';
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>User</title>

	<!-- Bootstrap Core CSS -->
	<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom CSS jquery ui -->
	<link href="../assets/dist/js/jquery-ui/jquery-ui.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="../assets/vendor/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<?php
		include '../sidebar.php';
		?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Karyawan</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-arrow-circle-o-right"></i><a href="index.php"> Karyawan </a>
						</li>
						<li class="active">
							<i class="fa fa-edit"></i> Edit Karyawan
						</li>
					</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<?php
					$id_karyawan = mysql_real_escape_string($_GET['id_karyawan']);
					$det = mysql_query("SELECT karyawan.id_karyawan, karyawan.foto, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, karyawan.alamat, karyawan.no_telepon, karyawan.status, karyawan.awal, karyawan.akhir from penggajian.jabatan inner join penggajian.karyawan on (jabatan.id_jabatan = karyawan.id_jabatan) where id_karyawan='$id_karyawan'") or die(mysql_error());
					while ($d = mysql_fetch_array($det)) {
					?>
						<div class="panel panel-primary">
							<div class="panel-heading"><i class="fa fa-users"></i> Edit Karyawan
							</div>
							<div class="panel-body">
								<form action="update.php" method="post" enctype="multipart/form-data">
									<table class="table">
										<tr>
											<td></td>
											<td><input type="hidden" name="id_karyawan" value="<?php echo $d['id_karyawan'] ?>"></td>
										</tr>
										<tr>
											<td>Foto</td>
											<td>
												<img src="gambar/<?php echo $d['foto'] ?>" width="150px" height="120px" /></br>
												<input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
												<input name="foto" type="file" class="form-control">
											</td>
										</tr>
										<tr>
											<td>Nama Karyawan</td>
											<td><input type="text" class="form-control" name="nama_karyawan" value="<?php echo $d['nama_karyawan'] ?>"></td>
										</tr>
										<tr>
											<td>Nama Jabatan</td>
											<td><select class="form-control" name="id_jabatan" id="id_jabatan">
													<?php
													$jbt = mysql_query("select * from jabatan");
													while ($b = mysql_fetch_array($jbt)) {
													?>
														<option value="<?php echo $b['id_jabatan']; ?>" <?php if ($d['nama_jabatan'] == $b['nama_jabatan']) echo "selected='selected'"; ?>><?php echo $b['nama_jabatan'] ?></option>
													<?php
													}
													?>
												</select>




											</td>
										</tr>
										<tr>
											<td>Gaji Pokok</td>
											<td><input type="text" class="form-control" name="gaji_pokok" id="gaji_pokok" value="<?php echo $d['gaji_pokok'] ?>"></td>
										</tr>
										<tr>
											<td>Uang Transport</td>
											<td><input type="text" class="form-control" name="uang_transport" id="uang_transport" value="<?php echo $d['uang_transport'] ?>"></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td><input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>"></td>
										</tr>
										<tr>
											<td>No Telepon</td>
											<td><input type="text" class="form-control" name="no_telepon" value="<?php echo $d['no_telepon'] ?>"></td>
										</tr>
										<tr>
											<td>Status</td>
											<td><select class="form-control" name="status" required="required">
													<!-- <input name="status" type="text" class="form-control" placeholder="Status .." required> -->
													<option value=""> -- Silahkan Pilih -- </option>
													<option value="Magang" <?php if ($d['status'] == 'Magang') {
																				echo 'selected';
																			} ?>> Magang </option>
													<option value="Kontrak" <?php if ($d['status'] == 'Kontrak') {
																				echo 'selected';
																			} ?>> Kontrak </option>
													<option value="Karyawan Tetap" <?php if ($d['status'] == 'Karyawan Tetap') {
																						echo 'selected';
																					} ?>> Karyawan Tetap </option>
												</select>
											</td>
										</tr>
										<tr>
											<input type="hidden" class="form-control" name="awal" id="awal" autocomplete="off" value="<?php echo $d['awal'] ?>">
										</tr>
										<tr>
											<td>Berlaku</td>
											<td><input type="text" class="form-control" name="akhir" id="akhir" autocomplete="off" value="<?php echo $d['akhir'] ?>"></td>
										</tr>
										<tr>
											<td></td>
											<td>
												<input type="submit" class="btn btn-info" value="Simpan">
												<a href="index.php" class="btn btn-danger">Batal</a>
											</td>
										</tr>
									</table>
								</form>
							<?php
						}
							?>
							</div>
						</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->


	<!-- jQuery -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="../assets/vendor/raphael/raphael.min.js"></script>
	<script src="../assets/vendor/morrisjs/morris.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../assets/dist/js/sb-admin-2.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>


	<!-- Tanggal Akhir -->
	<script type="text/javascript">
		$(document).ready(function() {

			$('#akhir').datepicker({
				dateFormat: 'yy-mm-dd'
			});

		});
	</script>

	<script type="text/javascript">
		$('#id_jabatan').change(function() {
			var id_jabatan = {
				id_jabatan: $('#id_jabatan').val()
			};
			var url = 'get_jabatan.php';
			$.post(url, id_jabatan, function(data) {
				var result = JSON.parse(data);
				if (id_jabatan != '') {
					$('#gaji_pokok').val(result.gaji_pokok);
					$('#uang_transport').val(result.uang_transport);
				} else {
					$('#gaji_pokok').val('');
					$('#uang_transport').val('');
				}
			});
		});
	</script>
</body>

</html>