<?php
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'user'){

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $path = "assets/uploads/" . time() . "_" . $image;

    move_uploaded_file($tmp, $path);

    header("Location: index.php#gallery");

} else {
    echo "Access Denied!";
}
?>