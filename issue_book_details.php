<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="admin\admin.css">
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

//issue_book_details.php

include 'database_connection.php';

include 'function.php';

if(!is_user_login())
{
	header('location:user_login.php');
}

$query = "
	SELECT * FROM lms_issue_book 
	INNER JOIN lms_book 
	ON lms_book.call_no = lms_issue_book.book_id 
	WHERE lms_issue_book.user_id = '".$_SESSION['user_id']."' 
	ORDER BY lms_issue_book.issue_book_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();
$user_id=$_SESSION['user_id'];


//include 'header.php';

?>

    <div class="nav">
                    <div class="logo">
                        <i class="fa fa-book" style="font-size:40px;color:white"></i>
                        <i class='fas fa-arrow-right' style='font-size:40px;color:white'></i>

                    </div>
                    <div class="title">
                        <h1>ISSUED BOOK DETAILS</h1>
                    </div>

    </div>





		<div class="card-body">
			<table class="book-tab">
			
					<tr class="tr">
						<th class="th">Book ISBN No.</th>
						<th  class="th">Book Name</th>
						<th  class="th">Issue Date</th>
						<th  class="th">Return Date</th>
						<th  class="th">Fines</th>
						<th  class="th">Status</th>
						<th  class="th">Action</th>
					</tr>
			
			
				<?php 
				if($statement->rowCount() > 0)
				{
					foreach($statement->fetchAll() as $row)
					{
				
						$status = $row["book_issue_status"];
						if($status == 'Issue')
						{
							$status = '<span class="badge bg-warning">Issue</span>';
						}

						if($status == 'Not Return')
						{
							$status = '<span class="badge bg-danger">Not Return</span>';
						}

						if($status == 'Return')
						{
							$status = '<span class="badge bg-primary">Return</span>';
						}
					

						echo '
						<tr class="tr">
							<td class="td">'.$row["book_isbn_number"].'</td>
							<td class="td">'.$row["book_name"].'</td>
							<td class="td">'.$row["issue_date_time"].'</td>
							<td class="td">'.$row["return_date_time"].'</td>
							<td class="td">'.$row["book_fines"].'</td>
							<td class="td">'.$status.'</td>
							<td class="td"><a href="review.php?id='.$row["book_isbn_number"].'&u_id='.$user_id.'">Review</a></td>
						</tr>
						';
					}
				}
				else{
					echo "no book issued";
				}
				?> 
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>