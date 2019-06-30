<?php
  // $path = realpath(__DIR__ . '/..');
  // include_once($path . '/init/db.php');
  // session_start();
  // ob_start();
  if(empty($_SESSION)){
    header('Location:../index.php');
  }else {
    if ($_SESSION['role_user']!='Admin') {
       header('Location:../index.php');
    }
  }

  include_once 'models/Karyawans.php';
  $database = new Database();
  $db = $database->connect();

  $peg = new Karyawan($db);
  $result = $peg->readKaryawan($_SESSION['id_peg']);

  $row = $result->fetch(PDO::FETCH_ASSOC); 

// include "init/db.php";
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
  <a href="/cafe/admin/index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>I</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Inland Cafe</b></span>
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
            <img src="/cafe/dist/img/user2-160x160.png" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <?php
            // echo "<span class='hidden-xs'>".$result['nama']."</span>";
            echo "<span class='hidden-xs'>".$row['nama_pegawai']."</span>";
            ?>
            <!-- <span class="hidden-xs">Alexander Pierce</span> -->
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="/cafe/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
              <p>
                <?php
                // echo "".$result[nama]." - ".$result[jabatan];
                // echo "".$result['nama']." - ".$result['level'];
                echo "<span class='hidden-xs'>".$row['nama_pegawai']."</span>";
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
                <div class="pull-left">
                  <a href="/cafe/logout.php" class="btn btn-default btn-flat"><label>Logout</label></a>
                </div>
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
          <img src="/cafe/admin/Golden_logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <h4>Administrator</h4>
          <!-- Status -->
          <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class='<?php if($page_header=="index"){echo "active";} ?>'><a href="/cafe/admin/index.php"><i class="fas fa-home"></i> <span> Dashboard</span></a></li>


        <!-- Menu -->
        <li class='treeview <?php if($page_header=="menu"){echo "active";} ?>'>
          <a href=""><i class="fas fa-boxes"></i><span> Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class='<?php if($page_li=="tambah_menu"){echo "active";} ?>'><a href="/cafe/admin/menu/menu.php"> <i
                  class="fa fa-plus"></i>Tambah Menu</a></li>
            <li class='<?php if($page_li=="daftar_menu"){echo "active";} ?>'><a href="/cafe/admin/menu/list_menu.php"><i
                  class="fa fa-list"></i> List Menu</a></li>
          </ul>
        </li>
        <!-- /Menu -->

        <!-- Pengeluaran -->
        <li class='treeview <?php if($page_header=="pengeluaran"){echo "active";} ?>' >
          <a href="#"><i class="fa fa-shopping-basket"></i> <span>Pengeluaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class='<?php if($page_li=="tambah_penge"){echo "active";} ?>'><a href="/cafe/admin/pengeluaran/pengeluaran.php"> <i class="fa fa-plus"></i>Tambah Pengeluaran</a></li>
            <li class='<?php if($page_li=="daftar_penge"){echo "active";} ?>'><a href="/cafe/admin/pengeluaran/list_pengeluaran.php"><i class="fa fa-list"></i> List Pengeluaran</a>
            </li>
          </ul>
        </li>
        <!-- /Pengeluaran -->

        <!-- User -->
        <li class="treeview <?php if($page_header=="karyawan"){echo "active";} ?>">
          <a href="#"><i class="fa fa-user"></i> <span> Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class='<?php if($page_li=="tambah_karyawan"){echo "active";} ?>'><a href="/cafe/admin/karyawan/new_karyawan.php"> <i class="fa fa-plus"></i>Tambah Karyawan</a></li>
            <li class='<?php if($page_li=="list_karyawan"){echo "active";} ?>'><a href="/cafe/admin/karyawan/list_karyawan.php"><i class="fa fa-list"></i>List Karyawan</a></li>
            <li class='<?php if($page_li=="tambah_user"){echo "active";} ?>'><a href="/cafe/admin/karyawan/new_user.php"> <i class="fa fa-plus"></i>Tambah User</a></li>
            <li class='<?php if($page_li=="list_user"){echo "active";} ?>'><a href="/cafe/admin/karyawan/list_user.php"><i class="fa fa-list"></i>List User</a></li>
          </ul>
        </li>
        <!-- /User -->

        <!-- Laporan -->
        <li class='treeview <?php if($page_header=="laporan"){echo "active";} ?>'>
          <a href="#"><i class="fa fa-folder-open"></i>Laporan
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class='<?php if($page_li=="penjualan"){echo "active";} ?>' ><a href="/cafe/admin/laporan/laporan_penjualan.php"><i class="fa fa-file-text"></i>Laporan Penjualan</a>
            </li>

            <!-- <li><a href="/cafe/admin/laporan/laporan_karyawan.php"><i class="fa fa-file-o"></i>Laporan Karyawan</a></li> -->
            <!-- <li><a href="/cafe/admin/laporan/laporan_retur.php"><i class="fa fa-file-text"></i>Laporan Pembelian</a> -->
            <!-- </li> -->
            <li  class='<?php if($page_li=="pengeluaran"){echo "active";} ?>'><a href="/cafe/admin/laporan/laporan_pengeluaran.php"><i class="fa fa-file-text"></i>Laporan
                Pengeluaran</a>
            </li>
            <!-- <li><a href="/cafe/admin/laporan/laporan_barang_kosong.php"><i class="fa fa-file-text"></i>Laporan Barang
                Kosong</a> -->
            </li>
          </ul>
        </li>
        <!-- /Laporan -->
      </ul>
    <!-- /.sidebar-menu -->
    </section>
<!-- /.sidebar -->
</aside>