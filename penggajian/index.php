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
	$sql 		= "SELECT gaji.id_gaji, gaji.bulan, gaji.tahun, gaji.tanggal_transfer, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, gaji.hari_kerja, gaji.kehadiran, gaji.bonus, gaji.jumlah_lembur, gaji.telat1, gaji.telat2, gaji.telat3, gaji.total_gaji 
				from ((penggajian.gaji 
				inner join penggajian.karyawan on karyawan.id_karyawan = gaji.id_karyawan) 
				inner join penggajian.jabatan on jabatan.id_jabatan = gaji.id_jabatan) WHERE tahun LIKE '%$keyword%' ORDER BY id_gaji asc";

	$result = mysql_query($sql);
} else {
	//  jika tidak ada pencarian pakai ini
	$reload = "index.php?pagination=true";
	$sql    = "SELECT gaji.id_gaji, gaji.bulan, gaji.tahun, gaji.tanggal_transfer, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, gaji.hari_kerja, gaji.kehadiran, gaji.bonus, gaji.jumlah_lembur, gaji.telat1, gaji.telat2, gaji.telat3, gaji.total_gaji 
				from ((penggajian.gaji 
				inner join penggajian.karyawan on karyawan.id_karyawan = gaji.id_karyawan) 
				inner join penggajian.jabatan on jabatan.id_jabatan = gaji.id_jabatan) ORDER BY id_gaji asc ";
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
?>


<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Penggajian</title>

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
					<h1 class="page-header">Penggajian</h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-arrow-circle-o-right"></i> Penggajian
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
						1. Icon <i class="fa fa-plus-circle"></i> berfungsi sebagai menambah data penggajian <br>
						2. Icon <i class="fa fa-edit"></i> berfunsi untuk mengedit data penggajian yang dipilih <br>
						3. Icon <i class="fa fa-trash"></i> berfunsi untuk menghapus data penggajian yang dipilih <br>
						4. Pada saat menginput Data Penggajian Ada Yang Terlambat hanya >15 Menit saja, sisanya diisi dengan <b>0</b><br>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> Tambah Data Penggajian</button>
						</div>
						<div class="panel-body">
							<div class="col-lg-8">
								<!--muncul jika ada pencarian (tombol reset pencarian)-->
								<?php
								if ($_REQUEST['keyword'] <> "") {
								?>
									<a class="btn btn-default btn-outline" href="index.php"><i class="fa fa-undo"></i> Kembali </a>
								<?php
								}
								?>
							</div>
							<div>
								<form method="post" action="index.php">
									<div class="form-group input-group">
										<input type="text" name="keyword" class="form-control" placeholder="Search..." value="<?php echo $_REQUEST['keyword']; ?>">
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Cari Tahun
											</button>
										</span>
									</div>

								</form>
								<!--	<a href="laporan.php" target="_blank" class="btn btn-default pull-left"><i class="fa fa-print"></i> Cetak</a> -->
							</div>
							<br><br>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>
												<center>No</center>
											</th>
											<th>
												<center>Bulan</center>
											</th>
											<th>
												<center>Tahun<center>
											</th>
											<th>
												<center>Tgl Transfer</center>
											</th>
											<th>
												<center>Nama Karyawan<center>
											</th>
											<th>
												<center>Jabatan<center>
											</th>
											<th>
												<center>Total Gaji</center>
											</th>
											<th>
												<center>Opsi</center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while (($count < $rpp) && ($i < $tcount)) {
											mysql_data_seek($result, $i);
											$data = mysql_fetch_array($result);
										?>
											<tr>
												<td>
													<center><?php echo ++$no_urut; ?></center>
												</td>
												<td><?php echo $data['bulan'] ?></td>
												<td><?php echo $data['tahun'] ?></td>
												<td><?php echo $data['tanggal_transfer'] ?></td>
												<td><?php echo $data['nama_karyawan'] ?></td>
												<td><?php echo $data['nama_jabatan'] ?></td>
												<td>Rp. <?php echo number_format($data['total_gaji']) ?>,-</td>
												<td>
													<center>
														<a class="btn btn-sm btn-warning" href="laporan.php?id_gaji=<?php echo $data['id_gaji'] ?>" target="_blank" title="Print Data"><span class="fa fa-print"></span></a>
														<a class="btn btn-sm btn-info" href="edit.php?id_gaji=<?php echo $data['id_gaji'] ?>" title="Edit Data"><span class="fa fa-edit"></span></a>
														<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_gaji=<?php echo $data['id_gaji'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data"><span class="fa fa-trash"></span></a>
													</center>
												</td>
											</tr>
										<?php
											$i++;
											$count++;
										}
										?>
									</tbody>
								</table>
								<center>
									<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
								</center>
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
					<h4 class="modal-title">Tambah Penggajian Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-md-6" style="margin-bottom: 15px;">
								<label>Bulan</label>
								<select name="bulan" class="form-control" required="required">
									<option value="">Pilih Bulan</option>
									<?php
									$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
									$jlh_bln = count($bulan);
									for ($c = 0; $c < $jlh_bln; $c += 1) {
										echo "<option value=$bulan[$c]> $bulan[$c] </option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6" style="margin-bottom: 15px;">
								<label>Tahun</label>
								<select name="tahun" class="form-control" required="required">
									<option value="">Pilih Tahun</option>
									<?php
									$now = date('Y');
									for ($a = 2012; $a <= $now; $a++) {
										echo "<option value='$a'>$a</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Transfer</label>
							<input name="tanggal_transfer" id="tanggal_transfer" type="text" class="form-control" placeholder="Tanggal Transfer..">
						</div>
						<div class="form-group">
							<label>Nama Karyawan</label>
							<select class="form-control" name="nama_karyawan" required="required" id="gaji">
								<option value="">Silahkan Pilih</option>
								<?php
								$kry = mysql_query("select * from karyawan");
								while ($nk = mysql_fetch_array($kry)) {
								?>
									<option value="<?php echo $nk['id_karyawan']; ?>"><?php echo $nk['nama_karyawan'] ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group" hidden>
							<label>Jabatan</label>
							<input name="jabatan" type="text" class="form-control" placeholder="Jabatan .." id="id_jabatan" readonly>
						</div>
						<div class="form-group">
							<label>Gaji Pokok</label>
							<input name="gaji_pokok" type="text" class="form-control" placeholder="Gaji Pokok .." id="gaji_pk" readonly>
						</div>
						<div class="form-group">
							<label>Uang Transport</label>
							<input name="uang_transport" type="text" class="form-control" placeholder="Uang Transport .." id="uang_trans" readonly>
						</div>
						<div class="form-group">
							<label>Jumlah Hari Kerja</label>
							<input name="hari_kerja" type="text" class="form-control" placeholder="Jumlah Hari Kerja .." required="required">
						</div>
						<div class="form-group">
							<label>Kehadiran Kerja</label>
							<input name="kehadiran_kerja" type="text" class="form-control" placeholder="Kehadiran Kerja .." required="required">
						</div>
						<div class="form-group">
							<label>Jumlah Lembur</label>
							<select name="jumlah_lembur" class="form-control" required="required">
								<option value="">Jumlah Lembur</option>
								<?php
								for ($lem = 0; $lem <= 30; $lem++) {
									echo "<option value='$lem'>$lem</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<select class="form-control" name="status" required="required" id="status" onchange="proses()">
								<!-- <input name="status" type="text" class="form-control" placeholder="Status .." required> -->
								<option value="-- Silahkan Pilih --"> -- Silahkan Pilih -- </option>
								<option value="Ada Terlambat">Ada Terlambat</option>
								<option value="Tidak Terlambat">Tidak Terlambat</option>
							</select>
						</div>
						<div class="form-group input-group" style="width: 100%;">
							<div class="col-md-4">
								<span>* >15 Menit</span>
								<input name="telat1" id="telat1" type="text" class="form-control" placeholder="Jumlah Telat .." readonly required="required">
							</div>
							<div class="col-md-4">
								<span>* >60 Menit</span>
								<input name="telat2" id="telat2" type="text" class="form-control" placeholder="Jumlah Telat .." readonly required="required">
							</div>
							<div class="col-md-4">
								<span>* >120 Menit</span>
								<input name="telat3" id="telat3" type="text" class="form-control" placeholder="Jumlah Telat .." readonly required="required">
							</div>
						</div>
						<!-- 
						<div class="form-group">
							<div class="col-md-6">
								<label>Bonus</label>
								<input name="bonus" id="bonus" type="text" class="form-control" placeholder="Bonus .." readonly>
							</div>
							<div class="col-md-6">
								<label>Jumlah Terlambat</label>
								<input name="jumlah_terlambat" id="jumlah_terlambat" type="text" class="form-control" placeholder="Jumlah Terlambat .." readonly>
							</div><br>
						</div> -->
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
	<script src="../../assets/dist/js/sb-admin-2.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#tanggal_transfer').datepicker({
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

	<!--
	<script type="text/javascript">
	function proses() {
		var status = { status: $('#status').val()};
		if (document.getElementById("status").value == "Tidak Terlambat"){
			$('#bonus').val("350000");
			$('#jumlah_terlambat').val("0").attr("readonly","readonly");
		}     
		else if (document.getElementById("status").value == "Ada Terlambat"){
			$('#bonus').val("0");
			$('#jumlah_terlambat').val("").removeAttr("readonly");
		}
		else if (document.getElementById("status").value == "-- Silahkan Pilih --"){
			$('#bonus').val("");
			$('#jumlah_terlambat').val("").attr("readonly","readonly");
		}
	}
	</script>
	-->
	<script type="text/javascript">
		function proses() {
			var status = {
				status: $('#status').val()
			};
			if (document.getElementById("status").value == "Tidak Terlambat") {
				$('#telat1').val("0").attr("readonly", "readonly");
				$('#telat2').val("0").attr("readonly", "readonly");
				$('#telat3').val("0").attr("readonly", "readonly");
			} else if (document.getElementById("status").value == "Ada Terlambat") {
				$('#telat1').val("").removeAttr("readonly");
				$('#telat2').val("").removeAttr("readonly");
				$('#telat3').val("").removeAttr("readonly");
			} else if (document.getElementById("status").value == "-- Silahkan Pilih --") {
				$('#telat1').val("").attr("readonly", "readonly");
				$('#telat2').val("").attr("readonly", "readonly");
				$('#telat3').val("").attr("readonly", "readonly");
			}
		}
	</script>

</body>

</html>