<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Produks.php';
    include_once '../functions.php';

    $database = new Database();
    $db = $database->connect();
    // private $conn;

    $snack = new Produk($db);

    $result = $snack->readSnacks();

    foreach ($result as $value): 
                            echo"
								<!-- col 3 -->
								<div class='col-md-3' id='produk-select' class='produk-select' onclick='myPesan(\"$value[id_produk]\",\"$value[nama_produk]\",\"$value[harga_produk]\")'>
									<div class='panel panel-default'>
									<div class='panel-body'>
										<img src='../".$value['image_produk']."' class='img-responsive img-rounded' alt='".$value['nama_produk']."' style='width: 100%'>
										<div class='title-menu'>
												<h4>".$value['nama_produk']."</h4>
												<p class='p-harga'>".rupiah($value['harga_produk'])."</p>
										</div>							   
									</div>
									</div>					
								</div>
								<!-- / col 3 -->";

    endforeach;