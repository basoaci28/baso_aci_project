<?php
// Koneksi database
require_once dirname(__FILE__) . "/../../dbConnect.php";
//an array to display response
$response = array();

if (isTheseParametersAvailable(array('nama', 'password', 'alamat', 'foto', 'no_hp', 'is_verified'))) {

    //getting the values
    $id = uniqid();
    $nama = $_POST['nama'];
    // $email = $_POST['email'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $foto = $_POST['foto'];
    $no_hp = $_POST['no_hp'];
    $is_verified = $_POST['is_verified'];

    //checking if the user is already exist with this nama or password
    //as the email and nama should be unique for every user
    $stmt = $con->prepare("SELECT id FROM reseller WHERE no_hp = ? OR password = ?");
    $stmt->bind_param("ss", $no_hp, $password);
    $stmt->execute();
    $stmt->store_result();

    //if the user already exist in the database
    if ($stmt->num_rows > 0) {
        $response['error'] = true;
        $response['message'] = 'Reseller already registered';
        $stmt->close();
    } else {
        //if user is new creating an insert query
        $stmt = $con->prepare("INSERT INTO reseller (`id`, `nama`, `password`, `alamat`, `foto`, `no_hp`, `is_verified`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $_POST['id'], $_POST['nama'], $_POST['password'], $_POST['alamat'], $_POST['foto'], $_POST['no_hp'], $_POST['is_verified']);

        //if the user is successfully added to the database
        if ($stmt->execute()) {
            try
            {
                //fetching the user back
                $stmt = $con->prepare("SELECT `id`, `nama`, `email`, `alamat`, `foto`, `no_hp`, `is_verified` FROM reseller WHERE no_hp = ?");
                $stmt->bind_param("s", $no_hp);
                $stmt->execute();
                $stmt->bind_result($id, $nama, $email, $alamat, $foto, $no_hp, $is_verified);
                $stmt->fetch();

                $user = array(
                    'id' => $id,
                    'nama' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'foto' => $foto,
                    'no_hp' => $no_hp,
                    'is_verified' => $is_verified,
                );

                $stmt->close();

                //adding the user data in response
                $response['error'] = false;
                $response['message'] = 'Reseller registered successfully';
                $response['user'] = $user;

            } catch (PDOException $e) {
                $message = $e->getMessage();
                $response['error'] = $message;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'Reseller failed to register';
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
