<?php  
	session_start();
	ob_start();
	include "init/db.php";
	require 'functions.php';
	// include 'admin_login.php';

	// include "admin_login.php";
	//cek apakah user sudah login
	//if(!isset($_SESSION['username'])){
	// die("Anda belum login");
	//header("Location:login.php");
	//}
	//cek level user
	//if($_SESSION['level']!="1"){
	//die("Anda bukan Admin");
	//header("Location:login.php");
	//}

	include "header.php"; 
    $sql_1 = "SELECT MONTH(tanggal) AS Bulan_ FROM tbl_transaksi WHERE YEAR(tanggal) = '2019' GROUP BY MONTH(tanggal) ASC";
    $run_sql_1 = mysqli_query($conn,$sql_1);
    
    $sql_2 = "SELECT SUM(grandtotal) AS Total_1 FROM tbl_transaksi GROUP BY MONTH(tanggal) ASC";
    $run_sql_2 = mysqli_query($conn,$sql_2);
    $numResults = mysqli_num_rows($run_sql_2);
	$counter = 0;

	$sql_3 = "SELECT SUM(jumlah_pengeluaran) AS Total FROM tbl_pengeluaran GROUP BY MONTH(tgl_pengeluaran) ASC";
    $run_sql_3 = mysqli_query($conn,$sql_3);
    $numResults_1 = mysqli_num_rows($run_sql_3);
	$counter_1 = 0;


          // $sql_2 = "SELECT SUM(grandtotal) AS Total_1 FROM tbl_transaksi WHERE YEAR(tanggal) = '2019'  GROUP BY MONTH(tanggal) ASC";
          // $run_sql_2 = mysqli_query($conn,$sql_2);
        
?>

<!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          <script src="/tb/plugins/chart.js/Chart.js"></script>
<script>
        $(function () {
           // Get context with jQuery - using jQuery's .get() method.
          var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
          // This will get the first returned node in the jQuery collection.
          var areaChart       = new Chart(areaChartCanvas)

          var areaChartData = {
            labels  : [<?php while($rows_1 = mysqli_fetch_assoc($run_sql_1)){ echo '"'.bulan($rows_1['Bulan_']).'",';} ?>],
            datasets: [
              {
                label               : 'Pendapatan',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [<?php while($rows_2 = mysqli_fetch_assoc($run_sql_2)){if (++$counter == $numResults) {echo (int)$rows_2['Total_1'];} else {echo (int)$rows_2['Total_1'].',';}}?>]
              },
              {
                label               : 'Pengeluaran',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [<?php while($rows_3 = mysqli_fetch_assoc($run_sql_3)){if (++$counter_1 == $numResults_1) {echo (int)$rows_3['Total'];} else {echo (int)$rows_3['Total'].',';}}?>]
              }
            ]
          }
          console.log(<?php while($rows_3 = mysqli_fetch_assoc($run_sql_3)){if (++$counter_1 == $numResults_1) {echo (int)$rows_3['Total'];} else {echo (int)$rows_3['Total'].',';}}?>)

          var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale               : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : false,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - Whether the line is curved between points
            bezierCurve             : true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension      : 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot                : false,
            //Number - Radius of each point dot in pixels
            pointDotRadius          : 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth     : 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius : 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke           : true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth      : 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill             : true,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio     : true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive              : true
          }

          //Create the line chart
          areaChart.Line(areaChartData, areaChartOptions)

          //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
        })
      </script>