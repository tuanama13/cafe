<?php  
	require "../../init/db.php";

	// $id_transaksi = $_GET['id_transaksi'];
	// print_r($id_transaksi);
	$id_transaksi = isset( $_GET['id_transaksi']) ?  $_GET['id_transaksi'] : null;
	$grand_total = isset( $_GET['grand_total']) ?  $_GET['grand_total'] : null;
	$sql = mysqli_query($conn,"SELECT * FROM detail_transaksi WHERE id_transaksi = '$id_transaksi'");

 		print"
		
 		<table id='lookup-toko' class='table table-bordered table-hover table-striped display nowrap'>
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>";
                                while ($row = mysqli_fetch_assoc($sql)) {
                                	// $id=$row['id_toko'];
                                
                                    print"<tr>
                                        <td>".$row['id_brg']."</td>
                                        <td>".$row['harga']."</td>
                                        <td>".$row['jumlah_brg']."</td>
                                        <td>".$row['sub_total']."</td>
                                    </tr>";
                                }
                                
                   print "  	<tr>
                   					<td colspan='2' data-visible='false'></td>
                   					<td><b>Grand Total</b></td>
                   					<td><b>".$grand_total."</b></td>
                   				</tr>      
                   			</tbody>
                        </table>";  