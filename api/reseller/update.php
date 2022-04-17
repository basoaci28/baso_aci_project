<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];
// echo $id;

$nama = $_POST["nama"];
$email = $_POST["email"];
$password = $_POST["password"];
$alamat = $_POST["alamat"];
$foto = $_POST["foto"];
$no_hp = $_POST["no_hp"];
$is_verified = $_POST["is_verified"];

$sql = "UPDATE `reseller` SET `nama` = '" . $nama . "',`email` = '" . $email . "',`password` = '" . $password . "',`alamat` = '" . $alamat . "',`foto` = '" . $foto . "',`no_hp` = '" . $no_hp . "',`is_verified` = '" . $is_verified . "' WHERE `reseller`.`id` = " . $id . ";";

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
