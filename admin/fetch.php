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
?>
<div>
    <table>
        <?php
   if(isset($_POST['submit']))
   {
    $search=$_POST['search'];
    $sql="SELECT * from lms_book where book_name='$search' or
    acc_no ='$search' or call_no='$search' or book_author='$search'or
    publisher='$search' or book_no_of_copy='$search' or year='$search'";
   $statement = $connect->prepare($sql);

   $result=$statement->execute();
    if($result)
    {
       if($statement->rowCount()>0)
       {
         echo '<table class="book-tab">
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
            
         ';
         foreach($statement->fetchAll() as $row)
        			{
        				
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
        						<a href="updatebook.php?an='.$row['acc_no'].'&cn='.$row['call_no'].'&bn='.$row['book_name'].'&ba='.$row['book_author'].'&pub='.$row['publisher'].'&nc='.$row['book_no_of_copy'].'&y='.$row['year'].'">Edit</a>
                                <a href="deletebook.php?cn='.$row['call_no'].'">delete</a>
        					</td>
        				</tr>
        				';
        			}
       }
       else{
        echo "No data found";
       }
    }
    else{
        echo "data not found";
    }

   }
        ?>
    </table>
</div>

</body>
</html>