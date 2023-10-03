<?php

 include '../database_connection.php';
 $id=$_GET['id'];
 echo $id;

   $query = "
		DELETE from lms_user 
        WHERE user_unique_id ='$id'
		";

        $statement = $connect->prepare($query);

		$statement->execute($data);

		header('location:user.php?action=delete');

?>
?>