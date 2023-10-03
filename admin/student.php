<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <link rel="stylesheet" href="admin.css"> -->
	<link rel="stylesheet" href="members.css">
	<style>
	

	</style>
</head>

<body>

	<!--<form action="studentadd.php" method="POST" enctype="multipart/form-data">
		<div class="input-container-register">
			<div class="inputbox-container">
				<label class="form-label">Membereship Number
				</label>
				<input type="text" name="user_mem_no" id="user_mem_no" class="form-control" />


			</div>
			<div class="inputbox-container">
				<label class="form-label">User Name</label>
				<input type="text" name="user_name" class="form-control" id="user_name" value="" />

			</div>
			<div class="inputbox-container">


				<label class="form-label">password.</label>
				<input type="text" name="user_password" id="" class="form-control" />

			</div>
			<div class="inputbox-container">
				<label class="form-label">Email address</label>
				<input type="text" name="user_email_address" id="user_email_address" class="form-control" />

			</div>
			<div class="inputbox-container">
				<label class="form-label">User Contact No.</label>
				<input type="text" name="user_contact_no" id="user_contact_no" class="form-control" />
			</div>
			<div class="inputbox-container">
				<label class="form-label">User Address</label>
				<textarea name="user_address" id="user_address" class="form-control"></textarea>
			</div>
			<div class="mb-3">
						<label class="form-label">User Photo</label><br />
						<input type="file" name="user_profile" id="user_profile" />
						<br />
						<span class="text-muted">Only .jpg & .png image allowed. Image size must be 225 x 225</span>
					</div> 
			<div class="inputbox-container">
				<label class="form-label">Options</label>
				<select name="user_options" id="cars" class="form-control">
				  <option value="Geography">Geography</option>
                   <option value="Hindi">Hindi</option>
                  <option value="Social Science">Social Science</option>
                   <option value="Natural Science">Natural Science</option>
                 </select>

			</div>
			




			<div class="">
				<input type="submit" name="register_button" class="register-btn" value="Register" />
			</div>
		</div>
	</form>  -->
 



<div class="main-container" >
	<div class="container">
	<div class="triangle"></div>
</div>
<div class="input-div">
	
	<form action="studentadd.php" method="POST" enctype="multipart/form-data">
	<div style="display:flex; margin-top:90px; justify-content:space-evenly; ">
	<div class="input-sub-container">
		<label for="">Membership Number</label>
		<input type="text" name="user_mem_no" id="user_mem_no" class="form-control" required/>
	</div>
	<div class="input-sub-container">
		<label for="">Name</label>
		<input type="text" name="user_name" class="form-control" id="user_name" value="" required/>
	</div>
	<div class="input-sub-container">
		<label for="">Password</label>
		<input type="text" name="user_password" id="" class="form-control" required />
		
	</div>
	<div class="input-sub-container">
		<label for="">Email Address</label>
		<input type="text" name="user_email_address" id="user_email_address" class="form-control" required />
	</div>
	</div>
	<div style="display:flex;  margin-top:90px; justify-content:space-evenly;  ">
		<div class="input-sub-container">
			<label for="">Contact Number</label>
				<input type="text" name="user_contact_no" id="user_contact_no" class="form-control" required/>
		</div>
	<div class="input-sub-container">
		<label for="">Address</label>
		<textarea name="user_address" id="user_address" class="form-control" required></textarea>
	</div>
	<div class="input-sub-container">
		<label for="">Options</label>
		<br>
		
		<select name="user_options" id="cars" class="form-control" style="color:white;" required>
			      <option >None</option>
				  <option value="Geography" style="color:black">Geography</option>
                   <option value="Hindi" style="color:black">Hindi</option>
                  <option value="Social Science" style="color:black">Social Science</option>
                   <option value="Natural Science" style="color:black">Natural Science</option>
                 </select>
	</div>

	</div>
	<div style="display:flex;  margin-top:90px; justify-content:space-evenly; ">
		<div class="input-sub-container">
			<input type="radio" name="user" id="" value="student">
			<label for="">Student</label>
			<input type="radio" name="user" id="" value="staff">
			<label for="">Staff</label>

		</div>
		<div>
			<input type="submit" name="register_button" class="input-sub-container" value="Register" />
		</div>
	</div>
	

</div>

<div class="right-container">
	

</div>
</div>

</body>

</html>