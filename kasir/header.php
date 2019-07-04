<?php
  session_start();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inland Cafe | Kasir</title>
    <link rel="icon" 
      type="" 
      href="/cafe/Logo2.ico">
    <!-- <base href="admin/"> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--     <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> -->
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <!-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"> -->
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/cafe/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href='/cafe/kasir/style.css?version=<?php echo rand()?>'>

    <link rel="stylesheet" href="/cafe/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/cafe/plugins/font-awesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/cafe/plugins/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/cafe/plugins/DataTables1/datatables.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"> -->
    <!-- <add key="webpages:Enabled" value="true" /> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="/cafe/dist/css/AdminLTE.min.css"> -->
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect.
    -->
    <!-- <link rel="stylesheet" href="/cafe/dist/css/skins/skin-red.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/cafe/plugins/DataTables/css/dataTables.bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="/cafe/plugins/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css"> -->
    <style>
    .cetakBody {
      width: 100%;
      margin: 10px;
    }

    .cetakBody>.cetak {
      margin-left: 15px;
      width: 550px;
    }

    .bootstrap-datetimepicker-widget {
      color: #e74c3c;
    }

    .navbar-brand { 
      color:white;
    }

    @media (max-width: @screen-xs-min) {
      .modal-xs {
        width: @modal-sm;
      }
    }
    </style>


    <script language="JavaScript" src="/cafe/plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
    <!-- <script type="text/javascript" src="/cafe/bower_components/jquery/jquery.min.js"></script> -->
    <script type="text/javascript" src="/cafe/bower_components/moment/min/moment.min.js"></script>
    <script src="/cafe/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/cafe/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script language="JavaScript" src="/cafe/plugins/DataTables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/cafe/plugins/DataTables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

  
    <script language="JavaScript" src="/cafe/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/cafe/plugins/Responsive-2.2.2/js/responsive.bootstrap.min.js" type="text/javascript"></script>
    <script src="/cafe/plugins/chart.js/Chart.js"></script>
    <script src="/cafe/plugins/shortcut.js"></script>
    
    <!-- AdminLTE App -->
    <script src="/cafe/dist/js/app.min.js"></script>

    <!-- My Custome Script -->
    <script src="/cafe/dist/js/myScript.js"></script>

  <!-- </head> -->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="bg-green-soft">
    <div class="">