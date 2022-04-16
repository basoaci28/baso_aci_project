<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";

//error message and error flag
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
if (!isset($_POST['no_hp'])) {
    $message .= "alamat ";
    $is_error = true;
}

//in case we have an error in validation, displaying the error message
if ($is_error) {
    $response['error'] = true;
    $response['message'] = $message . " required.";
} else {
    //saving the file information to our database
    $stmt = $con->prepare("INSERT INTO user (`nama`, `email`,`password`,`alamat`,`no_hp`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $_POST['nama'], $_POST['email'], $_POST['password'], $_POST['alamat'], $_POST['no_hp']);

    //if it is saved in database successfully
    if ($stmt->execute()) {
        //displaying success response
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditambahkan';
    } else {
        //if not saved in database
        //showing response accordingly
        $response['error'] = true;
        $response['message'] = 'Data tidak dapat ditambahkan';
    }
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
