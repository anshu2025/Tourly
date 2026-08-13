<?php
session_start();
include 'connect.php';

if(!isset($_GET['id'])){
    header("Location: profile.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
DELETE FROM bookings
WHERE booking_id=?
AND package_id IS NULL
AND hotel_name != ''
");

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: profile.php");
exit;
?>