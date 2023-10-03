<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <title>Document</title>
  <style>
    body{
      justify-content:center;
      align-items:center;
      display:flex;
    }
    .payfine-container{
      width:75%;
      height:50vh;
      background:grey;
      position: absolute;
      top:30%;
      border:3px solid black;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .fine-box{
      width:250px;
      height:40px;
      border-radius:50px;
    }
    label{
      font-size:30px;
      color:white;
    }
    .pay{
      width:120px;
    height:40px;
  border-radius:5px;
background:blue;
color:white;  
font-size:20px }
.nav {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.559);
        display: flex;

        align-items: center;
        padding: 10px 20px;
        margin-bottom: 100px;

    }

    .nav .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 100px;
    }

    .nav .title h1 {
        color: white;
        letter-spacing: 3px;
    }
	.nav .search {
       
        width: 800px;
        height: 100px;
        align-items: center;
        justify-content: end;
        display: flex;
    }
  </style>
</head>
<body>
  <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
if(isset($_POST['pay']))
{
    $pay_fine=$_POST['fine'];
    
    $id=$_GET['code'];
    $book_fine=$_GET['fine'];
    $updated_fine=$book_fine-$pay_fine;
$sql = "UPDATE lms_issue_book SET book_fines='$updated_fine'
 
 WHERE issue_book_id='$id'";

if (mysqli_query($conn, $sql)) {
    header('location:fine.php?msg=paid');
  
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
}


?>
     <div class="nav">
            <div class="logo">
               <i class='fas fa-rupee-sign' style="font-size:40px;color:white;"></i>

            </div>
            <div class="title">
                <h1>PAY FINE</h1>
            </div>
			

        </div>
<div class="payfine-container">
    <form action="" method="post">
    <label for="">Pay Fine</label>
    <input type="text" name="fine" class="fine-box">
    <input type="submit" value="Pay" name="pay" class="pay">
    </form>
</div>
</body>
</html>