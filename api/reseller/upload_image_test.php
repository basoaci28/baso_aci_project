<?php

$inputImage = $_FILES['image']['name'];

$data = "";

if (!$inputImage) {
    $data = array("message" => "Foto tidak boleh kosong.");
}
if ($inputImage->size > 1000 * 2000) {
    $data = array("message" => "Ukuran maksimal file adalah 1MB.");
}
$folderUpload = "https://" . $_SERVER['HTTP_HOST'] . "/basoaci-main/image/reseller";
$newPath = $folderUpload . "/" . basename($inputImage);
if (!is_dir($folderUpload)) {
    # jika tidak maka folder harus dibuat terlebih dahulu
    mkdir($folderUpload, 0777, $rekursif = true);
}

$uploadFotoSukses = move_uploaded_file(
    $_FILES["image"]["tmp_name"], $newPath
);

if ($uploadFotoSukses) {
    $link = $newPath;
    $data = array("message" => "Foto berhasil ditambahkan di {$link}");
} else {
    $data = array("message" => "Foto gagal ditambahkan " . $_SERVER['HTTP_HOST']);
}

// $currentDirectory = "https://" . $_SERVER['HTTP_HOST'];
// $uploadDirectory = "/image/reseller/";

// $errors = []; // Store errors here
// $data = "";

// $inputImage = (object) @$_FILES['image'];

// $uploadPath = $currentDirectory . $uploadDirectory . basename($inputImage->name);

// if (empty($errors)) {
//     $didUpload = move_uploaded_file($inputImage->tmp_name, $uploadPath);

//     if ($didUpload) {
//         $data = array("message" => "The file " . basename($inputImage->name) . " has been uploaded", "Link" => $uploadPath);
//     } else {
//         $data = array("message" => "Error di " . $errors);
//     }
// } else {
//     foreach ($errors as $error) {
//         $data = array("message" => $error . "These are the errors" . "\n");
//     }
// }
print_r(json_encode($data));
