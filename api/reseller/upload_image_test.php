<?php

$image = (object) @$_FILES['image'];

$data = "";
$errorMsg = [];

if (!@$image->name) {
    array_push($errorMsg, "Foto tidak boleh kosong.");
}

$folderUpload = $_SERVER['HTTP_HOST'] . "/image/reseller";

if (!is_dir($folderUpload)) {
    # jika tidak maka folder harus dibuat terlebih dahulu
    mkdir($folderUpload, 0777, $rekursif = true);
}

$uploadFotoSukses = move_uploaded_file(
    $image->tmp_name, "{$folderUpload}/{$image->name}"
);

if ($uploadFotoSukses) {
    $link = "{$folderUpload}/{$image->name}";
    $data = array("message" => "Foto berhasil ditambahkan di {$link}");
} else {
    $data = array("message" => "Foto gagal ditambahkan");
}

print_r(json_encode($data));
