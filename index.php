<?php
require_once dirname(__FILE__) . "/dbConnect.php";
$result = mysqli_query($con, "SELECT * FROM product ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
echo "file ini ada di" . __FILE__;

?>
<table width='80%' border=1>

 <tr>
     <th>Nama</th> <th>Detail</th> <th>Stok</th> <th>Harga</th> <th>Gambar</th> <th>Update</th>
 </tr>
 <?php

while ($products_data = mysqli_fetch_assoc($result)) {
    $nama = $products_data['nama'];
    $detail = $products_data['detail'];
    $stok = $products_data['stok'];
    $harga = $products_data['harga'];
    $gambar = $products_data['gambar'];
    echo '<tr>
    <td> ' . $nama . ' </td>
    <td> ' . $detail . ' </td>
    <td> ' . $stok . ' </td>
    <td> ' . $harga . ' </td>
    <td>
    <img src="./image/product/' . $gambar . '" width=130px;>
    </td>
    <td><a href="./api/product/update.php">Edit</a>' . '<a href="./api/product/delete.php">Hapus</a></td>
    </tr>';
}
?>
 </table>
</body>
</html>