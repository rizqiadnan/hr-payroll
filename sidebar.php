<?php
error_reporting(null);
session_start();
include 'koneksi.php';
include 'pengguna.php';
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $root; ?>dashboard/index.php"><b>SISTEM PENGGAJIAN - HR v1.0</b></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <?php
            if ($_SESSION['username']) : ?>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $nama->username ?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="https://rizqiadnan.my.id" target="_blank"><i class="fa fa-file fa-fw"></i> Website </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $out; ?>index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            <?php endif; ?>
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <!-- <center><img src="<?php echo $root; ?>/assets/gambar/...png" class="img-responsive" width="150px"></center> -->
                </li>
                <li>
                    <a href="<?php echo $root; ?>dashboard/index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>user/index.php"><i class="fa fa-user fa-fw"></i> User</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>jabatan/index.php"><i class="fa fa-user-plus fa-fw"></i> Jabatan</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>karyawan/index.php"><i class="fa fa-users fa-fw"></i> Karyawan</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>penggajian/index.php"><i class="fa fa-calculator fa-fw"></i> Penggajian</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>