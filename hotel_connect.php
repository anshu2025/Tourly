<?php
$host = "localhost";
$user = "root";
$pass = "anshu";
$db   = "Website";

$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>