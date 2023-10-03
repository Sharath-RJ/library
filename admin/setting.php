<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="seting.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		
	</style>
</head>
<body>
	<?php

//setting.php

include '../database_connection.php';

include '../function.php';

if(!is_admin_login())
{
	header('location:../admin_login.php');
}

$message = '';

if(isset($_POST['edit_setting']))
{
	$data = array(
	
		
	
		
		':library_total_book_issue_day'	=>	$_POST['library_total_book_issue_day'],
		':library_one_day_fine'			=>	$_POST['library_one_day_fine'],
	
		':library_issue_total_book_per_user'	=>	$_POST['library_issue_total_book_per_user']
	);

	$query = "
	UPDATE lms_setting 
        SET 
      
      
        library_total_book_issue_day = :library_total_book_issue_day, 
        library_one_day_fine = :library_one_day_fine, 
        library_issue_total_book_per_user = :library_issue_total_book_per_user
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	$message = '
	<div class="alert alert-success alert-dismissible fade show" role="alert">Data Edited <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
	';
}

$query = "
SELECT * FROM lms_setting 
LIMIT 1
";

$result = $connect->query($query);


?>



	
	<?php 

	if($message != '')	
	{
		echo $message;
	}

	?>
	<div class="nav">
		<div class="logo">
         <i class="fa fa-gear" style="color:white; font-size:100px"></i>

		</div>
		<div class="title">
       <h1>SETTINGS</h1>
		</div>
	</div> 


			 <form method="post" action="setting-update.php">
				<?php 
				foreach($result as $row)
				{
				?> 
			
				
			<div class="main-container-settings">
        <div class="left-container">
		    
            <div class="theme-color">
				<label for="">student</label>
				<input type="radio" name="user" id="student" checked="checked">
				<label for="">Staff</label>
				<input type="radio" name="user" id="staff">
			</div>
            <div class="background-color">
                <div class="dark"></div>
                <div class="light"></div>
            </div> 
        </div>
        <div class="right-container" id="setting-container-student">
			<h3>Student Settings</h3>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Book Return Day Limit</p></div>
                    <div class="theback"><input type="number" name="lib_day_limit"  class="form-control"
                        value="<?php echo $row['library_total_book_issue_day']; ?>" />
                    </div>
                </div>
            </div>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Book Late Return One Day Fine</p></div>
                    <div class="theback"><input type="number" name="lib_fine" class="form-control"
					 value="<?php echo $row['library_one_day_fine']; ?>" />
				</div>
                </div>
            </div>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Per User Book Issue Limit</p></div>
                    <div class="theback"><input type="number" name="lib_book_limit"  class="form-control" 
					value="<?php echo $row['library_issue_total_book_per_user']; ?>" />
				</div>
                </div>
            </div>
        </div>

		<div class="right-container" id="setting-container-staff" style="display:none;">
			<h3>Staff Settings</h3>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Book Return Day Limit</p></div>
                    <div class="theback"><input type="number" name="lib_day_limit_staff" class="form-control"
                      value="<?php echo $row['library_total_book_issue_staff']; ?>" />
                    </div>
                </div>
            </div>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Book Late Return One Day Fine</p></div>
                    <div class="theback"><input type="number" name="lib_fine_staff" class="form-control"
					 value="<?php echo $row['library_fine_staff']; ?>"/>
				</div>
                </div>
            </div>
            <div class="main-box">
                <div class="thecard">
                    <div class="thefront"><p>Per User Book Issue Limit</p></div>
                    <div class="theback">
					<input type="number" name="lib_book_limit_staff"  class="form-control"
					value="<?php echo $row['library_total_book_issue_per_staff']; ?>"/>
				</div>
                </div>
            </div>
			
        </div>
		<div class="save-container">
		<button type="submit" name="" >save</button>
		</div>
		

    </div>
	
	
				
					
			
				
				<?php 
				}
				?>
			</form> 

		</div>
	</div>
</div>



<?php 



	
?>

<!-- <div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">Book Return Day Limit</label>
							<input type="number" name="library_total_book_issue_day" id="library_total_book_issue_day" class="form-control" value="<?php echo $row['library_total_book_issue_day']; ?>" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">Book Late Return One Day Fine</label>
							<input type="number" name="library_one_day_fine" id="library_one_day_fine" class="form-control" value="<?php echo $row['library_one_day_fine']; ?>" />
						</div>
					</div>
				</div>
				<div class="row">
					
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Per User Book Issue Limit</label>
						<input type="number" name="library_issue_total_book_per_user" id="library_issue_total_book_per_user" class="form-control" value="<?php echo $row['library_issue_total_book_per_user']; ?>" />
					</div>
				</div>
				<div class="mt-4 mb-0">
					<input type="submit" name="edit_setting" class="btn btn-primary" value="Save" />
				</div> -->
				<script>
$(document).ready(function(){
  $("#student").click(function(){
    $("#setting-container-student").show();
	$("#setting-container-staff").hide();
  });

   $("#staff").click(function(){
    $("#setting-container-staff").show();
	$("#setting-container-student").hide();
  });
  
});
</script>
				
<!-- <form action="setting-update.php" method="post">
	<input type="text" name="lib_limit">
	<button type="submit">save</button>
</form> -->
</body>
</html>