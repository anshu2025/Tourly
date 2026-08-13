<?php
session_start();
include 'connect.php';

if(isset($_GET['id']) && isset($_SESSION['email'])){

    $booking_id = $_GET['id'];
    $email = $_SESSION['email'];

    // booking date & price nikalo
    $stmt = $conn->prepare("
        SELECT b.booking_date, p.price 
        FROM bookings b
        JOIN packages p ON b.package_id = p.package_id
        WHERE b.booking_id=? AND b.email=?
    ");
    $stmt->bind_param("is", $booking_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){

        $booking_date = strtotime($row['booking_date']);
        $current_date = time();
        $days = ($current_date - $booking_date) / (60 * 60 * 24);

        // ✅ 10 din ke andar → Cancel + refund
        if($days <= 10){

            $price = $row['price'];
            $refund = $price * 0.82;

            $del = $conn->prepare("DELETE FROM bookings WHERE booking_id=? AND email=?");
            $del->bind_param("is", $booking_id, $email);
            $del->execute();

            echo "<script>
                alert('Booking cancelled! Refund: ₹$refund (18% deducted)');
                window.location.href='profile.php';
            </script>";
        }

        // 🔥 10 din ke baad → Direct delete (no message)
        else{

            $del = $conn->prepare("DELETE FROM bookings WHERE booking_id=? AND email=?");
            $del->bind_param("is", $booking_id, $email);
            $del->execute();

            header("Location: profile.php");
            exit;
        }

    } else {
        echo "Booking not found!";
    }
}
?>