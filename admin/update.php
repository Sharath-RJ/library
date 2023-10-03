 <?php
$ac=$_POST['acc_no'];
$cn=$_POST['call_no'];
$ba=$_POST['book_author'];
$bn=$_POST['book_name'];
$pub=$_POST['publisher'];
$year=$_POST['year'];
$nc=$_POST['book_no_of_copy'];
$isbn=$_POST['isbn_no'];
$price=$_POST['price'];
$page=$_POST['page'];
echo $ac;
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE lms_book SET book_name='$bn',
  book_author='$ba',
  acc_no='$ac',call_no='$cn',year='$year',page='$page',book_price='$price',
  book_no_of_copy='$nc',publisher='$pub',book_isbn_number='$isbn' WHERE call_no='$cn'";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  // echo $stmt->rowCount() . " records UPDATED successfully";
  header('location:allbooks.php?msg=edit');
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>