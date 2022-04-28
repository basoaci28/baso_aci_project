<?php
define('HOST', 'localhost');
define('USER', 'id18601187_basoaci28admin');
define('PASS', 'P0~?Ns&WdIBP0i!g');
define('DB', 'id18601187_db_basoaci');

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
