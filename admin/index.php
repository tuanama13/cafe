<?php
    $path = realpath(__DIR__ . '/..');
    include_once($path . '/init/db.php');
    $path_ = $path . '/init/db.php';
    // Koneksi Khusus PDO
    //include_once($path . '/init/db.pdo.php');
    session_start();
    ob_start();
  // include "/init/db.php";

  $page_header = "index";
  $page_li = "";

  require 'functions.php';
  include "header.php";
  include "sidebar.php";
  // include_once dirname(dirname(__FILE__)) . '/cloud/files/formSubmit.php';
  $date = date("Y-m-d");
  $month = date("m");
  $year = date("Y");
  // $path = 'init/db.php';
  // $month = date;
  ?>
<!-- <!DOCTYPE html> -->
<base href="">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Admin
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-home active"></i> Dashboard</a></li>
      <!-- <li class="active">Here</li> -->
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <!-- Widget Small box -->
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql2 = "SELECT COUNT(id_produk) AS jumlah FROM tbl_produk";
                // nilai 0 = delete no
                $run_sql2 = mysqli_query($conn,$sql2);
                $rows2 = mysqli_fetch_assoc($run_sql2);
                ?>
              <h3><?php echo $rows2['jumlah'] ?></h3>
              <p>Jumlah Menu</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="/cafe/admin/menu/list_menu.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner">

              <h3><?php echo rupiah(total_harian($date,3,$path_)) ?></h3>
              <p>Pendapatan Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="/cafe/admin/laporan/laporan_penjualan.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              // $sql2 = "SELECT SUM(grandtotal) AS Total  FROM tbl_transaksi WHERE YEAR(tanggal) = YEAR(CURDATE())";
              // // nilai 0 = delete no
              // $run_sql2 = mysqli_query($conn,$sql2);
              // $rows2 = mysqli_fetch_assoc($run_sql2);
              ?>
              <h3><?php echo rupiah(total_tahunan($year,3,$path_)) ?></h3>
              <p>Pendapatan Tahun Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="/cafe/admin/laporan/laporan_penjualan.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>

      <!--Chart -->
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <?php 
          $sql_1 = "SELECT MONTH(tgl_order) AS Bulan_ FROM tbl_orders WHERE YEAR(tgl_order) = $year GROUP BY MONTH(tgl_order) ASC";
            $run_sql_1 = mysqli_query($conn,$sql_1);
            
            $sql_2 = "SELECT SUM(grandtotal) AS Total_1 FROM tbl_orders WHERE YEAR(tgl_order) = $year GROUP BY MONTH(tgl_order) ASC";
            $run_sql_2 = mysqli_query($conn,$sql_2);
            $numResults = mysqli_num_rows($run_sql_2);
          $counter = 0;

          $sql_3 = "SELECT SUM(jumlah_pengeluaran) AS Total FROM tbl_pengeluaran WHERE YEAR(tgl_pengeluaran) = $year GROUP BY MONTH(tgl_pengeluaran) ASC";
            $run_sql_3 = mysqli_query($conn,$sql_3);
            $numResults_1 = mysqli_num_rows($run_sql_3);
          $counter_1 = 0;

            // $sql_2 = "SELECT SUM(grandtotal) AS Total_1 FROM tbl_transaksi WHERE YEAR(tanggal) = '2019'  GROUP BY MONTH(tanggal) ASC";
            // $run_sql_2 = mysqli_query($conn,$sql_2);
          ?>

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pendapatan Bulanan</h3>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

        <!-- Dougnut Chart -->
        <div class="col-lg-6 col-xs-12">
          <?php 
          
          $sql_barang = "SELECT COUNT(tbl_detail_order.id_produk) AS Barang, tbl_produk.nama_produk AS Nama FROM tbl_detail_order JOIN tbl_produk USING(id_produk)  GROUP BY id_produk LIMIT 6";
            $run_sql_barang = mysqli_query($conn,$sql_barang); 

            $numResults_barang = mysqli_num_rows($run_sql_barang);
          $counter_barang = 0;		
          ?>

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Menu Paling Banyak Terjual</h3>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /Dougnut Chart -->
      </div>
      <!-- /Chart -->


      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="box-title">Transaksi Hari ini</div>
              <div class="box-title pull-right">Tgl : <?php echo date("d/m/Y") ?></div>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total Belanja</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM tbl_orders WHERE DATE(tgl_order) = CURDATE() ORDER BY tgl_order DESC LIMIT 5";
                  $run_sql = mysqli_query($conn,$sql);
                  $row_cnt = mysqli_num_rows($run_sql);
                  if ($row_cnt <= 0) {
                  echo "<tr><td colspan='6' align ='center'>Tidak Ada Transaksi Hari Ini</td></tr>";
                  }else{
                  while($rows = mysqli_fetch_assoc($run_sql)){
                  echo "
                  <tr>
                    <td>$rows[id_order]</td>
                    <td>$rows[tgl_order]</td>
                    <td>".rupiah($rows['grandtotal'])."</td>
                    
                  </tr>";
                  }
                  }
                  ?>
                  <tr></tr>
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              <a href="/cafe/admin/laporan/laporan_penjualan.php">More Info</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="box-title">Barang Hampir Kosong</div>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Barang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                $sql = "SELECT * FROM tbl_brg WHERE stok <= 10 ORDER BY stok ASC LIMIT 5";
                $run_sql = mysqli_query($conn,$sql);
                $row_cnt = mysqli_num_rows($run_sql);
                if ($row_cnt <= 0) {
                echo "<tr><td colspan='6' align ='center'>Barang Kosong Tidak Ditemukan</td></tr>";
                }else{
                while($rows = mysqli_fetch_assoc($run_sql)){
                echo "
                <tr>
                  <td>$rows[id_barang]</td>
                  <td>$rows[nama_barang]</td>
                  
                  <td>$rows[satuan]</td>
                  <td>$rows[harga_beli]</td>
                  <td>$rows[harga_jual]</td>";
                  if ($rows['stok'] <= 5) {
                  echo "<td><span class='label label-danger'>$rows[stok]</span></td>";
                  }
                echo "</tr>";
                }
                }
                ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              <a href="/tb/laporan/laporan_barang_kosong.php">More Info</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $(function () {

    var areaChartData = {
      labels: [ <?php
        while ($rows_1 = mysqli_fetch_assoc($run_sql_1)) {
          echo '"'.bulan($rows_1['Bulan_']).
          '",';
        } ?>
      ],
      datasets: [{
        label: 'Pendapatan',
        fillColor: 'rgba(210, 214, 222, 1)',
        strokeColor: 'rgba(210, 214, 222, 1)',
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [ <?php 
        $sql_1 ="SELECT MONTH(tgl_order) AS Bulan_ FROM tbl_orders WHERE YEAR(tgl_order) = $year GROUP BY MONTH(tgl_order) ASC";
          $run_sql_1 = mysqli_query($conn, $sql_1);
          while ($rows_1 = mysqli_fetch_assoc($run_sql_1)) {
            if (++$counter == $numResults) {
              echo total_bulanan($year, $rows_1['Bulan_'], 3, $path_);
            } else {
              echo total_bulanan($year, $rows_1['Bulan_'], 3, $path_).
              ',';
            }
          } ?>
        ]
      }]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[0].fillColor = '#00a65a'
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    }

    barChartOptions.datasetFill = true
    barChart.Bar(barChartData, barChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvas)
    var PieData = [ <?php
      $background_colors = array('#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#f56954');
      $rand_background = $background_colors[array_rand($background_colors)];
      while ($rows_1 = mysqli_fetch_assoc($run_sql_barang)) {
        if (++$counter == $numResults) {
          echo " {
            value: ".(int)$rows_1['Barang'].",
            color: '".$background_colors[array_rand($background_colors)]."',

            label: '".$rows_1['Nama']."'
          }
          ";
        } else {
          echo " {
            value: ".(int)$rows_1['Barang'].",
            color: '".$background_colors[array_rand($background_colors)]."',

            label: '".$rows_1['Nama']."'
          }, ";
        }

      }?>

      // {
      //   value    : 700,
      //   color    : '#f56954',
      //   highlight: '#f56954',
      //   label    : 'Chrome'
      // },
      // {
      //   value    : 500,
      //   color    : '#00a65a',
      //   highlight: '#00a65a',
      //   label    : 'IE'
      // },
      // {
      //   value    : 400,
      //   color    : '#f39c12',
      //   highlight: '#f39c12',
      //   label    : 'FireFox'
      // },
      // {
      //   value    : 600,
      //   color    : '#00c0ef',
      //   highlight: '#00c0ef',
      //   label    : 'Safari'
      // },
      // {
      //   value    : 300,
      //   color    : '#3c8dbc',
      //   highlight: '#3c8dbc',
      //   label    : 'Opera'
      // },
      // {
      //   value    : 100,
      //   color    : '#d2d6de',
      //   highlight: '#d2d6de',
      //   label    : 'Navigator'
      // }
    ]
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

  })
</script>
<?php
        include 'footer.php';
        ?>
<!-- ./wrapper -->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->