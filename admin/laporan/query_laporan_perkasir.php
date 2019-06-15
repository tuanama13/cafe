<?php
    // include '../init/db.php';
    $path = realpath(__DIR__ . '/../..');
    include_once($path . '/init/db.php');
    require '../functions.php';


    $kasir = isset( $_GET['kasir']) ?  $_GET['kasir'] : null;
    $tgl = isset( $_GET['tgl']) ?  $_GET['tgl'] : null;

    if (empty($kasir)) {
      header("Location: laporan_penjualan.php");
    } else if ($kasir == 'all') {
      $sql = "SELECT * FROM tbl_orders WHERE DATE(tgl_order) = '$tgl' ORDER BY tgl_order DESC";
    }else{
      header("Location: laporan_penjualan.php");
    }

    
    $run_sql = mysqli_query($conn,$sql);
    $row_cnt = mysqli_num_rows($run_sql);
    if ($row_cnt <= 0) {
      echo "<tr><td colspan='6' align ='center'>Data Tidak Ditemukan</td></tr>";
    }else{
      while($rows = mysqli_fetch_assoc($run_sql)){
      echo "
      <tr>
        <td><button data-kode-tran='$rows[id_order]' class='detail' data-toggle='modal' data-target='#myModal'>$rows[id_order]</button></td>
        <td>$rows[tgl_order]</td>
        <td>".rupiah($rows['grandtotal'])."</td>
      </tr>";
      }
    }
?>