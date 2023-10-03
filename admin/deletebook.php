<?php

 include '../database_connection.php';
 error_reporting(0);
 $cn=$_GET['cn'];
  echo $cn;

   $query = "
		DELETE from lms_book 
        WHERE call_no ='$cn'
		";

        $statement = $connect->prepare($query);

		$statement->execute($data);

		header('location:book.php?msg=delete');

?>