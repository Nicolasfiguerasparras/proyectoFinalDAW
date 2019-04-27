<!--Extract session-->
    <?php
        session_start();
    ?>
<!--/Extract session-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Personal area</title>
    </head>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 160px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .main {
            margin-left: 160px; /* Same as the width of the sidenav */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }

        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }


    </style>
    <body>

        <!-- Establish connection with DB -->
            <?php
                // Establish connection
                include('../../../connectDB.php');
                $db = connectDb();
                $id = collectID($db, 'clients');
            ?>
        <!-- /Establish connection with DB -->

        <!--NavBar-->
            <?php
                if(isset($_SESSION['user'])){
                    if(!$_SESSION['user']=='admin'){
                        header("location: ../../notAllowed.php");
                    }
                }else{
                    header("location: ../../notAllowed.php");
                }
            ?>
        <!--/NavBar-->

        <div class="sidenav">
            <a href="../index.php">Index</a>
            <a href="#about">Workers</a>
            <a href="#services">Lawers</a>
            <a href="#">Tasks</a>
            <a href="index.php">Clients</a>
            <a href="../../../login/logout.php">Logout</a>
        </div>



        <div class="main">
            <h2 style="text-align:center">Create client</h2>
            <form action="create.php" method="post">
                <div style="display:flex">
                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="ID">ID</label>
                        <input type="text" id="ID" name="ID" placeholder="<?php echo $id ?>" disabled>
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="name">First name</label>
                        <input type="text" id="name" name="name">
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="surname">Last name</label>
                        <input type="text" id="surname" name="surname">
                    </div>
                </div>

                <div style="display:flex">
                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="birth_date">Birth date</label>
                        <input type="text" id="birth_date" name="birth_date">
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone">
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email">
                    </div>
                </div>

                <div style="display:flex">
                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="username">username</label>
                        <input type="text" id="username" name="username">
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password">
                    </div>

                    <div style="display:flex; flex-direction:column; width:33%">
                        <label for="bill">Bill</label>
                        <input type="text" id="bill" name="bill">
                    </div>
                </div>

                <label for="case_ID">Case ID</label>
                <input type="text" id="case_ID" name="case_ID">

                <input type="submit" value="Submit" name="submit">
            </form>
        </div>

        <!-- Close DB connection -->
            <?php
                mysqli_close($db);
            ?>
        <!-- /Close DB connection -->
  </body>
</html>