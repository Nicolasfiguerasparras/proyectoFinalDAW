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
    </style>
    <body>

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
            <a href="../../login/logout.php">Logout</a>
        </div>

        <div class="main">
            <h2>Please, select an option:</h2>
            <p><a href="create.php">Create client</a></p>
            <p><a href="modify.php">Modify client</a></p>
            <p><a href="overview.php">See all clients</a></p> <!-- Include search & delete on this option -->
        </div>
    </body>
</html>