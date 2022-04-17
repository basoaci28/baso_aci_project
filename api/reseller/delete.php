<?php
require_once dirname(__FILE__) . "/../../dbConnect.php";

// Menangkap variable parameter get
$id = $_GET['id'];

// query
$sql = "DELETE FROM reseller WHERE id='$id'";

// jalankan query
$query = mysqli_query($con, $sql);

if ($query) {
    $msg = "Data berhasil di Hapus";
} else {
    $msg = "Data gagal di Hapus";
}

$response = array(
    'status' => 'OK',
    'msg' => $msg,
);

echo json_encode($response);
