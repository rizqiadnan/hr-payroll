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

	<!-- Custom CSS jquery ui -->
	<link href="../assets/dist/js/jquery-ui/jquery-ui.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

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
					<h1 class="page-header">Penggajian</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-arrow-circle-o-right"></i><a href="index.php"> Penggajian </a>
						</li>
						<li class="active">
							<i class="fa fa-edit"></i> Edit Penggajian
						</li>
					</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<?php
					$id_gaji = mysql_real_escape_string($_GET['id_gaji']);
					$det = mysql_query("SELECT gaji.id_gaji, gaji.bulan, gaji.tahun, gaji.tanggal_transfer, karyawan.nama_karyawan, jabatan.id_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, gaji.hari_kerja, gaji.kehadiran, gaji.bonus, gaji.jumlah_lembur, gaji.telat1, gaji.telat2, gaji.telat3, gaji.total_gaji 
						from ((penggajian.gaji 
						inner join penggajian.karyawan on karyawan.id_karyawan = gaji.id_karyawan) 
						inner join penggajian.jabatan on jabatan.id_jabatan = gaji.id_jabatan) where id_gaji='$id_gaji'") or die(mysql_error());
					while ($d = mysql_fetch_array($det)) {
					?>
						<div class="panel panel-primary">
							<div class="panel-heading"><i class="fa fa-user"></i> Edit User
							</div>
							<div class="panel-body">
								<form action="update.php" method="post" enctype="multipart/form-data">
									<table class="table">
										<tr>
											<td></td>
											<td><input type="hidden" class="form-control" name="id_gaji" value="<?php echo $d['id_gaji'] ?>"></td>
										</tr>
										<tr>
											<td>Bulan</td>
											<td><select name="bulan" class="form-control" required="required">
													<?php
													$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
													$jlh_bln = count($bulan);
													for ($c = 1; $c < $jlh_bln; $c += 1) {
													?>
														<option value="<?php echo $bulan[$c]; ?>" <?php if ($d['bulan'] == $bulan[$c]) echo "selected='selected'"; ?>><?php echo $bulan[$c]; ?> </option>
													<?php
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Tahun</td>
											<td><select name="tahun" class="form-control" required="required">
													<?php
													$now = date('Y');
													for ($a = 2012; $a <= $now; $a++) {
													?>
														<option value="<?php echo $a; ?>" <?php if ($d['tahun'] == $a) echo "selected='selected'"; ?>><?php echo $a; ?> </option>
													<?php
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Tanggal Transfer</td>
											<td><input type="text" class="form-control" name="tanggal_transfer" id="tanggal_transfer2" value="<?php echo $d['tanggal_transfer'] ?>"></td>
										</tr>
										<tr>
											<td>Nama Karyawan</td>
											<td><select class="form-control" name="nama_karyawan" required="required" id="gaji">

													<?php
													$kry = mysql_query("select * from karyawan");
													while ($nk = mysql_fetch_array($kry)) {
													?>
														<option value="<?php echo $nk['id_karyawan']; ?>" <?php if ($d['nama_karyawan'] == $nk['nama_karyawan']) echo "selected='selected'"; ?>><?php echo $nk['nama_karyawan']; ?></option>
													<?php
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<input type="hidden" class="form-control" name="jabatan" id="id_jabatan" value="<?php echo $d['id_jabatan'] ?>" readonly>
										</tr>
										<tr>
											<td>Gaji Pokok</td>
											<td><input type="text" class="form-control" name="gaji_pokok" id="gaji_pokok" value="<?php echo $d['gaji_pokok'] ?>" readonly></td>
										</tr>
										<tr>
											<td>Kehadiran Kerja</td>
											<td><input type="text" class="form-control" name="uang_transport" id="uang_transport" value="<?php echo $d['uang_transport'] ?>" readonly></td>
										</tr>
										<tr>
											<td>Jumlah Hari Kerja</td>
											<td><input type="text" class="form-control" name="hari_kerja" value="<?php echo $d['hari_kerja'] ?>"></td>
										</tr>
										<tr>
											<td>Kehadiran Kerja</td>
											<td><input type="text" class="form-control" name="kehadiran_kerja" value="<?php echo $d['kehadiran'] ?>"></td>
										</tr>
										<tr>
											<td>Jumlah Lembur</td>
											<td><input type="text" class="form-control" name="jumlah_lembur" value="<?php echo $d['jumlah_lembur'] ?>"></td>
										</tr>
										<tr>
											<td>Bonus</td>
											<td><input type="text" class="form-control" name="bonus" value="<?php echo $d['bonus'] ?>" readonly></td>
										</tr>
										<tr>
											<td>Telat1 > 15 Menit</td>
											<td><input type="text" class="form-control" name="telat1" value="<?php echo $d['telat1'] ?>"></td>
										</tr>
										<tr>
											<td>Telat2 > 60 Menit</td>
											<td><input type="text" class="form-control" name="telat2" value="<?php echo $d['telat2'] ?>"></td>
										</tr>
										<tr>
											<td>Telat3 > 120 Menit</td>
											<td><input type="text" class="form-control" name="telat3" value="<?php echo $d['telat3'] ?>"></td>
										</tr>
										<tr>
											<td>Total Gaji</td>
											<td><input type="text" class="form-control" name="total_gaji" value="<?php echo $d['total_gaji'] ?>" readonly></td>
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

	<script type="text/javascript">
		$(document).ready(function() {

			$('#tanggal_transfer2').datepicker({
				dateFormat: 'yy-mm-dd'
			});

		});
	</script>
	<script type="text/javascript">
		$('#gaji').change(function() {
			var gaji = {
				gaji: $('#gaji').val()
			};
			var url = 'get_gaji.php';
			$.post(url, gaji, function(data) {
				var result = JSON.parse(data);
				if (gaji != '') {
					$('#id_jabatan').val(result.id_jabatan);
					$('#gaji_pk').val(result.gaji_pokok);
					$('#uang_trans').val(result.uang_transport);
				} else {
					$('#jabatan').val('');
					$('#gaji_pk').val('');
					$('#uang_trans').val('');
				}
			});
		});
	</script>
</body>

</html>