<?php

require dirname(__FILE__) . "/../../include/dbConnect.php";

header('Access-Control-Allow-Origin');

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
        $response['message'] = 'Invalid no_hp or password';
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
