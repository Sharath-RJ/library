<?php
$lib_day_limit=$_POST['lib_day_limit'];
$fine=$_POST['lib_fine'];
$book_issue_limit=$_POST['lib_book_limit'];
$lib_day_limit_staff=$_POST['lib_day_limit_staff'];
$fine_staff=$_POST['lib_fine_staff'];
$book_issue_limit_staff=$_POST['lib_book_limit_staff'];



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

$sql = "UPDATE lms_setting SET library_total_book_issue_day='$lib_day_limit',
 library_one_day_fine='$fine',library_issue_total_book_per_user='$book_issue_limit',
 library_total_book_issue_staff='$lib_day_limit_staff',
 	library_fine_staff='$fine_staff',
  library_total_book_issue_per_staff='$book_issue_limit_staff' WHERE setting_id=1";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Saved Successfully")</script>';
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

