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
if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
// jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
	// pakai ini
$keyword	= $_REQUEST['keyword'];
$reload		= "index.php?pagination=true&keyword=$keyword";
$sql 		= "SELECT * FROM jabatan WHERE nama_jabatan LIKE '%$keyword%' ORDER BY id_jabatan asc";
			
$result = mysql_query($sql);
}else{
	//  jika tidak ada pencarian pakai ini
$reload = "index.php?pagination=true";
$sql    = "SELECT * FROM jabatan order by nama_jabatan asc "; 
$result = mysql_query($sql);
}
//pagination
$rpp 		= 5; // jumlah record per halaman
$page 		= intval($_GET["page"]);
if($page<=0) $page = 1;  
$tcount 	= mysql_num_rows($result);
$tpages 	= ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
$count		= 0;
$i 			= ($page-1)*$rpp;
$no_urut	= ($page-1)*$rpp;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jabatan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

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
			include '../sidebar.php' ;
		?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Jabatan</h1>
					<ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-arrow-circle-o-right"></i> Jabatan
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
                        1. Icon <i class="fa fa-plus-circle"></i> berfunsi sebagai menambah data jabatan <br>
						2. Icon <i class="fa fa-edit"></i> berfunsi untuk mengedit data jabatan yang dipilih <br>
						2. Icon <i class="fa fa-trash"></i> berfunsi untuk menghapus data jabatan yang dipilih
                    </div>
					<div class="panel panel-primary">
                        <div class="panel-heading">
							<button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> Tambah Data Jabatan</button>
						</div>
                        <div class="panel-body">
                            <div class="col-lg-8">
								<!--muncul jika ada pencarian (tombol reset pencarian)-->
								<?php
								if($_REQUEST['keyword']<>""){
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
											<button class="btn btn-primary" type="submit">Cari Jabatan
											</button>
										</span>
									</div>
									
								</form>
									<a href="laporan.php" target="_blank" class="btn btn-default pull-left"><i class="fa fa-print"></i> Cetak</a>
							</div>
							<br><br>
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:5px"><center>No</center></th>
                                            <th style="width:50px"><center>Jabatan</center></th>
                                            <th style="width:65px"><center>Gaji Pokok<center></th>
											<th style="width:40px"><center>Uang Transport</center></th>
											<th style="width:30px"><center>Opsi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										while(($count<$rpp) && ($i<$tcount)) {
										mysql_data_seek($result,$i);
										$data = mysql_fetch_array($result);
									?>
										<tr>
											<td><center><?php echo ++$no_urut; ?></center></td>
											<td><?php echo $data['nama_jabatan'] ?></td>
											<td>Rp. <?php echo number_format($data['gaji_pokok']) ?>,-</td>
											<td>Rp. <?php echo number_format($data['uang_transport']) ?>,-</td>
											<td>
												<center>
												<a class="btn btn-sm btn-info" href="edit.php?id_jabatan=<?php echo $data['id_jabatan'] ?>" title="Edit Data" ><span class="fa fa-edit"></span></a>
												<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_jabatan=<?php echo $data['id_jabatan'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data" ><span class="fa fa-trash"></span></a>
												</center>
											</td>
										</tr>
									<?php
										$i++;	
										$count++;	
										}
									?>
									<ul>
										<li>Jumlah Record = <?php echo $tcount; ?></li>
										<li>Jumlah Halaman = <?php echo $tpages; ?></li>
                                    </ul>
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
					<h4 class="modal-title">Tambah Jabatan Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Jabatan</label>
							<input name="nama_jabatan" type="text" class="form-control" placeholder="Jabatan .." required>
						</div>
						<div class="form-group">
							<label>Gaji Pokok</label>
							<input name="gaji_pokok" type="text" class="form-control" placeholder="Gaji Pokok .." required>
						</div>
						<div class="form-group">
							<label>Uang Transport</label>
							<input name="uang_transport" type="text" class="form-control" placeholder="Uang Transport .." required>
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

</body>

</html>
