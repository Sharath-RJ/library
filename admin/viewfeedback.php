<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .feedback_main-container{
        width:80%;
        padding:20px;
        background:blue;
        color:white;
        margin-left:100px;
        margin-bottom:100px;
        border:1px solid black;
        border-radius:20px;
    }    
    </style>
</head>
<body>
    <?php
    session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$isbn=$_GET['isbn'];
$user_id=$_SESSION['user_id'];


$sql = "SELECT * FROM lms_feedback WHERE isbn_no='$isbn'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  // output data of each row
  while($row = $result->fetch_assoc()) {
    
     $review_person=$row["user_id"];

  }
  
} else {
  echo "0 results";
}
$sql = "SELECT * FROM lms_user WHERE user_unique_id='$review_person'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
    <div class="feedback_main-container">

<?php
  while($row = $result->fetch_assoc()) {
 ?>   
    <h2 style="float:right;"><?php echo $row['user_name']?></h2>
<?php
  }
  
} 
$sql = "SELECT * FROM lms_feedback WHERE isbn_no='$isbn'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  // output data of each row
  while($row = $result->fetch_assoc()) {
   ?> 
    <h1><?php echo $row['view'];?></h1> 
     <h3><?php echo $row['comment'];?></h3>

<?php
  }
  ?>
 </div> 
 <?php
} 

$conn->close();

?>


</body>
</html>