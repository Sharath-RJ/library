<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    
    <link rel="stylesheet" href="issuebookstyles.css">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .book-tab {

        width: 100%;
        background-color: white;
        margin-left: auto;
        margin-right: auto;
    }

    .book-tab .td,
    .book-tab .th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .book-tab .tr:nth-child(even) {
        background-color: lightblue;
    }
  
    .book-tab .tr:hover {
        background-color: rgba(28, 28, 147, 0.278);
     
    }

    .book-tab .th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: blue;
        color: white;
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

$error = '';

if(isset($_POST["issue_book_button"]))
{
    $formdata = array();

    if(empty($_POST["book_id"]))
    {
        $error .= '<li>Book ISBN Number is required</li>';
    }
    else
    {
        $formdata['book_id'] = trim($_POST['book_id']);
    }

    if(empty($_POST["user_id"]))
    {
        $error .= '<li>User Unique Number is required</li>';
    }
    else
    {
        $formdata['user_id'] = trim($_POST['user_id']);
        $ut=$formdata['user_id'];
        $query = "
	          SELECT user_type FROM lms_user
	       where user_unique_id='$ut'
	          ";
	       $result = $connect->query($query);
	          foreach($result as $row)
	          {
		        $user_type = $row["user_type"];
	            }
    }

    if($error == ''&& $user_type='student')
    {
       
        //Check Book Available or Not

        $query = "
        SELECT * FROM lms_book 
        WHERE call_no = '".$formdata['book_id']."'
        ";

        $statement = $connect->prepare($query);

        $statement->execute();

        if($statement->rowCount() > 0)
        {
            foreach($statement->fetchAll() as $book_row)
            {
                //check book is available or not
                if($book_row['book_no_of_copy'] > 0)
                {
                    //Check User is exist

                    $query = "
                    SELECT user_id, user_status FROM lms_user 
                    WHERE user_unique_id = '".$formdata['user_id']."'
                    ";

                    $statement = $connect->prepare($query);

                    $statement->execute();

                    if($statement->rowCount() > 0)
                    {
                        foreach($statement->fetchAll() as $user_row)
                        {
                            if($user_row['user_status'] == 'Enable')
                            {
                                //Check User Total issue of Book

                                $book_issue_limit = get_book_issue_limit_per_user($connect);

                                $total_book_issue = get_total_book_issue_per_user($connect, $formdata['user_id']);

                                if($total_book_issue < $book_issue_limit)
                                {
                                    $total_book_issue_day = get_total_book_issue_day($connect);

                                    $today_date = get_date_time($connect);

                                    $expected_return_date = date('Y-m-d H:i:s', strtotime($today_date. ' + '.$total_book_issue_day.' days'));

                                    $data = array(
                                        ':book_id'      =>  $formdata['book_id'],
                                        ':user_id'      =>  $formdata['user_id'],
                                        ':issue_date_time'  =>  $today_date,
                                        ':expected_return_date' => $expected_return_date,
                                        ':return_date_time' =>  '',
                                        ':book_fines'       =>  0,
                                        ':book_issue_status'    =>  'Issue'
                                    );

                                    $query = "
                                    INSERT INTO lms_issue_book 
                                    (book_id, user_id, issue_date_time, expected_return_date, return_date_time, book_fines, book_issue_status) 
                                    VALUES (:book_id, :user_id, :issue_date_time, :expected_return_date, :return_date_time, :book_fines, :book_issue_status)
                                    ";

                                    $statement = $connect->prepare($query);

                                    $statement->execute($data);

                                    $query = "
                                    UPDATE lms_book 
                                    SET book_no_of_copy = book_no_of_copy - 1 
                             
                                    WHERE call_no = '".$formdata['book_id']."' 
                                    ";

                                    $connect->query($query);

                                    header('location:issue_book.php?msg=add');

                                }
                                else
                                {
                                    echo '<script>alert("User Has Already Reached Book Limit,Please return Pending book")</script>';
                                }
                            }
                            else
                            {
                                echo '<script>alert("Account is Disabled,Contact Admin")</script>';
                            }
                        }
                    }
                    else
                    {
                      echo '<script>alert("Member Not Found")</script>';
                    }
                }
                else
                {
                   echo '<script>alert("Book Not Available")</script>';
                }
            }
        }
        else
        {
          echo '<script>alert("Book Not Found")</script>';
        }
    }
    else if($error == ''&& $user_type='staff')
      {
       
        //Check Book Available or Not

        $query = "
        SELECT * FROM lms_book 
        WHERE call_no = '".$formdata['book_id']."'
        ";

        $statement = $connect->prepare($query);

        $statement->execute();

        if($statement->rowCount() > 0)
        {
            foreach($statement->fetchAll() as $book_row)
            {
                //check book is available or not
                if($book_row['book_no_of_copy'] > 0)
                {
                    //Check User is exist

                    $query = "
                    SELECT user_id, user_status FROM lms_user 
                    WHERE user_unique_id = '".$formdata['user_id']."'
                    ";

                    $statement = $connect->prepare($query);

                    $statement->execute();

                    if($statement->rowCount() > 0)
                    {
                        foreach($statement->fetchAll() as $user_row)
                        {
                            if($user_row['user_status'] == 'Enable')
                            {
                                //Check User Total issue of Book

                                $book_issue_limit = get_book_issue_limit_per_staff($connect);

                                $total_book_issue = get_total_book_issue_per_user($connect, $formdata['user_id']);

                                if($total_book_issue < $book_issue_limit)
                                {
                                    $total_book_issue_day = get_total_book_issue_day_staff($connect);

                                    $today_date = get_date_time($connect);

                                    $expected_return_date = date('Y-m-d H:i:s', strtotime($today_date. ' + '.$total_book_issue_day.' days'));

                                    $data = array(
                                        ':book_id'      =>  $formdata['book_id'],
                                        ':user_id'      =>  $formdata['user_id'],
                                        ':issue_date_time'  =>  $today_date,
                                        ':expected_return_date' => $expected_return_date,
                                        ':return_date_time' =>  '',
                                        ':book_fines'       =>  0,
                                        ':book_issue_status'    =>  'Issue'
                                    );

                                    $query = "
                                    INSERT INTO lms_issue_book 
                                    (book_id, user_id, issue_date_time, expected_return_date, return_date_time, book_fines, book_issue_status) 
                                    VALUES (:book_id, :user_id, :issue_date_time, :expected_return_date, :return_date_time, :book_fines, :book_issue_status)
                                    ";

                                    $statement = $connect->prepare($query);

                                    $statement->execute($data);

                                    $query = "
                                    UPDATE lms_book 
                                    SET book_no_of_copy = book_no_of_copy - 1 
                             
                                    WHERE call_no = '".$formdata['book_id']."' 
                                    ";

                                    $connect->query($query);

                                    header('location:issue_book.php?msg=add');
                                }
                                else
                                {
                                    $error .= 'User has already reached Book Issue Limit, First return pending book';
                                }
                            }
                            else
                            {
                                $error .= '<li>User Account is Disable, Contact Admin</li>';
                            }
                        }
                    }
                    else
                    {
                        $error .= '<li>User not Found</li>';
                    }
                }
                else
                {
                    $error .= '<li>Book not Available</li>';
                }
            }
        }
        else
        {
            $error .= '<li>Book not Found</li>';
        }
    }







}

if(isset($_POST["book_return_button"]))
{
    if(isset($_POST["book_return_confirmation"]))
    {
        $data = array(
            ':return_date_time'     =>  get_date_time($connect),
            ':book_issue_status'    =>  'Return',
            ':issue_book_id'        =>  $_POST['issue_book_id']
        );  

        $query = "
        UPDATE lms_issue_book 
        SET return_date_time = :return_date_time, 
        book_issue_status = :book_issue_status 
        WHERE issue_book_id = :issue_book_id
        ";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        $query = "
        UPDATE lms_book 
        SET book_no_of_copy = book_no_of_copy + 1 
        WHERE call_no = '".$_POST["call_no"]."'
        ";

        $connect->query($query);

        header("location:issue_book.php?msg=return");
    }
    else
    {
        
        echo '<script>alert("Please first confirm return book received by click on checkbox")</script>';
    }
}   

$query = "
	SELECT * FROM lms_issue_book 
    ORDER BY issue_book_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

 //include '../header.php';

?>
    <div class="container-fluid py-4" style="min-height: 700px;">
        <!-- <h1>Issue Book Management</h1> -->
        <?php 

    if(isset($_GET["action"]))
    {
        if($_GET["action"] == 'add')
        {
    ?>
        <!-- <ol class="breadcrumb mt-4 mb-4 bg-light p-2 border">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="issue_book.php">Issue Book Management</a></li>
        <li class="breadcrumb-item active">Issue New Book</li>
    </ol> -->
        <div class="row">
            <div class="col-md-6">
                <?php 
            if($error != '')
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="list-unstyled">'.$error.'</ul> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
            ?>
                <!-- <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user-plus"></i> Issue New Book
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Book ISBN Number</label>
                            <input type="text" name="book_id" id="book_id" class="form-control" />
                            <span id="book_isbn_result"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User Unique ID</label>
                            <input type="text" name="user_id" id="user_id" class="form-control" />
                            <span id="user_unique_id_result"></span>
                        </div>
                        <div class="mt-4 mb-0">
                            <input type="submit" name="issue_book_button" class="btn btn-success" value="Issue" />
                        </div>  
                    </form> -->


                <div class="nav">
                    <div class="logo">
                        <i class="fa fa-book" style="font-size:40px;color:white"></i>
                        <i class='fas fa-arrow-right' style='font-size:40px;color:white'></i>

                    </div>
                    <div class="title">
                        <h1>ISSUE BOOK</h1>
                    </div>

                </div>
                <form method="post">
                    <div class="con">
                    <div class="main-container-issuebook">
                        <div class="book-issue-image">
                            <img src="handover.png" alt="" srcset="" class="handover">
                        </div>


                        <div class="container-of-issuebook">
                            <div class="inputbox">
                                <input type="text" required name="book_id">
                                <span style="color:white">Call No</span>
                            </div>
                            <div class="inputbox">
                                <div class="inputbox">
                                    <input type="text" required name="user_id">
                                    <span style="color:white">Student ID </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                   
                    <div class="container-issuebook-btn">
                        <button class="button_slide slide_right"
                     type="submit" name="issue_book_button">ISSUE BOOK </button>
                    </div>
                </form>

                <span id="user_unique_id_result"></span>


                <script>
                var book_id = document.getElementById('book_id');

                book_id.onkeyup = function() {
                    if (this.value.length > 2) {
                        var form_data = new FormData();

                        form_data.append('action', 'search_book_isbn');

                        form_data.append('request', this.value);

                        fetch('action.php', {
                            method: "POST",
                            body: form_data
                        }).then(function(response) {
                            return response.json();
                        }).then(function(responseData) {
                            var html = '<div class="list-group" style="position:absolute; width:93%">';

                            if (responseData.length > 0) {
                                for (var count = 0; count < responseData.length; count++) {
                                    html +=
                                        '<a href="#" class="list-group-item list-group-item-action"><span onclick="get_text(this)">' +
                                        responseData[count].isbn_no +
                                        '</span> - <span class="text-muted">' + responseData[count]
                                        .book_name + '</span></a>';
                                }
                            } else {
                                html +=
                                    '<a href="#" class="list-group-item list-group-item-action">No Book Found</a>';
                            }

                            html += '</div>';

                            document.getElementById('book_isbn_result').innerHTML = html;
                        });
                    } else {
                        document.getElementById('book_isbn_result').innerHTML = '';
                    }
                }

                function get_text(event) {
                    document.getElementById('book_isbn_result').innerHTML = '';

                    document.getElementById('book_id').value = event.textContent;
                }

                var user_id = document.getElementById('user_id');

                user_id.onkeyup = function() {
                    if (this.value.length > 2) {
                        var form_data = new FormData();

                        form_data.append('action', 'search_user_id');

                        form_data.append('request', this.value);

                        fetch('action.php', {
                            method: "POST",
                            body: form_data
                        }).then(function(response) {
                            return response.json();
                        }).then(function(responseData) {
                            var html = '<div class="list-group" style="position:absolute;width:93%">';

                            if (responseData.length > 0) {
                                for (var count = 0; count < responseData.length; count++) {
                                    html +=
                                        '<a href="#" class="list-group-item list-group-item-action"><span onclick="get_text1(this)">' +
                                        responseData[count].user_unique_id +
                                        '</span> - <span class="text-muted">' + responseData[count]
                                        .user_name + '</span></a>';
                                }
                            } else {
                                html +=
                                    '<a href="#" class="list-group-item list-group-item-action">No User Found</a>';
                            }
                            html += '</div>';

                            document.getElementById('user_unique_id_result').innerHTML = html;
                        });
                    } else {
                        document.getElementById('user_unique_id_result').innerHTML = '';
                    }
                }

                function get_text1(event) {
                    document.getElementById('user_unique_id_result').innerHTML = '';

                    document.getElementById('user_id').value = event.textContent;
                }
                </script>
            </div>
        </div>
    </div>
    </div>
    <?php 
        }
        else if($_GET["action"] == 'view')
        {
            $issue_book_id = convert_data($_GET["code"], 'decrypt');

            if($issue_book_id > 0)
            {
                $query = "
                SELECT * FROM lms_issue_book 
                WHERE issue_book_id = '$issue_book_id'
                ";

                $result = $connect->query($query);

                foreach($result as $row)
                {
                    $query = "
                    SELECT * FROM lms_book 
                    WHERE call_no = '".$row["book_id"]."'
                    ";

                    $book_result = $connect->query($query);

                    $query = "
                    SELECT * FROM lms_user 
                    WHERE user_unique_id = '".$row["user_id"]."'
                    ";

                    $user_result = $connect->query($query);

                    if($error != '')
                    {
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                    echo'  <div class="body-container">';
                    foreach($user_result as $user_data)
                    {
                        echo '
                      <div class="member-container">
            <div class="profile-container">
                <div class="profile-pic-container">
                      <img src="'.base_url().'upload/' . $user_data["user_profile"].'" class="img-thumbnail" width="100" />
                </div>
            </div>
            <div class="mem-details">
                <h2>'.$user_data["user_unique_id"].'</h2>
            </div>
            <div class="mem-details">
                <h2>'.$user_data["user_name"].'</h2>
            </div>
            <div class="mem-details">
                <h3>'.$user_data["user_email_address"].'</h3>
            </div>
            <div class="mem-details">
                <h3>'.$user_data["user_contact_no"].'</h3>
            </div>
            <div class="mem-details" style="margin-top: 100px;">
                <h3>'.$user_data["option"].'</h3>
            </div>
            <div class="mem-details">
                <h3>2020-2023</h3>
            </div>
        </div>
          
                        ';
                    }
                    echo '  <div class="book-details-main-container">';
                    foreach($book_result as $book_data)
                    {
                        echo '
                         <div class="book-details">
                <table class="book-details-table">
                    <tr>
                        <th colspan="2">
                            <h2>Book Details</h2>
                        </th>
                    </tr>
                    <tr>
                        <td>Book Name</td>
                        <td>'.$book_data["book_name"].'</td>
                    </tr>
                    <tr>
                        <td>Book Author</td>
                        <td>'.$book_data["book_author"].'</td>
                    </tr>
                    <tr>
                        <td>ISBN Number</td>
                        <td>'.$book_data["call_no"].'</td>
                    </tr>
                    <tr>
                        <td>Publish</td>
                        <td>'.$book_data["publisher"].'</td>
                    </tr>
                </table>
            </div>
                
                    
                        ';
                    }

                    $status = $row["book_issue_status"];

                    $form_item = '';

                    if($status == "Issue")
                    {
                        $status = '<span style="background-color:blue; color:white;">Issue</span>';

                        $form_item = '

                        <div class="aknowledge">
                        <label><input type="checkbox" name="book_return_confirmation" value="Yes" /> I aknowledge that I have received Issued Book</label>
                        </div>
                        <br />
                        <div>
                            <input type="submit" name="book_return_button" value="Book Return" class="book_return_btn" />
                        </div>
                        ';
                    }

                    if($status == 'Not Return')
                    {
                        $status = '<span style="background-color:red; color:white;">Not Return</span>';

                        $form_item = '
                        <div class="aknowledge">
                       <label><input type="checkbox" name="book_return_confirmation" value="Yes" /> I aknowledge that I have received Issued Book</label><br />
                       </div>
                        <div>
                            <input type="submit" name="book_return_button" value="Book Return" class="book_return_btn" />
                        </div>
                        ';
                    }

                    if($status == 'Return')
                    {
                        $status = '<span style="background-color:green; color:white;">Return</span>';
                    }

                    echo '
                   <div class="issuebook-details">
            <table class="issued-book-table">
                <tr>
                    <th colspan="2">
                        <h2>Issued Book Details</h2>
                    </th>
                </tr>
                <tr>
                    <td>Book Issued Date</td>
                    <td>'.$row["issue_date_time"].'</td>
                </tr>
                <tr>
                    <td>Book Return Date</td>
                    <td>'.$row['return_date_time'].'</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>'.$status.'</td>
                </tr>
                <tr>
                    <td>Total Fines</td>
                    <td>'.$row["book_fines"].'</td>
                </tr>
            </table>
            </div>
                    <form method="POST">
                        <input type="hidden" name="issue_book_id" value="'.$issue_book_id.'" />
                        <input type="hidden" name="call_no" value="'.$row["book_id"].'" />
                        '.$form_item.'
                    </form>
                    <br />
                    ';

                }
            }
        }
    }
    else
    {
    ?>
    <!-- <ol class="breadcrumb mt-4 mb-4 bg-light p-2 border">
		<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Issue Book Management</li>
    </ol> -->

    <?php 
    if(isset($_GET['msg']))
    {
        if($_GET['msg'] == 'add')
        {
            echo '<script>alert("New Book Issued Successfully")</script>';
        }

        if($_GET["msg"] == 'return')
        {
         echo '<script>alert("Issued Book Successfully Returned to the library")</script>';

        }
    }
    ?>
    <!-- 
     <div class="card mb-4">
    	<div class="card-header">
    		<div class="row">
    			<div class="col col-md-6">
    				<i class="fas fa-table me-1"></i> 
                </div>
                <div class="col col-md-6" align="right">
                    <a href="issue_book.php?action=add" class="btn btn-success btn-sm">Add</a>
                </div>
            </div>
        </div> -->

    <div class="nav">
        <div class="logo">
            <i class='fas fa-arrow-left' style='font-size:40px;color:white'></i>
            <i class="fa fa-book" style="font-size:40px;color:white"></i>


        </div>
        <div class="title">
            <h1>RETURN BOOK</h1>
        </div>
        <div class="search">
            <div class="body">
                <form action="fetch_issued_book.php" method="post" class="search-bar">
                    <input type="search" name="search" pattern=".*\S.*" required autocomplete >
                    <button class="search-btn" type="submit" name="submit">
                        <span>Search</span>
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
                <th class="th">Return Date</th>
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
        					<td class="td">'.$row["return_date_time"].'</td>
        					<td class="td">'.$row["book_fines"].'</td>
        					<td class="td">'.$status.'</td>
        					<td class="td" style="background-color:blue;">
                                <a style="color:white;text-decoration:none;" href="issue_book.php?action=view&code='.convert_data($row["issue_book_id"]).'" class="btn btn-info btn-sm">View</a>
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
    }
    ?>
    </div>

    <?php 

// include '../footer.php';

?>
</body>

</html>
<!-- <tr class="tr">
                                <th width="30%" class="th">Book ISBN Number</th>
                                 <th width="30%" class="th">Book Title</th>
                                 <th width="30%" class="th">Author</th>
                
                            </tr>
                        
                            <tr class="tr">
                               
                                 <td width="70%" class="td">'.$book_data["call_no"].'</td>
                                 <td width="70%" class="td">'.$book_data["book_name"].'</td>
                                <td width="70%" class="td">'.$book_data["book_author"].'</td>
                            </tr> -->

<!-- <td width="70%"><img src="'.base_url().'upload/' . $user_data["user_profile"].'" class="img-thumbnail" width="100" /></td> -->