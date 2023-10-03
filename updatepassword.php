<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .update-pass-con{
        width:500px;
       
        background-color:grey;
        position:absolute;
        left:20%;
        top:10%;
        align-items:center;
        justify-content:center;
        padding:100px;
    }
    .update-pass-con input{
        width:300px;
        height:20px;
        margin-top:10px;
        margin-bottom:10px;
        border-radius:20px;
        border:1px solid black;
    }
    .sub{
          width:310px;
        height:20px;
        margin-top:10px;
        margin-bottom:10px;
        border-radius:20px;
        border:1px solid black;
        background:blue;
        color:white;
    }
</style>
<body>
    <?php
include 'database_connection.php';

include 'function.php';
    ?>
  
    <?php

   


        $query = "
SELECT * FROM lms_user where  user_unique_id='".$_SESSION['user_id']."'";

$statement = $connect->prepare($query);

$statement->execute();
    

    if($statement->rowCount() > 0)
				{
					foreach($statement->fetchAll() as $row)
					{
				
						$pass = $row["user_password"];
                        $id=$row["user_id"];
                    }
                }
					
							

    ?>
   
    
      <div class="update-pass-con">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <label for="">Password</label><br>
        <input type="text" value="<?php echo $pass ?>"><br>
        <label for="">New Password</label><br>
        <input type="text" name="newpass"><br>
        
        <input type="submit" value="Submit" name="submit" class="sub">
        </form>
    </div>
    
    <?php
    if(isset($_POST['submit'])){
        $newpass=$_POST['newpass'];

        $query = "
		UPDATE lms_user 
            SET user_password = '$newpass'
            WHERE user_id= '$id' 
		";

		$statement = $connect->prepare($query);

		$result=$statement->execute();
        if($result)
        {
            echo '<script>alert("Password Updated Successfully");</script>';
        }
    }

    ?>
</body>
</html>