<?php

require dirname(__FILE__) . "/../../include/dbConnect.php";

// header('Access-Control-Allow-Origin');

// mysqli_connect_errno();
// date_default_timezone_set('Asia/Jakarta');

// $json = array(
//     "response_status" => "OK",
//     "response_message" => "",
//     "data" => array(),
// );

// $no_hp = isset($_GET['no_hp']) ? $_GET['no_hp'] : "";
// $password = isset($_GET['password']) ? $_GET['password'] : "";
// $sql = $con->query("SELECT * FROM user WHERE no_hp = '" . $no_hp . "' AND password = '" . $password . "' ");

// $row = $sql->num_rows;

// if ($row > 0) {
//     while ($rowResult = $sql->fetch_object()) {
//         $arr_row = array();
//         $arr_row['nama'] = $rowResult->nama;
//         $arr_row['email'] = $rowResult->email;
//         $arr_row['alamat'] = $rowResult->alamat;
//         $arr_row['no_hp'] = $rowResult->no_hp;
//         $json['data'][] = $arr_row;
//     }
// } else {
//     $json['response_status'] = "Error";
//     $json['response_message'] = "No Hp atau Password salah";
// }

// header('Content-Type: application/json');
// echo json_encode($json, JSON_PRETTY_PRINT);

//an array to display response
$response = array();

if (isTheseParametersAvailable(array('no_hp', 'password'))) {

    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT id, nama, email, password, no_hp FROM user WHERE no_hp = ? AND password = ?");
    $stmt->bind_param("ss", $no_hp, $password);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($id, $nama, $email, $password, $no_hp);
        $stmt->fetch();

        $user = array(
            'id' => $id,
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'no_hp' => $no_hp,
        );

        $response['error'] = false;
        $response['message'] = 'Login successfull';
        $response['user'] = $user;
    } else {
        $response['error'] = false;
        $response['message'] = 'Invalid nama or password';
    }
}

//displaying the response in json structure
echo json_encode($response);

//function validating all the paramters are available
//we will pass the required parameters to this function
function isTheseParametersAvailable($params)
{
    // traversing through all the parameters
    foreach ($params as $param) {
        //if the paramter is not available
        //if the paramter is not available
        if (!isset($_POST[$param])) {
            //return false
            return false;
        }
    }
    // return true if every param is available
    return true;
}
