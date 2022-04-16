<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];
// echo $id;

if ($id == null) {
    $errorMsg = json_encode(array("message" => "Data tidak ditemukan", "status" => false));
    echo $errorMsg;
}

$gambar = $_FILES['gambar']['name'];
$tempPath = $_FILES['gambar']['tmp_name'];
$fileSize = $_FILES['gambar']['size'];
$deskripsi = $_POST["deskripsi"];

if (empty($gambar)) {
    if (!isset($errorMsg)) {
        // query menambahkan data
        $sql = mysqli_query($con, "UPDATE `pengumuman` SET `deskripsi` = '" . $deskripsi . "' WHERE `pengumuman`.`id` = " . $id . "");

        echo json_encode(array("message" => "Data berhasil diubah", "status" => true));
    }

} else {
    $upload_path = '../../image/pengumuman/';
    $fileExt = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $valid_ext = array('jpeg', 'jpg', 'png');
    $rand_num = rand(1, 999);
    $new_gambar = $rand_num . '-' . $gambar;

    if (in_array($fileExt, $valid_ext)) {
        if (!file_exists($upload_path . $new_gambar)) {
            if ($fileSize < 5000000) {
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
        $sql = mysqli_query($con, "UPDATE `pengumuman` SET `gambar` = '" . $new_gambar . "', `deskripsi` = '" . $deskripsi . "' WHERE `pengumuman`.`id` = " . $id . ";");

        echo json_encode(array("message" => "Data berhasil diubah", "status" => true));
    }
}
