<?php
    include '../init/db.php';
    require '../functions.php';
    $tahun = isset( $_GET['tahun']) ?  $_GET['tahun'] : null;

    if (empty($tahun)) {
      header("Location: laporan_tahun.php");
    } else if ($tahun == 'all') {
      $sql = "SELECT * FROM tb_transaksi WHERE YEAR(waktu) = YEAR(CURDATE()) ORDER BY waktu DESC";
    }else{
      $sql = "SELECT * FROM tb_transaksi WHERE YEAR(waktu) = '$tahun' ORDER BY waktu DESC";
    }

    $run_sql = mysqli_query($conn,$sql);
    $row_cnt = mysqli_num_rows($run_sql);
    
    if ($row_cnt <= 0) {
      echo "<tr><td colspan='6' align ='center'>Data Tidak Ditemukan</td></tr>";
      }else{
      while($rows = mysqli_fetch_assoc($run_sql)){
        echo "
        <tr>
          <td><button data-kode-tran='$rows[kode_transaksi]' class='detail' data-toggle='modal' data-target='#myModal'>$rows[kode_transaksi]</button></td>
          <td>$rows[waktu]</td>
          <td>".rupiah($rows['total'])."</td>
        </tr>";
      }
    }
?>