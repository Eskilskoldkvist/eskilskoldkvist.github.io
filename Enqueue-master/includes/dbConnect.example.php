<?php

$host = "localhost";
$username = "root";
$password = "root";
$db = "Enqueue";


$connection = mysqli_connect($host, $username, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

?>
