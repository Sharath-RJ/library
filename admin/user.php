<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="admin.css">
		<link rel="stylesheet" href="search.css">
	<title>Document</title>
	<style>
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

//user.php

include '../database_connection.php';

include '../function.php';

if(!is_admin_login())
{
	header('location:../admin_login.php');
}

if(isset($_GET["action"], $_GET['status'], $_GET['code']) && $_GET["action"] == 'delete')
{
	$user_id = $_GET["code"];
	$status = $_GET["status"];
	if($_GET["action"] == 'delete')
		{
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">One User Deleted <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}

	$data = array(
		':user_status'		=>	$status,
		':user_id'			=>	$user_id
	);

	$query = "
	UPDATE lms_user 
    SET user_status = :user_status
    WHERE user_id = :user_id
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	header('location:user.php?msg='.strtolower($status).'');
}

$query = "
	SELECT * FROM lms_user 
    ORDER BY user_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

// include '../header.php';

?>

<div class="container-fluid py-4" style="min-height: 700px;">
	
 <div class="nav">
        <div class="logo">
            <i class='fas fa-arrow-left' style='font-size:40px;color:white'></i>
            <i class="fa fa-book" style="font-size:40px;color:white"></i>


        </div>
        <div class="title">
            <h1>RETURN BOOK</h1>
        </div>
        <div class="search">
            <div class="body">
                <form action="fetchuser.php" method="post" class="search-bar">
                    <input type="search" name="search" pattern=".*\S.*" required >
                    <button class="search-btn" type="submit" name="submit">
                        <span>Search</span>
                    </button>
                </form>
            </div>

        </div>

    </div>
	
    <?php 
 	
 	if(isset($_GET["msg"]))
 	{
 		if($_GET["msg"] == 'disable')
 		{
 			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Category Status Change to Disable <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
 		}

 		if($_GET["msg"] == 'enable')
 		{
 			echo '
 			<div class="alert alert-success alert-dismissible fade show" role="alert">Category Status Change to Enable <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
 			';
 		}
 	}

    ?>
  
    		<table class="book-tab">
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
    			<?php 
    			if($statement->rowCount() > 0)
    			{
    				foreach($statement->fetchAll() as $row)
    				{
    					// $user_status = '';
    					// if($row['user_status'] == 'Enable')
    					// {
    					// 	$user_status = '<div class="badge bg-success">Enable</div>';
    					// }
    					// else
    					// {
    					// 	$user_status = '<div class="badge bg-danger">Disable</div>';
    					// }
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
    			else
    			{
    				echo '

    				<tr>
    					<td colspan="12" class="text-center">No Data Found</td>
    				</tr>
    				';
    			}
    			?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>

<script>

	function delete_data(code, status)
	{
		var new_status = 'Enable';

		if(status == 'Enable')
		{
			new_status = 'Disable';
		}

		if(confirm("Are you sure you want to "+new_status+" this User?"))
		{
			window.location.href = "user.php?action=delete&code="+code+"&status="+new_status+"";
		}
	}

</script>
</body>
</html>