<?php
require_once(dirname(__FILE__)."/../../include/dbConnect.php");

    $sql = "SELECT * FROM user ORDER BY id ASC";
    $query = mysqli_query($con, $sql);
    while($data = mysqli_fetch_array($query)){
        $item[] = array(
            'id' => $data['id'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
        );
    }

    $response = array(
        'status' => 'OK',
        'data' => $item
    );

    echo json_encode($response);
