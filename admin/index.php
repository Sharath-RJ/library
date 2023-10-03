<?php

//index.php

include '../database_connection.php';

include '../function.php';

if(!is_admin_login())
{
	header('location:../admin_login.php');
}


// include '../header.php';

?>
<style>
	.main-container-dash{
    /* width: 100%; */
	/* height:50%;
	background-color:green; */

    display: flex;
	justify-content:space-around;
	
}
.custom{
	margin-top:200px;
	background-color:blue;
	border-radius:25px;
	color:white;
}
</style>

<!-- <div class="container-fluid py-4" >
	<h1 class="mb-5">Dashboard</h1>
	<div class="row d-flex"> -->
		
<div class="main-container-dash">
  <div class="card custom" style="width: 13rem; height:15rem" >
  <img class="card-img-top" src="hand-over.png" alt="Card image cap" style="width:100px">
  <div class="card-body">
    <h5 class="card-text text-white" >Total Books Issued</h5>
	<h1><?php echo Count_total_issue_book_number($connect); ?></h1>
  </div>
</div>

   <div class="card custom" style="width: 13rem; height:15rem" >
  <img class="card-img-top" src="return.png" alt="Card image cap" style="width:100px">
  <div class="card-body">
    <h5 class="card-text text-white" >Total Books Returned</h5>
	<h1><?php echo Count_total_returned_book_number($connect);?></h1>
  </div>
</div>

   <div class="card custom" style="width: 13rem; height:15rem" >
  <img class="card-img-top" src="no-education.png" alt="Card image cap" style="width:100px">
  <div class="card-body">
    <h5 class="card-text text-white" >Total Book Not Returned</h5>
	<h1><?php echo Count_total_not_returned_book_number($connect);?></h1>
  </div>
</div>

   <div class="card custom" style="width: 13rem; height:15rem" >
  <img class="card-img-top" src="fine.png" alt="Card image cap" style="width:100px">
  <div class="card-body">
    <h5 class="card-text text-white" >Total Fine Received</h5>
	<h1><?php echo Count_total_fines_received($connect); ?></h1>
  </div>
</div>

   <div class="card custom" style="width: 13rem; height:15rem"
   onMouseOver="show_sidebar()" onMouseOut="hide_sidebar()" >
  <img class="card-img-top" src="books.png" alt="Card image cap" style="width:100px">
  <div class="card-body">
    <h5 class="card-text text-white text-center" >Total No Of Books</h5>
	<h1 class="sidebar"><?php echo Count_total_book_number($connect); ?></h1>
  </div>
</div>
</div>





    




	<!-- </div> -->
<!-- </div> -->

