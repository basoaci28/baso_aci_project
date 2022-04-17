<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];
// echo $id;

$nama = $_POST["nama"];
$foto = $_POST["foto"];

$sql = "UPDATE `banner` SET `nama` = '" . $nama . "',`foto` = '" . $foto . "' WHERE `banner`.`id` = " . $id . ";";

// Jalankan query
$query = mysqli_query($con, $sql);
if ($query) {
    $msg = "Data berhasil di Update";
} else {
    $msg = "Data gagal di Update";
}

$response = array(
    'status' => 'OK',
    'msg' => $msg,
);

echo json_encode($response);
