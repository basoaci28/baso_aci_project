<?php

require dirname(__FILE__) . "/../../dbConnect.php";

//an array to display response
$response = array();

if (isTheseParametersAvailable(array('nama', 'password', 'alamat', 'no_hp'))) {

    //getting the values
    $id = uniqid();
    $nama = $_POST['nama'];
    // $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];

    //checking if the user is already exist with this nama or password
    //as the email and nama should be unique for every user
    $stmt = $con->prepare("SELECT id FROM user WHERE no_hp = ? OR password = ?");
    $stmt->bind_param("ss", $no_hp, $password);
    $stmt->execute();
    $stmt->store_result();

    //if the user already exist in the database
    if ($stmt->num_rows > 0) {
        $response['error'] = true;
        $response['message'] = 'User already registered';
        $stmt->close();
    } else {
        //if user is new creating an insert query
        $stmt = $con->prepare("INSERT INTO user (`id`, `nama`, `password`, `alamat`, `no_hp`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['id'], $_POST['nama'], $_POST['password'], $_POST['alamat'], $_POST['no_hp']);

        //if the user is successfully added to the database
        if ($stmt->execute()) {
            try
            {
                //fetching the user back
                $stmt = $con->prepare("SELECT `id`, `nama`, `email`, `alamat`, `no_hp` FROM user WHERE no_hp = ?");
                $stmt->bind_param("s", $no_hp);
                $stmt->execute();
                $stmt->bind_result($id, $nama, $email, $alamat, $no_hp);
                $stmt->fetch();

                $user = array(
                    'id' => $id,
                    'nama' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp,
                );

                $stmt->close();

                //adding the user data in response
                $response['error'] = false;
                $response['message'] = 'User registered successfully';
                $response['user'] = $user;

            } catch (PDOException $e) {
                $message = $e->getMessage();
                $response['error'] = $message;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'User failed to register';
        }
    }

} else {
    $response['error'] = true;
    $response['message'] = 'required parameters are not available';
}

//displaying the response in json structure
echo json_encode($response);

//function validating all the paramters are available
//we will pass the required parameters to this function
function isTheseParametersAvailable($params)
{
    //traversing through all the parameters
    foreach ($params as $param) {
        //if the paramter is not available
        if (!isset($_POST[$param])) {
            //return false
            return false;
        }
    }
    //return true if every param is available
    return true;
}
