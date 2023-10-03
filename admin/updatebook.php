<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="adminss.css">
    <style>
        .nav{
    width: 100%;
    background-color:rgba(0, 0, 0, 0.559);
    display: flex;
    
    align-items: center;
    padding: 10px 20px;
    margin-bottom:100px;

}
.nav .logo{
    display:  flex;
    justify-content: center;
    align-items: center;
    width:150px ;
    height: 100px;
}
.nav .title h1{
    color: white;
    letter-spacing: 3px;
}

    </style>
</head>
<body>
    <?php
    include '../database_connection.php';
    error_reporting(0);
    $an=$_GET['an'];
    $cn=$_GET['cn'];
    $bn=$_GET['bn'];
    $ba=$_GET['ba'];
    $nc=$_GET['nc'];
    $y=$_GET['y'];
    $pub=$_GET['pub'];
     $isbn=$_GET['isbn'];
    $price=$_GET['price'];
    $page=$_GET['page'];

    ?>
  <div class="nav">
		<div class="logo">
    <i class="fas fa-edit" style="color:white; font-size:40px"></i>

		</div>
		<div class="title">
       <h1>EDIT BOOKS</h1>
		</div>
        
	</div> 

    <form action="update.php" method="post" class="form">
    <div class="container_addbook">

        <div class="input-book">
            <input type="text" class="input" name="acc_no" value="<?php echo $an ?>" >
            <label for="" class="">Acc.NO</label>
        </div>

        <div class="input-book">
            <input type="text" class="input" name="call_no" value="<?php echo $cn ?>">
            <label for="" class="">Call NO</label>
        </div>
		<div class="input-book">
            <input type="text" class="input" name="isbn_no" value="<?php echo $isbn ?>">
            <label for="" class="">ISBN Number</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_author" value="<?php echo $ba ?>">
            <label for="" class="">Author</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_name" value="<?php echo $bn ?>">
            <label for="" class="">Title</label>
        </div>

    </div>

    <div class="container_addbook">
        <div class="input-book">
            <input type="text" class="input" name="publisher" value="<?php echo $pub ?>">
            <label for="" class="">Publisher</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="year" value="<?php echo $y ?>">
            <label for="" class="">Year</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_no_of_copy" value="<?php echo $nc ?>">
            <label for="" class="">No of Copies</label>
        </div>
		<div class="input-book">
            <input type="text" class="input" name="price" value="<?php echo $price ?>">
            <label for="" class="">Price</label>
        </div>
		
		<div class="input-book">
            <input type="text" class="input" name="page" value="<?php echo $page ?>">
            <label for="" class="">Page</label>
</div>

    </div>
	<div class="container_addbook">
		 <div class="input-book">
            <input type="submit" class="sub" name="edit_book" value="Edit  BOOK">
            <!-- <label for="" class="label">Placeholder</label> -->
        </div>
	</div>

</form>

</body>
</html>