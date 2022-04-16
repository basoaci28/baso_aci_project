<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Mendapatkan variable post
$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$no_hp = isset($_POST["no_hp"]) ? $_POST["no_hp"] : "";

// query menambahkan data
// $sql = "INSERT INTO `user` (`nama`,`email`,`password`,`alamat`,`no_hp`) VALUES ('" . $nama . "','" . $email . "','" . $password . "','" . $alamat . "','" . $no_hp . "')";

// $query = mysqli_query($con, $sql);
// if ($query) {
//     $msg = "Data berhasil ditambahkan";
// } else {
//     $msg = "Data gagal ditambahkan";
// }

// $response = array(
//     'status' => 'OK',
//     'msg' => $msg,
// );

// simpan data ke database
$stmt = $con->prepare("INSERT INTO user (`nama`, `email`,`password`,`alamat`,`no_hp`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $_POST['nama'], $_POST['email'], $_POST['password'], $_POST['alamat'], $_POST['no_hp']);

//if data berhasil disimpan kedatabase
if ($stmt->execute()) {
    //displaying success response
    $response['error'] = false;
    $response['message'] = 'Data berhasil ditambahkan';
} else {
    //if data gagal disimpan ke database
    //showing response accordingly
    $response['error'] = true;
    $response['message'] = 'Data tidak dapat ditambahkan';
}

echo json_encode($response);
