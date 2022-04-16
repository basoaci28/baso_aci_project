<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Mendapatkan variable post

$gambar = $_FILES['gambar']['name'];
$tempPath = $_FILES['gambar']['tmp_name'];
$fileSize = $_FILES['gambar']['size'];

$deskripsi = isset($_POST["deskripsi"]) ? $_POST["deskripsi"] : "";

if (empty($gambar)) {
    $errorMsg = json_encode(array("message" => "Mohon pilih image", "status" => false));
    echo $errorMsg;
} else {
    $upload_path = '../../image/pengumuman/';

    $fileExt = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

    $valid_ext = array('jpeg', 'jpg', 'png');

    if (in_array($fileExt, $valid_ext)) {
        if (!file_exists($upload_path . $gambar)) {
            if ($fileSize < 5000000) {
                move_uploaded_file($tempPath, $upload_path . $gambar);
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
}

if (!isset($errorMsg)) {
    // query menambahkan data
    $sql = mysqli_query($con, "INSERT INTO `pengumuman` (`gambar`,`deskripsi`) VALUES ('" . $gambar . "', '" . $deskripsi . "')");

    echo json_encode(array("message" => "Data berhasil ditambahkan", "status" => true));
}
