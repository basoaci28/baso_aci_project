<?php
require_once dirname(__FILE__) . "/../../include/dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];
// echo $id;

$nama = $_POST["nama"];
$email = $_POST["email"];
$password = $_POST["password"];
$alamat = $_POST["alamat"];
$no_hp = $_POST["no_hp"];

$sql = "UPDATE `user` SET `nama` = '" . $nama . "',`email` = '" . $email . "',`password` = '" . $password . "',`alamat` = '" . $alamat . "',`no_hp` = '" . $no_hp . "' WHERE `user`.`id` = " . $id . ";";

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
