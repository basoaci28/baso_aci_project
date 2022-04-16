<?php
define('HOST', 'remotemysql.com');
define('USER', 'qDmgh8dJsK');
define('PASS', 'DulfGsq6F1');
define('DB', 'qDmgh8dJsK');

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
