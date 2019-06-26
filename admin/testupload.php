<?php
    $path = realpath(__DIR__ . '/..');
    include_once($path . '/init/db.pdo.php');
    include_once 'models/Menus.php';

    $database = new Database();
    $db = $database->connect();

    $menu = new Menu($db);
    // $result = $menu->createProduks();

    if (isset($_POST['saveimage'])) {
        $menu->id_kat = 2;
        $menu->nama_produk = "Latte Drinks";
        $menu->desc_produk = "Udah puas sama makanannya, sekarang yuk coba minuman ice latte-nya. Sobat jajan bisa coba green tea, taro dan banana latte dengan harga yang pas banget di kantong.";
        // $menu->image_produk = $_FILES['myimage'];
        $menu->harga_produk = "15000";
        $target =  $_FILES['myimage']['name'];
        $menu->status_produk = 1;
        $menu->logs = 1;

        
        if ($menu->createProduks($target)){
            echo "success";
        }else{
            echo "cancel";
        }
    }

    
    
?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		<input type="file" name="myimage" placeholder="Browse Your Image"><br>
		<input type="submit" name="saveimage" value="Save Image">
	</form>
