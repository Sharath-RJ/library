<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homestyle.css">
    <style>
    @media screen and (max-width:992px) {


        .res-container {
            display: flex;
            width: 500px;
            background-color: transparent;
            justify-content: space-evenly;

        }

        .menu-box-sub {
            display: block;
            justify-content: space-evenly;
        }
        .menu-box{
            display:flex;
            justify-content:space-evenly;
            background-color:transparent;
            border:none;
        }
        .nav-menu{
            display:none;
        }
        .nav-title{
            font-size:15px;
            font-weight:500;
        }
    }
    </style>

</head>

<body>
    <div class="main-body">
        <nav>
            <img src="images/logo_fixed.png" alt="logo">
            <h1 class="nav-title">EMMANUEL COLLEGE OF B.Ed TRAINING</h1>
            <ul class="nav-menu">
                <li><a href="#">Profile</a></li>
                <li><a href="admin\setting.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>


        <div class="menu-box">
            <div class="menu-box-sub">
            
                    <a href="admin\index.php">
                        <div class="menu">
                            <img src="images/icons8-dashboard-layout-48.png" alt="" style="width:80px">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="admin\book.php?action=add">
                        <div class="menu">
                            <img src="images/add.png" alt="" style="width:80px">
                            <h2>Add Book</h2>
                        </div>
                    </a>
                

                
                    <a href="admin\allbooks.php">
                        <div class="menu">
                            <img src="images/execution.png" alt="" style="width:80px">
                            <h2>Book Management</h2>
                        </div>
                    </a>
                    <a href="admin/issue_book.php?action=add">
                        <div class="menu">
                            <img src="images/book.png" alt="" style="width:80px">
                            <h2>Issue Book</h2>
                        </div>
                    </a>
                
            </div>


            <div class="menu-box-sub">
                
                    <a href="admin/issue_book.php">
                        <div class="menu">
                            <img src="images/hand-over (1).png" alt="" style="width:80px">
                            <h2>Return Book</h2>
                        </div>
                    </a>
                    <a href="admin/student.php">
                        <div class="menu">
                            <img src="images/add (1).png" alt="" style="width:80px">
                            <h2>Add Members</h2>
                        </div>
                    </a>
            

                
                    <a href="admin/user.php">
                        <div class="menu">
                            <img src="images/project-management.png" alt="" style="width:80px">
                            <h2>Member Management</h2>
                        </div>
                    </a>
                    <a href="admin\fine.php">
                        <div class="menu">
                            <img src="images/search.png" alt="" style="width:80px">
                            <h2>Pay Fine</h2>
                        </div>
                    </a>
                
            </div>
        </div>
    </div>
</body>

</html>