<?php
include 'connect.php';
  $email = $_POST["email"];
  $sql="INSERT INTO `subscriber` (`email`,`date`) VALUES ('$email', CURRENT_TIMESTAMP())";
  $result=mysqli_query($conn,$sql);
  header("Location:index.php");
 ?>