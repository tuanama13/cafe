<?php
  $path_image = dirname('/');
  $path = realpath(__DIR__ . '/..');  
  include_once($path . '/init/db.pdo.php');

  $query = $db->prepare("SELECT * FROM tbl_produk");
  $query->execute();
  $data = $query->fetchAll(); 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Botanical Cafe | Kasir</title>
  </head>
  <body bgcolor="#CCCCCC">
    <h2><strong><p align="center">Data Produk Botanical Cafe</p></strong></h2>
    <table width="807" border="1" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="100" height="30" align="center" valign="middle" bgcolor="#00FFFF">Kode Produk</td>
        <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Kategori</td>
        <td width="170" align="center" valign="middle" bgcolor="#00FFFF">Nama Produk</td>
        <td width="200" align="center" valign="middle" bgcolor="#00FFFF">Deskripsi</td>
        <td width="130" align="center" valign="middle" bgcolor="#00FFFF">Image</td>
        <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Harga</td>
        <!-- <td width="135" align="center" valign="middle" bgcolor="#00FFFF"><a href="create.php">TAMBAH</a></td> -->
      </tr>
        <?php 
          foreach ($data as $value): 
            // $desc_produk = strpos($value['desc_produk'],' ',150);
            // $image =  str_replace("", "",$value['image_produk']
        ?>

      <tr>
          <td p align="center" bgcolor="#FFFFFF"><?php echo $value['id_produk'] ?></td>
          <td p align="center" bgcolor="#FFFFFF"><?php echo $value['id_kat'] ?></td>
          <td p align="left" bgcolor="#FFFFFF"><?php echo $value['nama_produk']?></td>
          <td p align="left" bgcolor="#FFFFFF"><?php echo substr($value['desc_produk'],0,100) ?></td>
          <td p align="center" bgcolor="#FFFFFF"><img src='<?php echo '..'.$value['image_produk']?>' alt=""></td>
          <td p align="right" bgcolor="#FFFFFF"><?php echo $value['harga_produk'] ?></td>
          <!-- <td p align="center" bgcolor="#FFFFFF">
            <a href="edit.php?nis=<?php //echo $value['nis']?>">Edit</a>
            <a href="delete.php?nis=<?php //echo $value['nis']?>">Delete</a>
          </td> -->
      </tr>
      <?php endforeach; ?>
    </table>
    <!-- <p align="center"><a href=http://www.javanetmedia.com>www.javanetmedia.com</a></p> -->
  </body>
</html>