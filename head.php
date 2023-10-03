<?php

//header.php

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Emmanuel College</title>
        <link rel="canonical" href="">
         <link rel="stylesheet" href="select2.min.css">
        <link rel="stylesheet" href="simple-datatables-style.css">
        <link rel="stylesheet" href="styles.css"> 
         <link rel="stylesheet" href="vanillaSelectBox.css">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="main.css">
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>asset/css/simple-datatables-style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>asset/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>asset/js/font-awesome-5-all.min.js" crossorigin="anonymous"></script>
        <!-- Favicons -->
        <link rel="apple-touch-icon" href="" sizes="180x180">
        <link rel="icon" href="" sizes="32x32" type="image/png">
        <link rel="icon" href="" sizes="16x16" type="image/png">
        <link rel="manifest" href="">
        <link rel="mask-icon" href="" color="#7952b3">
        <link rel="icon" href="">
        <meta name="theme-color" content="#7952b3">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    </head>

    <?php 

    if(is_admin_login())
    {

    ?>
    <body class="sb-nav-fixed">

          <nav>
        <img src="images/logo_fixed.png" alt="logo">
        <h1>EMMANUEL COLLEGE OF B.Ed TRAINING</h1>
        <ul>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
 

     
        

        <div class="side-bar-menu">
   <div class="menu-list">
    <div class="list-item">
    <h2>Dashboard</h2>
   </div>
   <div class="list-item">
    <a href="admin\book.php"><h2>Books</h2></a>
   </div>
   <div class="list-item">
    <h2>Issue Books</h2>
   </div>
   <div class="list-item">
    <h2>Register user</h2>
   </div>
   <div class="list-item">
    <h2>Log Out</h2>
   </div>
   </div>
</div>
                <main>


    <?php 
    }
    else
    {

    ?>

    <body>

    	<main>

    		<div class="container py-4">

    			<header class="pb-3 mb-4 border-bottom">
                    <div class="row">
        				<div class="col-md-6">
                            <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
                                <span class="fs-4">Library Management System</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <?php 

                            if(is_user_login())
                            {
                            ?>
                            <ul class="list-inline mt-4 float-end">
                                <li class="list-inline-item"><?php echo $_SESSION['user_id']; ?></li>
                                <li class="list-inline-item"><a href="issue_book_details.php">Issue Book</a></li>
                                <li class="list-inline-item"><a href="search_book.php">Search Book</a></li>
                                <li class="list-inline-item"><a href="profile.php">Profile</a></li>
                                <li class="list-inline-item"><a href="logout.php">Logout</a></li>
                            </ul>
                            <?php 
                            }

                            ?>
                        </div>
                    </div>

    			</header>
    <?php 
    }
    ?>
    			