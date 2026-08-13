<?php
include 'connect.php';
  $name = $_POST["name"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
  
  $sql="INSERT INTO `feedback` (`name`, `email`, `comment`, `date`) VALUES ('$name', '$email', '$comment', CURRENT_TIMESTAMP())";
  $result=mysqli_query($conn,$sql);
  header("Location:index.php");

  ?>