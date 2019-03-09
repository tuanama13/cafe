<?php
// session_start();
ob_start();
include "init/db.php";
// include "admin_login.php";
// $id = $_SESSION['username'];
// $level = $_SESSION['level'];
// $kar = $_SESSION['id_karyawan']
// $sql = mysqli_query($conn, "SELECT * FROM tb_karyawan JOIN tb_user USING(id_karyawan) WHERE username = '$id'");
// $result = mysqli_fetch_assoc($sql);
?>
<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="/tb/index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>G</b>B</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Golden Bangunan</b></span>
  </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="/tb/dist/img/user2-160x160.png" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <?php
            // echo "<span class='hidden-xs'>".$result['nama']."</span>";
            echo "<span class='hidden-xs'>Golden Bangunan</span>";
            ?>
            <!-- <span class="hidden-xs">Alexander Pierce</span> -->
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="/tb/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
              <p>
                <?php
                // echo "".$result[nama]." - ".$result[jabatan];
                // echo "".$result['nama']." - ".$result['level'];
                echo "<span class='hidden-xs'>Golden Bangunan</span>";
                ?>
               
              </p>
            </li>
            <!-- Menu Body -->
            <!-- <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div> -->
              <!-- /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/tb/Golden_logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <h4>Administrator</h4>
          <!-- Status -->
          <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="/tb/index.php"><i class="fas fa-home"></i> <span>   Dashboard</span></a></li>
        <!-- <li><a href="pembelian/pembelian.php"><i class="fa fa-tags"></i> <span>Pembelian</span></a></li> -->
        <!-- <li><a href="invoice/transaksi.php"><i class="fa fa-tags"></i> <span>Cetak Faktur</span></a></li> -->
        
        <!--       <li><a href="../penagihan/penagihan.php"><i class="fa fa-history"></i> <span>Penagihan</span></a></li>
        -->
        <li class="treeview" hidden="true">
          <a href="#"><i class="fa fa-users"></i> <span>  Karyawan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/tb/karyawan/new_karyawan.php" > <i class="fa fa-plus"></i>Tambah Karyawan</a></li>
          <li><a href="/tb/karyawan/list_karyawan.php"><i class="fa fa-list"></i>  List Karyawan</a></li>
        </ul>
      </li>
      <!-- <li class="treeview">
        <a href="#"><i class="fa fa-file-o"></i> <span>  Retur Barang</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="../retur/retur_brg.php" > <i class="fa fa-plus"></i>Retur Barang</a></li>
        <li><a href="../retur/list_retur.php"><i class="fa fa-list"></i>  List Retur Barang</a></li>
      </ul>
    </li> -->
    <li class="treeview">
      <a href=""><i class="fas fa-boxes"></i><span>     Barang</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/tb/barang/barang.php" > <i class="fa fa-plus"></i>Tambah Barang</a></li>
      <li><a href="/tb/barang/list_barang.php"><i class="fa fa-list"></i>  List Barang</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#"><i class="fa fa-shopping-basket"></i> <span>Pengeluaran</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="/tb/pengeluaran/pengeluaran.php" > <i class="fa fa-plus"></i>Tambah Pengeluaran</a></li>
    <li><a href="/tb/pengeluaran/list_pengeluaran.php"><i class="fa fa-list"></i>  List Pengeluaran</a></li>
  </ul>
</li>
<li class="treeview">
  <a href="#"><i class="fas fa-dolly-flatbed"></i> <span>   Pembelian</span>
  <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span>
</a>
<ul class="treeview-menu">
  <li><a href="/tb/piutang/tambah_piutang.php" > <i class="fa fa-plus"></i>Tambah Pembelian</a></li>
  <li><a href="/tb/piutang/list_piutang.php"><i class="fa fa-list"></i>List Pembelian</a></li>
</ul>
</li>
<li class="treeview">
<a href="#"><i class="fa fa-cart-arrow-down"></i> <span> Retur</span>
<span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu">
<li><a href="/tb/retur/retur.php" > <i class="fa fa-plus"></i>Tambah Retur</a></li>
<li><a href="/tb/retur/retur_bagus.php" > <i class="fa fa-plus"></i>Tambah Retur Barang Bagus</a></li>
<li><a href="/tb/retur/list_retur.php" > <i class="fa fa-list"></i>List Retur</a></li>
<!-- <li><a href="/tb/retur/list_retur.php" > <i class="fa fa-plus"></i>List Retur</a></li> -->
<!-- <li><a href="../pembelian/list_pembelian.php"><i class="fa fa-list"></i>List Pembelian</a></li> -->
</ul>
</li>
<li class="treeview" hidden="true">
<a href="#"><i class="fa fa-user"></i> <span> User</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu">
<li><a href="/tb/karyawan/new_user.php" > <i class="fa fa-plus"></i>Tambah User</a></li>
<li><a href="/tb/karyawan/list_user.php"><i class="fa fa-list"></i>List User</a></li>
</ul>
</li>
<li class="treeview">
<a href="#"><i class="fa fa-folder-open"></i>Laporan
  <span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu">
<li><a href="/tb/laporan/laporan_tahun.php" ><i class="fa fa-file-text"></i>Laporan Penjualan</a></li>

<!-- <li><a href="/tb/laporan/laporan_karyawan.php"><i class="fa fa-file-o"></i>Laporan Karyawan</a></li> -->
<li><a href="/tb/laporan/laporan_retur.php"><i class="fa fa-file-text"></i>Laporan Pembelian</a></li>
<li><a href="/tb/laporan/laporan_pengeluaran.php"><i class="fa fa-file-text"></i>Laporan Pengeluaran</a></li>
<li><a href="/tb/laporan/laporan_barang_kosong.php"><i class="fa fa-file-text"></i>Laporan Barang Kosong</a></li>
</ul>
</li>
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>