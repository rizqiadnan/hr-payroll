<?php
error_reporting(null);
session_start();
$root = '../';
$out = '../';
include "../koneksi.php";
include "../pengguna.php";
include "../pagination.php";
include "../set.php";

// mengatur vaiabel reload dan sql 
if (isset($_REQUEST['keyword']) && $_REQUEST['keyword'] <> "") {
	// jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
	// pakai ini
	$keyword	= $_REQUEST['keyword'];
	$reload		= "index.php?pagination=true&keyword=$keyword";
	$sql 		= "SELECT karyawan.id_karyawan, karyawan.foto, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, karyawan.alamat, karyawan.no_telepon, karyawan.status, karyawan.awal, karyawan.akhir from penggajian.jabatan inner join penggajian.karyawan on (jabatan.id_jabatan = karyawan.id_jabatan) WHERE nama_karyawan LIKE '%$keyword%' ORDER BY id_karyawan asc";

	$result = mysql_query($sql);
} else {
	//  jika tidak ada pencarian pakai ini
	$reload = "index.php?pagination=true";
	$sql    = "SELECT karyawan.id_karyawan, karyawan.foto, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.alamat, karyawan.gaji_pokok, karyawan.uang_transport, karyawan.no_telepon, karyawan.status, karyawan.awal, karyawan.akhir from penggajian.jabatan inner join penggajian.karyawan on (jabatan.id_jabatan = karyawan.id_jabatan) ORDER BY id_karyawan asc";
	$result = mysql_query($sql);
}
//pagination
$rpp 		= 5; // jumlah record per halaman
$page 		= intval($_GET["page"]);
if ($page <= 0) $page = 1;
$tcount 	= mysql_num_rows($result);
$tpages 	= ($tcount) ? ceil($tcount / $rpp) : 1; // total pages, last page number
$count		= 0;
$i 			= ($page - 1) * $rpp;
$no_urut	= ($page - 1) * $rpp;
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Karyawan</title>

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
						<li class="active">
							<i class="fa fa-arrow-circle-o-right"></i> Karyawan
						</li>
					</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						1. Icon <i class="fa fa-plus-circle"></i> berfunsi sebagai menambah data karyawan <br>
						2. Icon <i class="fa fa-edit"></i> berfunsi untuk mengedit data karyawan yang dipilih <br>
						2. Icon <i class="fa fa-trash"></i> berfunsi untuk menghapus data karyawan yang dipilih
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> Tambah Data Karyawan</button>
						</div>
						<div class="panel-body">
							</br>
							<div class="col-lg-8">
								<?php
								while (($count < $rpp) && ($i < $tcount)) {
									mysql_data_seek($result, $i);
									$data = mysql_fetch_array($result);
								?>
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<span><b>NIK : </b><?php echo $data['id_karyawan'] ?></span>
										</div>
										<div class="panel-body">
											<div class="col-lg-3">
												<img src="gambar/<?php echo $data['foto'] ?>" width="150px" height="200px" />
											</div>
											<div class="col-lg-8">
												<table class="table">
													<tr>
														<td><b>Nama</b></td>
														<td>: <?php echo $data['nama_karyawan'] ?></td>
													</tr>
													<tr>
														<td><b>Jabatan</b></td>
														<td>: <?php echo $data['nama_jabatan'] ?></td>
													</tr>
													<tr>
														<td><b>Alamat</b></td>
														<td>: <?php echo $data['alamat'] ?></td>
													</tr>
													<tr>
														<td><b>No HP</b></td>
														<td>: <?php echo $data['no_telepon'] ?></td>
													</tr>
													<tr>
														<td><b>Status</b></td>
														<td>: <?php echo $data['status'] ?></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="panel-footer">
											<center>
												<!-- <a class="btn btn-sm btn-primary" href="detail.php?id_karyawan=<?php //echo $data['id_karyawan'] 
																													?>" title="Detail Data" ><span class="fa fa-search-plus"></span></a> -->
												<a class="btn btn-sm btn-info" href="edit.php?id_karyawan=<?php echo $data['id_karyawan'] ?>" title="Edit Data"><span class="fa fa-edit"></span></a>
												<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_karyawan=<?php echo $data['id_karyawan'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data"><span class="fa fa-trash"></span></a>
											</center>
										</div>
									</div>
								<?php
									$i++;
									$count++;
								}
								?>
								<center>
									<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
								</center>
							</div>
							<div class="col-lg-4">

								<a href="laporan.php" target="_blank" class="btn btn-default pull-left"><i class="fa fa-print"></i> Cetak</a></br></br>
								<form method="post" action="index.php">
									<div class="form-group input-group">
										<input type="text" name="keyword" class="form-control" placeholder="Search..." value="<?php echo $_REQUEST['keyword']; ?>">
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Cari Nama
											</button>
										</span>
									</div>
								</form>

								<!--muncul jika ada pencarian (tombol reset pencarian)-->
								<?php
								if ($_REQUEST['keyword'] <> "") {
								?>
									<a class="btn btn-default btn-outline" href="index.php"><i class="fa fa-undo"></i> Kembali </a></br>
								<?php
								}

								?>
								<ul>
									<li>Jumlah Record = <?php echo $tcount; ?></li>
									<li>Jumlah Halaman = <?php echo $tpages; ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">

			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- modal input -->
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Karyawan Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>ID Karyawan</label>
							<input name="id_karyawan" type="text" class="form-control" placeholder="ID Karyawan .." required>
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input name="foto" id="gambar" type="file" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nama Karyawan</label>
							<input name="nama_karyawan" type="text" class="form-control" placeholder="Nama Karyawan .." required>
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<select class="form-control" name="id_jabatan" id="id_jabatan" required="required">
								<option value="">Silahkan Pilih</option>
								<?php
								$jbt = mysql_query("select * from jabatan");
								while ($j = mysql_fetch_array($jbt)) {
								?>
									<option value="<?php echo $j['id_jabatan']; ?>"><?php echo $j['nama_jabatan'] ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group" hidden>
							<label>Gaji Pokok</label>
							<input name="gaji_pokok" id="gaji_pokok" type="text" class="form-control" placeholder="Gaji Pokok .." required hidden>
						</div>
						<div class="form-group" hidden>
							<label>Uang Transport</label>
							<input name="uang_transport" id="uang_transport" type="text" class="form-control" placeholder="Uang Transport .." required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" type="text" class="form-control" placeholder="Alamat .." required>
						</div>
						<div class="form-group">
							<label>No Telepon</label>
							<input name="no_telepon" type="text" class="form-control" placeholder="No Telepon .." required>
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status" required="required">
								<!-- <input name="status" type="text" class="form-control" placeholder="Status .." required> -->
								<option value=""> -- Silahkan Pilih -- </option>
								<option value="Magang"> Magang </option>
								<option value="Kontrak"> Kontrak </option>
								<option value="Karyawan Tetap"> Karyawan Tetap </option>
							</select>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<label>Awal</label>
								<input name="awal" type="text" class="form-control" id="awal" placeholder="Mulai ..">
							</div>
							<div class="col-md-6">
								<label>Akhir</label>
								<input name="akhir" type="text" class="form-control" id="akhir" placeholder="Akhir ..">
							</div><br>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="../assets/vendor/raphael/raphael.min.js"></script>
	<script src="../assets/vendor/morrisjs/morris.min.js"></script>
	<script src="../assets/data/morris-data.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../assets/dist/js/sb-admin-2.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>

	<!-- Tanggal Awal -->
	<script type="text/javascript">
		$(document).ready(function() {

			$('#awal').datepicker({
				dateFormat: 'yy-mm-dd'
			});

		});
	</script>

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