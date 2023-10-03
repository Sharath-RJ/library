<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<?php
include '../database_connection.php';
?>
<div>
    <table>
        <?php
   if(isset($_POST['submit']))
   {
    $search=$_POST['search'];
    $sql="SELECT * from lms_user where user_unique_id='$search' or
    user_name ='$search' or user_address='$search' or user_contact_no='$search'or
    user_email_address='$search' or option='$search'";
   $statement = $connect->prepare($sql);

   $result=$statement->execute();
    if($result)
    {
       if($statement->rowCount()>0)
       {
         echo '<table class="book-tab">
        	<tr class="tr"> 
        				<th class="th">Photo</th>
                        <th class="th">Membership Number</th>
                        <th class="th">User Name</th>
                        <th class="th">Email Address</th>
                        <th class="th">Option</th>
                        <th class="th">Contact No.</th>
                        <th class="th">Address</th>
                        <th class="th">Action</th>
        			</tr>
            
         ';
         foreach($statement->fetchAll() as $row)
        			{
        				
        				echo '
        					<tr class="tr">
    						<td class="td"><img src="../upload/'.$row["user_profile"].'" class="img-thumbnail" width="75" /></td>
    						<td class="td">'.$row["user_unique_id"].'</td>
    						<td class="td">'.$row["user_name"].'</td>
    						<td class="td">'.$row["user_email_address"].'</td>
    						<td class="td">'.$row["option"].'</td>
    						<td class="td">'.$row["user_contact_no"].'</td>
    						<td class="td">'.$row["user_address"].'</td>
    				        <td class="td"><a href="deleteuser.php?id='.$row["user_unique_id"].'">Delete</a></td>
    					</tr>
        				';
        			}
       }
       else{
        echo "No data found";
       }
    }
    else{
        echo "data not found";
    }

   }
        ?>
    </table>
</div>

</body>
</html>