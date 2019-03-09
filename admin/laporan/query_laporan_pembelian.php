<?php 
	include '../init/db.php';
  //include "../admin_login.php";
	$sql=""; 
	$tahun = isset( $_GET['tahun']) ?  $_GET['tahun'] : null;
  $bulan = isset( $_GET['bulan']) ?  $_GET['bulan'] : null;
	
	// print_r($_GET);

		$sql = mysqli_query($conn, "SELECT * FROM pembelian_brg INNER JOIN supplier USING(id_supplier) WHERE YEAR(tgl_pembelian) ='$tahun' AND MONTH(tgl_pembelian) ='$bulan' AND grand_total <> 0 ");
	
	
				
				print"
					<thead>
                        <tr>
                          <th>No. Invoice</th>
                          <th>Nama Toko</th>
                          
                          <th>Grand Total</th>
                          <th>Lunas</th>
                        </tr>
                      </thead>
                            <tbody>";
                                while ($row = mysqli_fetch_assoc($sql)) {
        
                                    print"<tr>
                                        <td>".$row['id_transaksi']."</td>
                                        <td>".$row['nama_supplier']."</td>
                                        
                                        <td>".$row['grand_total']."</td>
                                        <td>".$row['lunas']."</td>
                                    </tr>";
                                }
                                
                   print "  
                   			</tbody>";  
?>