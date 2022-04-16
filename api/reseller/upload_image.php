<?php

$image = $_FILES['image']['tmp_name'];
$imagename = $_FILES['image']['name'];

$data = "";
//tempat foto reseller disimpan
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/basoaci/image/reseller';

// if (!file_exists($target_dir)) {
//     mkdir($target_dir, 0777, true);
// }

if (!$image) {
    $data = array("message" => "Data tidak ditemukan");
} else {
    if (move_uploaded_file($image, $target_dir . '/' . $imagename)) {
        $data = array("message" => "Sukses Diupload", "link" => $target_dir);
    }
}

print_r(json_encode($data));

// if (!isset($_FILES['image']['name'])) {
//     $message .= "image ";
//     $is_error = true;
// }

// // creating a target file with a unique name, so that for every upload we create a unique file in our server
// $target_file = $target_dir . uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

// $image_name = isset($_POST["img_name"]) ? $_POST["img_name"] : "";
// $image_path = isset($_POST["img_path"]) ? $_POST["img_path"] : "";
// $path = $_SERVER['DOCUMENT_ROOT'] . '/basoaci/api/reseller';
// // $sql = "INSERT into imagetable(img_name, img_path) VALUES ('$image_name','$path')";

// if ($path) {
//     file_put_contents($path, base64_decode($target_file));
//     echo json_encode(array('response' => "Successfully Uploaded"));
// } else {
//     echo json_encode(array('response' => "Image failed to upload"));
// }

// print_r(json_encode($path));
