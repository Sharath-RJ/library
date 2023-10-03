<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminss.css">
</head>
<body>
<?php
include '../database_connection.php';
include '../function.php';
?>
<div>
    <table>
        <?php
   if(isset($_POST['submit']))
   {
    $search=$_POST['search'];
    $sql="SELECT * from lms_issue_book where book_id='$search' or
    user_id ='$search'";
   $statement = $connect->prepare($sql);

   $result=$statement->execute();
    if($result)
    {
       if($statement->rowCount()>0)
       {
         echo '<table class="book-tab">
        	<tr class="tr"> 
        				<th class="th">Book ISBN Number</th>
                        <th class="th">Membership Number</th>
                        <th class="th">Issue Date</th>
                     
                        <th class="th">Late Return Fines</th>
                        <th class="th">Status</th>
                        <th class="th">Action</th>
        			</tr>
            
         ';
         foreach($statement->fetchAll() as $row)
        			{
                        $status = $row["book_issue_status"];
                        
        				$book_fines = $row["book_fines"];
        				
        				echo '
        					<tr class="tr">
        					<td class="td">'.$row["book_id"].'</td>
        					<td class="td">'.$row["user_id"].'</td>
        					<td class="td">'.$row["issue_date_time"].'</td>
        					
        					<td class="td">'.$book_fines.'</td>
        					<td class="td">'.$status.'</td>
        					<td class="td">
                                 <a href="payfine.php?code='.$row["issue_book_id"].'&fine='.$row["book_fines"].'" class="btn btn-info btn-sm">Pay Fine</a>
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