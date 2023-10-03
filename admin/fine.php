<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="search.css">
 <link rel="stylesheet" href="admins.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
 <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
 <script>
	
 </script>
    <style>
		
.tooltip {
  position: relative;
  display: inline-block;
  cursor: default;
}

.tooltip .tooltiptext {
  visibility: hidden;
  padding: 0.25em 0.5em;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 0.25em;
  white-space: nowrap;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 100%;
  transition-property: visibility;
  transition-delay: 0s;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  transition-delay: 0.3s;
}
        .book-tab {

  width: 100%;
  background-color:white;
  margin-left: auto;
  margin-right: auto;
}

.book-tab .td, .book-tab .th {
  border: 1px solid #ddd;
  padding: 8px;
}

.book-tab .tr:nth-child(even){background-color:lightblue;}

.book-tab .tr:hover {background-color:rgba(28, 28, 147, 0.278);}

.book-tab .th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:blue;
  color: white;
}
.hide{
	display:none;
}
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
    <title>Document</title>
</head>
<body>
   <?php

//issue_book.php

include '../database_connection.php';

include '../function.php';

if(!is_admin_login())
{
	header('location:../admin_login.php');
}


  

$query = "
	SELECT * FROM lms_issue_book 
     where book_fines>0
";

$statement = $connect->prepare($query);

$statement->execute();

 //include '../header.php';

?>


    <?php 
if(isset($_GET["msg"]))
	{
		if($_GET["msg"] == 'paid')
		{
			echo '<script>alert("Fine Paid Successfully")</script>';
		}
    }
    ?>

	
  
  
  <!-- <form action="fetch_issued_book.php" method="post">
		<input type="text" name="search" id="" placeholder="Search" >
		<button name="submit">Search</button>
	</form> -->
    

	      <div class="nav">
            <div class="logo">
               <i class='fas fa-rupee-sign' style="font-size:40px;color:white;"></i>

            </div>
            <div class="title">
                <h1>PAY FINE</h1>
            </div>
			 <div class="search">
                 <div class="body">
                <form action="fetch_fine.php" method="post" class="search-bar">
				   <label for="" class="hide">Membership Number</label>
                    <input type="search" name="search" pattern=".*\S.*" required >
                    <button class="search-btn tooltip" type="submit" name="submit" >
                        <span class="tooltiptext">Search</span>
                    </button>
                </form>
            </div>
			 </div>

        </div>
        <div class="card-body">
        	<table id="datatablesSimple" class="book-tab">
        		
        			<tr class="tr">
        				<th class="th">Book ISBN Number</th>
                        <th class="th">Membership Number</th>
                        <th class="th">Issue Date</th>
                        <!-- <th class="th">Return Date</th> -->
                        <th class="th">Late Return Fines</th>
                        <th class="th">Status</th>
                        <th class="th">Action</th>
        			</tr>
        	
        	
        		<tbody>
        		<?php
        		if($statement->rowCount() > 0)
        		{
        			$one_day_fine = get_one_day_fines($connect);

        		

        			

        			foreach($statement->fetchAll() as $row)
        			{
        				$status = $row["book_issue_status"];

        				$book_fines = $row["book_fines"];

        				if($row["book_issue_status"] == "Issue")
        				{
        					$current_date_time = new DateTime(get_date_time($connect));
        					$expected_return_date = new DateTime($row["expected_return_date"]);

        					if($current_date_time > $expected_return_date)
        					{
        						$interval = $current_date_time->diff($expected_return_date);

        						$total_day = $interval->d;

        						$book_fines = $total_day * $one_day_fine;

        						$status = 'Not Return';

        						$query = "
        						UPDATE lms_issue_book 
													SET book_fines = '".$book_fines."', 
													book_issue_status = '".$status."' 
													WHERE issue_book_id = '".$row["issue_book_id"]."'
        						";

        						$connect->query($query);
        					}
        				}

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
        					<td class="td">'.$row["book_id"].'</td>
        					<td class="td">'.$row["user_id"].'</td>
        					<td class="td">'.$row["issue_date_time"].'</td>
        				
        				    <td class="td">'.$book_fines.'</td>
        					<td class="td">'.$status.'</td>
        					<td class="td" style="background-color:blue;">
                            <a style="color:white;text-decoration:none;" href="payfine.php?code='.$row["issue_book_id"].'&fine='.$row["book_fines"].'" class="btn btn-info btn-sm">Pay Fine</a>
                            </td>
        				</tr>
        				';
        			}
        		}
        		else
        		{
        			echo '
        			<tr>
        				<td colspan="7" class="text-center">No Data Found</td>
        			</tr>
        			';
        		}
        		?>
        		</tbody>
        	</table>
        </div>
    </div>
    <?php 
    
    ?>
</div>

<?php 

// include '../footer.php';

?> 
</body>
</html>
  