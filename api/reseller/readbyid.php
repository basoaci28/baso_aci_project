<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
$sql = "SELECT * FROM reseller WHERE id = '$id'";
$query = mysqli_query($con, $sql);
while ($data = mysqli_fetch_array($query)) {
    $item[] = array(
        'id' => $data['id'],
        'nama' => $data['nama'],
        'email' => $data['email'],
        'password' => $data['password'],
        'alamat' => $data['alamat'],
        'foto' => $data['foto'],
        'no_hp' => $data['no_hp'],
        'is_verified' => $data['is_verified'],
    );
}

$response = array(
    'status' => 'OK',
    'data' => $item,
);

echo json_encode($response);
