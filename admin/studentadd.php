<?php
$name=$_POST['user_name'];
$opton=$_POST['user_options'];
$mem_no=$_POST['user_mem_no'];
$address=$_POST['user_address'];
$phone=$_POST['user_contact_no'];
$email=$_POST['user_email_address'];
$pass=$_POST['user_password'];
$type=$_POST['user'];
if($_POST['register_button'])
{

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO lms_user (user_name,user_address,user_contact_no,user_email_address,user_password,user_unique_id,option,user_type)
  VALUES ('$name', '$address', '$phone','$email','$pass','$mem_no','$opton','$type')";
  // use exec() because no results are returned
 $res= $conn->exec($sql);
 if($res)
  echo "<script>alert('New User Registered Successfully')</script>";
  else{
    echo"no";
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

}
?>