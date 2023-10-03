<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="script.js"></script>
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

//book.php

include '../database_connection.php';

include '../function.php';


if(!is_admin_login())
{
	header('location:../admin_login.php');
}

$message = '';

$error = '';

if(isset($_POST["add_book"]))
{
	$formdata = array();

	if(empty($_POST["book_name"]))
	{
		$error .= '<p>Book Name is required</p>';
	}
	else
	{
		$formdata['book_name'] = trim($_POST["book_name"]);
	}

	if(empty($_POST["call_no"]))
	{
		$error .= '<p>Book call no is required</p>';
	}
	else
	{
		$formdata['call_no'] = trim($_POST["call_no"]);
	}

	if(empty($_POST["book_author"]))
	{
		$error .= '<p>Book Author is required</p>';
	}
	else
	{
		$formdata['book_author'] = trim($_POST["book_author"]);
	}

	if(empty($_POST["acc_no"]))
	{
		$error .= '<p>Book acc no is required</p>';
	}
	else
	{
		$formdata['acc_no'] = trim($_POST["acc_no"]);
	}

	if(empty($_POST["publisher"]))
	{
		$error .= '<p> publisher is required</p>';
	}
	else
	{
		$formdata['publisher'] = trim($_POST["publisher"]);
	}
	if(empty($_POST["book_no_of_copy"]))
	{
		$error .= '<p>Book No. of Copy is required</p>';
	}
	else
	{
		$formdata['book_no_of_copy'] = trim($_POST["book_no_of_copy"]);
	}
	if(empty($_POST["year"]))
	{
		$error .= '<p>Book year is required</p>';
	}
	else
	{
		$formdata['year'] = trim($_POST["year"]);
	}
	if(empty($_POST["isbn_no"]))
	{
		$error .= '<p>ISBN Number is required</p>';
	}
	else
	{
		$formdata['isbn_no'] = trim($_POST["isbn_no"]);
	}
	if(empty($_POST["price"]))
	{
		$error .= '<p>Book price is required</p>';
	}
	else
	{
		$formdata['price'] = trim($_POST["price"]);
	}
    if(empty($_POST["page"]))
	{
		$error .= '<p>Book page is required</p>';
	}
	else
	{
		$formdata['page'] = trim($_POST["page"]);
	}

	if($error == '')
	{
		$data = array(
			':call_no'		=>	$formdata['call_no'],
			':book_author'			=>	$formdata['book_author'],
			':acc_no'	=>	$formdata['acc_no'],
			':book_name'			=>	$formdata['book_name'],
			':publisher'		=>	$formdata['publisher'],
			':book_no_of_copy'		=>	$formdata['book_no_of_copy'],
			':year'			=>	        $formdata['year'],
			':isbn_no'		=>	$formdata['isbn_no'],
			':price'		=>	$formdata['price'],
			':page'			=>	        $formdata['page']
		
		);

		$query = "
		INSERT INTO lms_book 
        (call_no, book_author, acc_no, book_name, publisher, book_no_of_copy, year,book_isbn_number,page,book_price) 
        VALUES (:call_no, :book_author, :acc_no, :book_name, :publisher, :book_no_of_copy, :year,:isbn_no,:price,:page)
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		echo '<script>alert("New Book Added Successfully")</script>';
	}
}

if(isset($_POST["edit_book"]))
{
	$formdata = array();

	if(empty($_POST["book_name"]))
	{
		$error .= '<p>Book Name is required</p>';
	}
	else
	{
		$formdata['book_name'] = trim($_POST["book_name"]);
	}

	if(empty($_POST["call_no"]))
	{
		$error .= '<p>Book Category is required</p>';
	}
	else
	{
		$formdata['call_no'] = trim($_POST["call_no"]);
	}

	if(empty($_POST["book_author"]))
	{
		$error .= '<p>Book Author is required</p>';
	}
	else
	{
		$formdata['book_author'] = trim($_POST["book_author"]);
	}

	if(empty($_POST["acc_no"]))
	{
		$error .= '<p>Book Location Rack is required</p>';
	}
	else
	{
		$formdata['acc_no'] = trim($_POST["acc_no"]);
	}

	if(empty($_POST["publisher"]))
	{
		$error .= '<p>publisher  is required</p>';
	}
	else
	{
		$formdata['publisher'] = trim($_POST["publisher"]);
	}
	if(empty($_POST["book_no_of_copy"]))
	{
		$error .= '<p>Book No. of Copy is required</p>';
	}
	else
	{
		$formdata['book_no_of_copy'] = trim($_POST["book_no_of_copy"]);
	}
	if(empty($_POST["isbn_no"]))
	{
		$error .= '<p>ISBN Number is required</p>';
	}
	else
	{
		$formdata['isbn_no'] = trim($_POST["isbn_no"]);
	}
	if(empty($_POST["price"]))
	{
		$error .= '<p>Book price is required</p>';
	}
	else
	{
		$formdata['price'] = trim($_POST["price"]);
	}
    if(empty($_POST["page"]))
	{
		$error .= '<p>Book page is required</p>';
	}
	else
	{
		$formdata['page'] = trim($_POST["page"]);
	}


	if($error == '')
	{
		$data = array(
			':call_no'		=>	$formdata['call_no'],
			':book_author'			=>	$formdata['book_author'],
			':acc_no'	=>	$formdata['acc_no'],
			':book_name'			=>	$formdata['book_name'],
			':publisher'		=>	$formdata['publisher'],
			':book_no_of_copy'		=>	$formdata['book_no_of_copy'],
			':year'				=>	$_POST["year"],
			':isbn_no'		=>	$formdata['isbn_no'],
			':price'		=>	$formdata['price'],
			':page'			=>	        $formdata['page']
		);
		$query = "
		UPDATE lms_book 
        SET call_no = :call_no, 
        book_author = :book_author, 
        acc_no = :acc_no, 
        book_name = :book_name, 
        publisher = :publisher, 
		book_isbn_number=':isbn',
        price=':price',
        page=':page'
    
        WHERE call_no = :call_no
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

			echo '<script>alert(" Book Edited Successfully")</script>';
	}
	
}

if(isset($_GET["action"], $_GET["code"], $_GET["status"]) && $_GET["action"] == 'delete')
{
	$book_id = $_GET["code"];
	$status = $_GET["status"];

	$data = array(
		//':book_status'		=>	$status,
		//':book_updated_on'	=>	get_date_time($connect),
		':book_id'			=>	$book_id
	);

	$query = "
	UPDATE lms_book 
    SET book_status = :book_status, 
    book_updated_on = :book_updated_on 
    WHERE book_id = :book_id
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	header('location:book.php?msg='.strtolower($status).'');
}


$query = "
	SELECT * FROM lms_book 
    ORDER BY book_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();


// include '../head.php';

?>

<div class="container-fluid py-4" style="min-height: 700px;">
	<div class="nav">
		<div class="logo">
<i class="fa fa-book" style="color:white; font-size:40px"></i>

		</div>
		<div class="title">
       <h1>ADD BOOKS</h1>
		</div>
	</div>
	
	<?php 
	if(isset($_GET["action"]))
	{
		if($_GET['action'] == 'search')
        {
   echo'  <form action="fetch.php" method="post">
		<input type="text" name="search" id="" placeholder="Search" >
		<button name="submit">Search</button>
	</form>';
	//include 'booktable.php';
         }
		if($_GET["action"] == 'add')
		{
	?>

	




    <?php 

    if($error != '')
    {
	?>
	<div style="background-color: red; color:white"><p><?php echo $error ?></p></div>
    <?php	
    }

    ?>

    			
      <form action="" method="post" class="form">
    <div class="container_addbook">

        <div class="input-book">
		
            <input type="text" class="input" name="acc_no" required placeholder="Acc NO">
            <label for="" class="label">Acc.NO</label>
        </div>

        <div class="input-book">
            <input type="text" class="input" name="call_no" required placeholder="Call No">
            <label for="" class="label">Call NO</label>
        </div>
		<div class="input-book">
            <input type="text" class="input" name="isbn_no" required placeholder="ISBN Number">
            <label for="" class="label">ISBN Number</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_author" required placeholder="Author"> 
            <label for="" class="label">Author</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_name" required placeholder="Title">
            <label for="" class="label">Title</label>
        </div>

    </div>

    <div class="container_addbook">
        <div class="input-book">
            <input type="text" class="input" name="publisher" required placeholder="Publisher ">
            <label for="" class="label">Publisher</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="year" required placeholder="Year">
            <label for="" class="label">Year</label>
        </div>
        <div class="input-book">
            <input type="text" class="input" name="book_no_of_copy" required placeholder="No of Copies">
            <label for="" class="label">No of Copies</label>
        </div>
		<div class="input-book">
            <input type="text" class="input" name="price" required placeholder="Price">
            <label for="" class="label">Price</label>
        </div>
		
		<div class="input-book">
            <input type="text" class="input" name="page" required placeholder="Page">
            <label for="" class="label">Page</label>
</div>

    </div>
	<div class="container_addbook">
		 <div class="input-book">
			<button type="submit" class="sub" name="add_book">ADD BOOK</button>
            <!-- /<input type="submit" class="sub" name="add_book" value="ADD BOOK"> -->
            <!-- <label for="" class="label">Placeholder</label> -->
        </div>
	</div>

</form>

	<?php 
		}
		else if($_GET["action"] == 'edit')
		{
			$book_id = convert_data($_GET["code"], 'decrypt');

			if($book_id > 0)
			{
				$query = "
				SELECT * FROM lms_book 
                WHERE book_id = '$book_id'
				";

				$book_result = $connect->query($query);

				foreach($book_result as $book_row)
				{
	?>



    <div class="card mb-4">
    	<div class="card-header">
    		<i class="fas fa-user-plus"></i> Edit Book Details
       	</div>
       	<div class="card-body">
       		<form method="post">
       			<div class="row">
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">Book Name</label>
       						<input type="text" name="book_name" id="book_name" class="form-control" value="<?php echo $book_row['book_name']; ?>" />
       					</div>
       				</div>
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">Select Author</label>
       						<select name="book_author" id="book_author" class="form-control">
       							<?php echo fill_author($connect); ?>
       						</select>
       					</div>
       				</div>
       			</div>
       			<div class="row">
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">Select Category</label>
       						<select name="call_no" id="call_no" class="form-control">
       							<?php echo fill_category($connect); ?>
       						</select>
       					</div>
       				</div>
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">Select Location Rack</label>
       						<select name="acc_no" id="acc_no" class="form-control">
       							<?php echo fill_location_rack($connect); ?>
       						</select>
       					</div>
       				</div>
       			</div>
       			<div class="row">
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">Book ISBN Number</label>
       						<input type="text" name="publisher" id="publisher" class="form-control" value="<?php echo $book_row['publisher']; ?>" />
       					</div>
       				</div>
       				<div class="col-md-6">
       					<div class="mb-3">
       						<label class="form-label">No. of Copy</label>
       						<input type="number" name="book_no_of_copy" id="book_no_of_copy" class="form-control" step="1" value="<?php echo $book_row['book_no_of_copy']; ?>" />
       					</div>
       				</div>
       			</div>
       			<div class="mt-4 mb-3 text-center">
       				<input type="hidden" name="book_id" value="<?php echo $book_row['book_id']; ?>" />
       				<input type="submit" name="edit_book" class="btn btn-primary" value="Edit" />
       			</div>
       		</form>
       		<script>
       			document.getElementById('book_author').value = "<?php echo $book_row['book_author']; ?>";
       			document.getElementById('call_no').value = "<?php echo $book_row['call_no']; ?>";
       			document.getElementById('acc_no').value = "<?php echo $book_row['acc_no']; ?>";
       		</script>
       	</div>
   	</div>
	<?php
				}
			}
		}
	}
	else
	{	
	?>
	
	<?php 

	if(isset($_GET["msg"]))
	{
		if($_GET["msg"] == 'add')
		{
			echo '<script>alert("New Book Added ")</script>';
		}
		if($_GET['msg'] == 'edit')
		{
            echo '<script>alert("Book edited ")</script>';
		}
		if($_GET["msg"] == 'delete')
		{
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">One Book Deleted <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
		if($_GET['msg'] == 'enable')
		{
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Book Status Change to Enable <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
	}

	?>
	 
		
        	<table class="book-tab">
        			<tr class="tr"> 
        				<th class="th">Acc No.</th>
        				<th class="th">Call No.</th>
        				<th class="th">Book Name</th>
        				<th class="th">Author</th>
        				<th class="th">Publication</th>
        				<th class="th">No. of Copy</th>
        				<th class="th">Year</th>
						<th class="th">ISBN NO</th>
        				<th class="th">Price</th>
        				<th class="th">Page</th>
        				<th class="th">Action</th>
        			</tr>
        	
        		<?php 

        		if($statement->rowCount() > 0)
        		{
        			foreach($statement->fetchAll() as $row)
        			{
        				// $book_status = '';
        				// if($row['book_status'] == 'Enable')
        				// {
        				// 	$book_status = '<div class="badge bg-success">Enable</div>';
        				// }
        				// else
        				// {
        				// 	$book_status = '<div class="badge bg-danger">Disable</div>';
        				// }
        				echo '
        				<tr class="tr">
        					<td class="td">'.$row["acc_no"].'</td>
        					<td class="td">'.$row["call_no"].'</td>
        					<td class="td">'.$row["book_name"].'</td>
        					<td class="td">'.$row["book_author"].'</td>
        					<td class="td">'.$row["publisher"].'</td>
        					<td class="td">'.$row["book_no_of_copy"].'</td>
        					<td class="td">'.$row["year"].'</td>
							<td class="td">'.$row["book_isbn_number"].'</td>
        					<td class="td">'.$row["book_price"].'</td>
        					<td class="td">'.$row["page"].'</td>
        					<td class="td">
        						<a href="updatebook.php?an='.$row['acc_no'].'&cn='.$row['call_no'].'&bn='.$row['book_name'].'&ba='.$row['book_author'].'&pub='.$row['publisher'].'&nc='.$row['book_no_of_copy'].
								'&y='.$row['year'].'&isbn='.$row['book_isbn_number'].'&price='.$row['book_price'].'&page='.$row['page'].'">Edit</a>
                                <a href="deletebook.php?cn='.$row['call_no'].'">delete</a>
        					</td>
        				</tr>
        				';
        			}
        		}
        		else
        		{
        			echo '
        			<tr>
        				<td colspan="10" class="text-center">No Data Found</td>
        			</tr>
        			';
        		}

        		?>
        
        	</table>
    
    </div>
    <script>

    	function delete_data(code, status)
    	{
    		var new_status = 'Enable';
    		if(status == 'Enable')
    		{
    			new_status = 'Disable';
    		}

    		if(confirm("Are you sure you want to "+new_status+" this Category?"))
    		{
    			window.location.href = "book.php?action=delete&code="+code+"&status="+new_status+"";
    		}
    	}

		$(document).ready(function(){
    $('#search_text').keyup(function(){
        var txt=$(this).val();
        if(txt!=''){
            
        }
        else{
            $('#result').html('');
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{search:txt},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
    });
});

    </script>
    <?php 
	}
    ?>
</div>


<?php


        						// <a href="book.php?an='.$row['acc_no'].'&cn='.$row['call_no'].'&bn='.$row['book_name'].'&ba='.$row['book_author'].'&pub='.$row['publisher'].'&nc='.$row['book_no_of_copy'].
								// '&y='.$row['year'].'&isbn='.$row['book_isbn_number'].'&price='.$row['book_price'].'&page='.$row['page'].'">Edit</a>

?>
</body>
</html>