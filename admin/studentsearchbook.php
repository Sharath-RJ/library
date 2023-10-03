<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="script.js"></script>
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

//book.php

include '../database_connection.php';

include '../function.php';


$message = '';

$error = '';




// if(isset($_GET["action"], $_GET["code"], $_GET["status"]) && $_GET["action"] == 'delete')
// {
// 	$book_id = $_GET["code"];
// 	$status = $_GET["status"];

// 	$data = array(
// 		//':book_status'		=>	$status,
// 		//':book_updated_on'	=>	get_date_time($connect),
// 		':book_id'			=>	$book_id
// 	);

// 	$query = "
// 	UPDATE lms_book 
//     SET book_status = :book_status, 
//     book_updated_on = :book_updated_on 
//     WHERE book_id = :book_id
// 	";

// 	$statement = $connect->prepare($query);

// 	$statement->execute($data);

// 	header('location:book.php?msg='.strtolower($status).'');
// }
	if(isset($_GET["msg"]))
	{
	
		if($_GET['msg'] == 'edit')
		{
            echo '<script>alert("Book edited Successfully")</script>';
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

$query = "
	SELECT * FROM lms_book 
    ORDER BY book_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();


// include '../head.php';

?>

     
        <div class="nav">
            <div class="logo">
                <i class="fa fa-book" style="color:white; font-size:40px"></i>

            </div>
            <div class="title">
                <h1>ALL BOOKS</h1>
            </div>
			 <div class="search">
                 <div class="body">
                <form action="fetch.php" method="post" class="search-bar">
                    <input type="search" name="search" pattern=".*\S.*" required >
                    <button class="search-btn" type="submit" name="submit">
                        <span>Search</span>
                    </button>
                </form>
            </div>
			 </div>

        </div>
        </div>
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
        					<td class="td" style="background-color:blue;color:white;">
        						
                                <a style="color:white;text-decoration:none;" href="viewfeedback.php?isbn='.$row['book_isbn_number'].'">view feedback</a>
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

  
    <script>
    function delete_data(code, status) {
        var new_status = 'Enable';
        if (status == 'Enable') {
            new_status = 'Disable';
        }

        if (confirm("Are you sure you want to " + new_status + " this Category?")) {
            window.location.href = "book.php?action=delete&code=" + code + "&status=" + new_status + "";
        }
    }

    $(document).ready(function() {
        $('#search_text').keyup(function() {
            var txt = $(this).val();
            if (txt != '') {

            } else {
                $('#result').html('');
                $.ajax({
                    url: "fetch.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            }
        });
    });
    </script>
    <?php 
	
    ?>
    </div>


    <?php


        						// <a href="book.php?an='.$row['acc_no'].'&cn='.$row['call_no'].'&bn='.$row['book_name'].'&ba='.$row['book_author'].'&pub='.$row['publisher'].'&nc='.$row['book_no_of_copy'].
								// '&y='.$row['year'].'&isbn='.$row['book_isbn_number'].'&price='.$row['book_price'].'&page='.$row['page'].'">Edit</a>

?>
</body>

</html>