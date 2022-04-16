<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";

$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/basoaci/image/product/';
// Mendapatkan variable post
// $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
// $detail = isset($_POST["detail"]) ? $_POST["detail"] : "";
// $stok = isset($_POST["stok"]) ? $_POST["stok"] : "";
// $harga = isset($_POST["harga"]) ? $_POST["harga"] : "";

// $gambar = $_FILES['gambar']['name'];
// $tempPath = $_FILES['gambar']['tmp_name'];
// $fileSize = $_FILES['gambar']['size'];

// if (empty($gambar)) {
//     $errorMsg = json_encode(array("message" => "Mohon pilih image", "status" => false));
//     echo $errorMsg;
// } else {
//     $upload_path = __DIR__ . '/image/product/';

//     $fileExt = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

//     $valid_ext = array('jpeg', 'jpg', 'png');
//     $rand_num = rand(1, 999);
//     $new_gambar = $rand_num . '-' . $gambar;

//     if (in_array($fileExt, $valid_ext)) {
//         if (!file_exists($upload_path . $new_gambar)) {
//             if ($fileSize < 10000000) {
//                 move_uploaded_file($tempPath, $upload_path . $new_gambar);
//             } else {
//                 $errorMsg = json_encode(array("message" => "Maaf gambar terlalu besar", "status" => false));
//                 echo $errorMsg;
//             }
//         } else {
//             $errorMsg = json_encode(array("message" => "Maaf file sudah ada, silahkan cek upload folder", "status" => false));
//             echo $errorMsg;
//         }
//     } else {
//         $errorMsg = json_encode(array("message" => "Maaf, hanya gambar dengan tipe JPG, JPEG, PNG yang diizinkan", "status" => false));
//         echo $errorMsg;
//     }
// }

// if (!isset($errorMsg)) {
//     // query menambahkan data
//     $sql = mysqli_query($con, "INSERT INTO `product` (`nama`,`detail`,`stok`,`harga`,`gambar`) VALUES ('" . $nama . "','" . $detail . "','" . $stok . "','" . $harga . "','" . $new_gambar . "')");

//     echo json_encode(array("message" => "Data berhasil ditambahkan", "status" => true));
// }

// ------Coba kode kokoh------

$message = 'Params ';
$is_error = false;

if (!isset($_POST['nama'])) {
    $message .= "nama ";
    $is_error = true;
}
if (!isset($_POST['email'])) {
    $message .= "email ";
    $is_error = true;
}
if (!isset($_POST['password'])) {
    $message .= "password ";
    $is_error = true;
}
if (!isset($_POST['alamat'])) {
    $message .= "alamat ";
    $is_error = true;
}
if (!isset($_FILES['image']['name'])) {
    $message .= "image ";
    $is_error = true;
}
if (!isset($_POST['no_hp'])) {
    $message .= "alamat ";
    $is_error = true;
}
if (!isset($_POST['is_verified'])) {
    $message .= "is_verified ";
    $is_error = true;
}

//in case we have an error in validation, displaying the error message
if ($is_error) {
    $response['error'] = true;
    $response['message'] = $message . " required.";
} else {
    //if validation succeeds
    //creating a target file with a unique name, so that for every upload we create a unique file in our server
    $target_file = $target_dir . uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    //saving the uploaded file to the uploads directory in our target file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //saving the file information to our database
        $stmt = $con->prepare("INSERT INTO product (`nama`, `detail`,`stok`,`harga`,`gambar`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['nama'], $_POST['detail'], $_POST['stok'], $_POST['harga'], $target_file);

        //if it is saved in database successfully
        if ($stmt->execute()) {
            //displaying success response
            $response['error'] = false;
            $response['message'] = 'Image Uploaded Successfully';
            $response['image'] = getBaseURL() . $target_file;
        } else {
            //if not saved in database
            //showing response accordingly
            $response['error'] = true;
            $response['message'] = 'Could not upload image, try again...';
        }
        $stmt->close();
    } else {
        $response['error'] = true;
        $response['message'] = 'Try again later...';
    }
}

function getBaseURL()
{
    $url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];
    $url .= $_SERVER['REQUEST_URI'];
    return dirname($url) . '/';
}
header('Content-Type: application/json');
echo json_encode($response);
