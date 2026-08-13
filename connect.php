<?php
$servername = "localhost";
$username = "root";
$password = "anshu";
$dbName = "website";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected";
?>