<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'db_basoaci');

// class dbConnect
// {
//     private $con;

//     public function connect()
//     {
//         $con = mysqli_connect(HOST, USER, PASS, DB) or die("DB Tidak Terhubung" . mysqli_connect_error());

//         return $this->con;
//     }
// }
$con = mysqli_connect(HOST, USER, PASS, DB) or die("DB Tidak Terhubung" . mysqli_connect_error());
