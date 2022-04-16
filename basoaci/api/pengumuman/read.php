<?php
require_once dirname(__FILE__) . "/../../include/dbConnect.php";

$sql = "SELECT * FROM pengumuman ORDER BY id ASC";
$query = mysqli_query($con, $sql);
while ($data = mysqli_fetch_array($query)) {
    $item[] = array(
        'id' => $data['id'],
        'gambar' => $data['gambar'],
        'deskripsi' => $data['deskripsi'],
    );
}

$response = array(
    'status' => 'OK',
    'data' => $item,
);

echo json_encode($response);
