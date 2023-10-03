<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	     <link rel="stylesheet" href="select2.min.css">
        <link rel="stylesheet" href="simple-datatables-style.css">
        <link rel="stylesheet" href="styles.css"> 
         <link rel="stylesheet" href="vanillaSelectBox.css">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="adminlogin.css">
</head>
<body>
	<?php

//admin_login.php
include 'database_connection.php';

include 'function.php';


$message = '';

if(isset($_POST["login_button"]))
{

	$formdata = array();

	if(empty($_POST["admin_email"]))
	{
		$message .= '<li>Email Address is required</li>';
	}
	else
	{
		if(!filter_var($_POST["admin_email"], FILTER_VALIDATE_EMAIL))
		{
			$message .= '<li>Invalid Email Address</li>';
		}
		else
		{
			$formdata['admin_email'] = $_POST['admin_email'];
		}
	}

	if(empty($_POST['admin_password']))
	{
		$message .= '<li>Password is required</li>';
	}
	else
	{
		$formdata['admin_password'] = $_POST['admin_password'];
	}

	if($message == '')
	{
		$data = array(
			':admin_email'		=>	$formdata['admin_email']
		);

		$query = "
		SELECT * FROM lms_admin 
        WHERE admin_email = :admin_email
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if($statement->rowCount() > 0)
		{
			foreach($statement->fetchAll() as $row)
			{
				if($row['admin_password'] == $formdata['admin_password'])
				{
					$_SESSION['admin_id'] = $row['admin_id'];

					header('location:home.php');
				}
				else
				{
					$message = '<li>Wrong Password</li>';
				}
			}
		}	
		else
		{
			$message = '<li>Wrong Email Address</li>';
		}
	}

}


?>

<div class="d-flex align-items-center justify-content-center" style="min-height:700px;">

	<div class="col-md-6">

		<?php 
		if($message != '')
		{
			echo '<div class="alert alert-danger"><ul>'.$message.'</ul></div>';
		}
		?>
        <img class="wave" src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/wave.png">
        <div class="container">
            <div class="img">
                <img src="">
            </div>
            <div class="login-content">
                <form method="post">
                    <img src="images/studentlogin.png">
                    <h2 class="title">Welcome</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="text" class="input" name="admin_email" id="admin_email" required autocomplete="off">
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" class="input" name="admin_password" id="admin_password" required autocomplete="off">
                        </div>
                    </div>
                   
                    <input type="submit" class="btn" value="Login" name="login_button">
                </form>
            </div>
        </div>




	</div>
</div>
<script>
	const inputs = document.querySelectorAll(".input")

function addcl() {
    let parent = this.parentNode.parentNode
    parent.classList.add("focus")
}

function remcl() {
    let parent = this.parentNode.parentNode
    if (this.value == "") {
        parent.classList.remove("focus")
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", addcl)
    input.addEventListener("blur", remcl)
})
</script>
</body>
<input type="text" name="admin_email" id="admin_email" class="form-control" />
<input type="password" name="admin_password" id="admin_password" class="form-control" />

<input type="submit" name="login_button" class="btn btn-primary" value="Login" />
</html>