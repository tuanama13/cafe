<?php 
	include '../init/db.php';
//  include "../admin_login.php";
	$sql=""; 
	$tahun = isset( $_GET['tahun']) ?  $_GET['tahun'] : null;
  $bulan = isset( $_GET['bulan']) ?  $_GET['bulan'] : null;
	
	// print_r($_GET);

		$sql = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN toko USING(id_toko) WHERE YEAR(tgl_transaksi) ='$tahun' AND MONTH(tgl_transaksi) ='$bulan' AND grand_total <> 0 ");
	
	
				
				print"
					<thead>
                        <tr>
                          <th>No. Invoice</th>
                          <th>Nama Toko</th>
                          
                          <th>Grand Total</th>
                          <th>Sisa Hutang</th>
                        </tr>
                      </thead>
                            <tbody>";
                                while ($row = mysqli_fetch_assoc($sql)) {
        
                                    print"<tr>
                                        <td>".$row['id_transaksi']."</td>
                                        <td>".$row['nama_toko']."</td>
                                      
                                        <td>".$row['grand_total']."</td>
                                        <td>".$row['sisa_hutang']."</td>
                                    </tr>";
                                }
                                
                   print "  
                   			</tbody>";  
?>