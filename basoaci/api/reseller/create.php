<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../include/dbConnect.php";

// Mendapatkan variable post
$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$foto = isset($_POST["foto"]) ? $_POST["foto"] : "";
$no_hp = isset($_POST["no_hp"]) ? $_POST["no_hp"] : "";
$is_verified = isset($_POST["is_verified"]) ? $_POST["is_verified"] : "";

// query menambahkan data
$sql = "INSERT INTO `reseller` (`nama`,`email`,`password`,`alamat`,`foto`,`no_hp`,`is_verified`) VALUES ('" . $nama . "','" . $email . "','" . $password . "','" . $alamat . "','" . $foto . "','" . $no_hp . "', '" . $is_verified . "')";

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
