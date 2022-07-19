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
                    <h1 class="page-header">User</h1>
					<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-arrow-circle-o-right"></i><a href="index.php"> User </a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Edit User
                            </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					<?php 
						$id_user = mysql_real_escape_string($_GET['id_user']);
						$det = mysql_query("select * from user where id_user='$id_user'")or die(mysql_error());
						while($d = mysql_fetch_array($det)){
					?>
					<div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-warning"></i> Untuk PASSWORD jika tidak ingin diubah masukan 'Password Lama atau Batal' dan jika ingin diubah masukan 'Password Baru'  <br>
					</div>
					<div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-user"></i>   Edit User
						</div>
                        <div class="panel-body">
							<form action="update.php" method="post">
								<table class="table">
									<tr>
										<td></td>
										<td><input type="hidden" name="id_user" value="<?php echo $d['id_user'] ?>"></td>
									</tr>
									<tr>
										<td>Username</td>
										<td><input type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>"></td>
									</tr>
									<tr>
										<td>Password</td>
										<td><input type="text" class="form-control" name="password" required></td>
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

</body>

</html>
