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

        .createFormDiv{
            margin: 10px;
            border: 2px solid green;
            border-radius: 5px;
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

        <!-- Create form action -->
            <?php
                if(isset($_POST['create'])){
                    $name = $_POST['name'];
	                $surname = $_POST['surname'];
	                $birth_date = $_POST['birth_date'];
	                $phone = $_POST['phone'];
	                $email = $_POST['email'];
	                $username = $_POST['username'];
	                $password = $_POST['password'];
	                $bill = $_POST['bill'];
	                $createQuery = mysqli_query($db, "INSERT INTO clients (client_ID, name, surname, birth_date, phone, email, username, password, case_ID, bill) VALUES ('null', '$name', '$surname', '$birth_date', $phone, '$email', '$username', '$password', '0', '$bill')") or die(mysqli_error($db));
                }
            ?>
        <!-- /Create form action -->

        <div class="main">
            <div class="createFormDiv">
                <form action="index.php" method="post">
                    <input type="text" id="ID" name="ID" placeholder="<?php echo $id ?>" style="display:none" disabled>

                    <label for="name">First name</label>
                    <input type="text" id="name" name="name">

                    <label for="surname">Last name</label>
                    <input type="text" id="surname" name="surname">

                    <label for="birth_date">Birth date</label>
                    <input type="date" id="birth_date" name="birth_date">

                    <br>

                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone">

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">

                    <br>

                    <label for="password">Password</label>
                    <input type="text" id="password" name="password">

                    <label for="bill">Bill</label>
                    <input type="text" id="bill" name="bill">

                    <input type="submit" value="Submit" name="create">
                </form>
            </div>

            <div class="clientList">
                <?php
                    $listQuery = mysqli_query($db, "SELECT * FROM clients");

	                if($row = mysqli_fetch_array($listQuery)){
                        echo "<table>";

                            echo "<tr>";
                                echo "<td>ID</td>";
                                echo "<td>Name</td>";
                                echo "<td>Surname</td>";
                                echo "<td>Birth Date</td>";
                                echo "<td>Phone</td>";
                                echo "<td>Email</td>";
                                echo "<td>Username</td>";
                                echo "<td>Password</td>";
                                echo "<td>Case ID</td>";
                                echo "<td>Bill</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td></td>";
                            echo "</tr>";


                            do{
                                echo "<tr>";
                                    $listID=$row['client_ID'];
                                    echo "<td>".$listID."</td>";
                                    echo "<td>".$row["name"]."</td>";
                                    echo "<td>".$row["surname"]."</td>";
                                    $bDateFormatted = date("d-m-Y", strtotime($row["birth_date"]));   
                                    echo "<td>".$bDateFormatted."</td>";
                                    echo "<td>".$row["phone"]."</td>";
                                    echo "<td>".$row["email"]."</td>";
                                    echo "<td>".$row["username"]."</td>";
                                    echo "<td>".$row["password"]."</td>";
                                    echo "<td>".$row["case_ID"]."</td>";
                                    echo "<td>".$row["bill"]."</td>";
                                echo "</tr>";
                            }while($row = mysqli_fetch_array($listQuery));
	                }else{
	                    echo "There is no record";
                    }
                ?>
            </div>
        </div>
    </body>
</html>