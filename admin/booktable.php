<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php
include '../database_connection.php';
$query = "
	SELECT * FROM lms_book 
    ORDER BY book_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();
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
    
?>
</body>
</html>