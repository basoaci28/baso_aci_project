<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];
// echo $id;

$nama = $_POST["nama"];
$detail = $_POST["detail"];
$stok = $_POST["stok"];
$harga = $_POST["harga"];

$gambar = $_FILES['gambar']['name'];
$tempPath = $_FILES['gambar']['tmp_name'];
$fileSize = $_FILES['gambar']['size'];

if ($id == null) {
    $errorMsg = json_encode(array("message" => "Data tidak ditemukan", "status" => false));
    echo $errorMsg;
}

if (empty($gambar)) {
    if (!isset($errorMsg)) {
        // query menambahkan data
        $sql = mysqli_query($con, "UPDATE `product` SET `nama` = '" . $nama . "',`detail` = '" . $detail . "',`stok` = '" . $stok . "',`harga` = '" . $harga . "' WHERE `product`.`id` = " . $id . ";");

        echo json_encode(array("message" => "Data berhasil diubah", "status" => true));
    }
} else {
    $upload_path = __DIR__ . '/image/product/';

    $fileExt = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

    $valid_ext = array('jpeg', 'jpg', 'png');
    $rand_num = rand(1, 999);
    $new_gambar = $rand_num . '-' . $gambar;

    if (in_array($fileExt, $valid_ext)) {
        if (!file_exists($upload_path . $new_gambar)) {
            if ($fileSize < 10000000) {
                move_uploaded_file($tempPath, $upload_path . $new_gambar);
            } else {
                $errorMsg = json_encode(array("message" => "Maaf gambar terlalu besar", "status" => false));
                echo $errorMsg;
            }
        } else {
            $errorMsg = json_encode(array("message" => "Maaf file sudah ada, silahkan cek upload folder", "status" => false));
            echo $errorMsg;
        }
    } else {
        $errorMsg = json_encode(array("message" => "Maaf, hanya gambar dengan tipe JPG, JPEG, PNG yang diizinkan", "status" => false));
        echo $errorMsg;
    }

    if (!isset($errorMsg)) {
        // query menambahkan data
        $sql = mysqli_query($con, "UPDATE `product` SET `nama` = '" . $nama . "',`detail` = '" . $detail . "',`stok` = '" . $stok . "',`harga` = '" . $harga . "',`gambar` = '" . $new_gambar . "' WHERE `product`.`id` = " . $id . ";");

        echo json_encode(array("message" => "Data berhasil diubah", "status" => true));
    }
}
