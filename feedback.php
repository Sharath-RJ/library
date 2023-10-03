<?php 
// ob_start(); 
require 'database_connection.php';

$view = $_POST['view'];

$comments = $_POST['comments'];




$query = mysqli_query($con, "INSERT INTO `feedback`(`id`, `feedback`, `suggestions`) VALUES ('','$view','$comments')");
echo '<script>alert("Thank You..! Your Feedback is Valuable to Us"); location.replace(document.referrer);</script>';