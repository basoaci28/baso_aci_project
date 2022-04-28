<?php

$image = (object) @$_FILES['image'];

$data = "";
$errorMsg = [];

// if (!@$image->name) {
//     array_push($errorMsg, "Foto tidak boleh kosong.");
// }

// $folderUpload = $_SERVER['HTTP_HOST'] . "/image/reseller";

// if (!is_dir($folderUpload)) {
//     # jika tidak maka folder harus dibuat terlebih dahulu
//     mkdir($folderUpload, 0777, $rekursif = true);
// }

// $uploadFotoSukses = move_uploaded_file(
//     $image->tmp_name, "{$folderUpload}/{$image->name}"
// );

// if ($uploadFotoSukses) {
//     $link = "{$folderUpload}/{$image->name}";
//     $data = array("message" => "Foto berhasil ditambahkan di {$link}");
// } else {
//     $data = array("message" => "Foto gagal ditambahkan");
// }

$currentDirectory = "https://" . $_SERVER['HTTP_HOST'];
$uploadDirectory = "/image/reseller/";

$errors = []; // Store errors here
$data = "";

$inputImage = (object) @$_FILES['image'];

$uploadPath = $currentDirectory . $uploadDirectory . basename($inputImage->name);

if (isset($_POST['submit'])) {

    if (empty($errors)) {
        $didUpload = move_uploaded_file($inputImage->tmp_name, $uploadPath);

        if ($didUpload) {
            $data = array("message" => "The file " . basename($inputImage->name) . " has been uploaded");
        } else {
            $data = array("message" => "An error occurred. Please contact the administrator.");
        }
    } else {
        foreach ($errors as $error) {
            $data = array("message" => $error . "These are the errors" . "\n");
        }
    }

}
print_r(json_encode($data));
