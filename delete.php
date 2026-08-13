<?php
session_start();

// 🔒 Only admin can delete
if(!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin'){
    die("Unauthorized access");
}

if(isset($_GET['img'])){
    $imgPath = $_GET['img'];

    // 🔐 Allow images + uploads folder
    if(
        strpos($imgPath, 'assets/images/') !== false || 
        strpos($imgPath, 'assets/uploads/') !== false
    ){

        if(file_exists($imgPath)){
            unlink($imgPath); // 🔥 delete
            header("Location: index.php#gallery");
            exit();
        } else {
            echo "File not found!";
        }

    } else {
        echo "Invalid file path!";
    }
}
?>