<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Mendapatkan variable post
$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$foto = isset($_POST["foto"]) ? $_POST["foto"] : "";

// query menambahkan data
$sql = "INSERT INTO `banner` (`nama`,`foto`) VALUES ('" . $nama . "','" . $foto . "')";

$query = mysqli_query($con, $sql);
if ($query) {
    $msg = "Data berhasil ditambahkan";
} else {
    $msg = "Data gagal ditambahkan";
}

$response = array(
    'status' => 'OK',
    'msg' => $msg,
);

echo json_encode($response);
