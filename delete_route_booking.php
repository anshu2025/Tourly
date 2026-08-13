<?php

include 'connect.php';

$id = $_GET['id'];

$conn->query("DELETE FROM route_bookings WHERE id=$id");

header("Location: profile.php");

?>