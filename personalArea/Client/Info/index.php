<!-- Extract session -->
<?php
        session_start();
    ?>
<!-- /Extract session -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Tab icon -->
        <link rel="shortcut icon" href="../../../img/tabIcon.jpg" type="image/x-icon"/>
        
        <title>Your info</title>
    </head>
    <style>
        html, body{
            overflow-x: hidden;
        }

        body{
            color: #fff;
            background: #d47677;
        }

        .content{
            margin: 0 auto;
            padding: 50px 0px 300px;
        }

        .insideContainer{
            color:black;
            border-radius: 2px;
            margin-bottom: 15px;
            font-size: 16px;
            background: #ececec;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
            position: relative;
            width:80vw;
        }

        .avatar{
            text-align: center;
        }

        .avatar img{
            width: 95px;
            height: 95px;
        }
    </style>
    <body>

        <!-- Establish connection with DB -->
            <?php
                include('../../../connectDB.php');
                $db = connectDb();
            ?>
        <!-- /Establish connection with DB -->

		<!-- Restrictions -->
			<?php
                $userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients where client_ID = '$_SESSION[id_user]'"));
                
                if(!isset($_SESSION['login_ok'])){
					header("location: ../../../notAllowed.php");
                }
                
                if($userData == ""){
                    header("location: ../../../notAllowed.php");
                }
			?>
		<!-- /Restrictions -->

        <div class="container-fluid content">
            <div class="row">
                <div class="col-10 offset-1 insideContainer">
                    <div class="row">
                        <div class="col-2 avatar">
                            <img src="../../../img/iconAvatar.png" alt="Avatar">
                        </div>
                        <div class="col-9 shadow-lg p-3 mb-5 bg-#70c5c0 rounded">
                            <h1 class="h1" style="text-align: center">Your information</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../../Client/'>Index</a>
                                    <a class='nav-link' href='../Cases/'>Your cases</a>
                                    <a class='nav-link' href="../Lawer/">Your lawers</a>
                                    <a class="nav-link active" href="../Info/">Your info</a>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9">
                                <?php
                                    $listQuery = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients WHERE client_ID = '$_SESSION[id_user]'"));

                                    echo "<table class='table'>";

                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th scope='col'>Name</th>";
                                                echo "<th scope='col'>Surname</th>";
                                                echo "<th scope='col'>Birth date</th>";
                                                echo "<th scope='col'>Phone</th>";
                                                echo "<th scope='col'>Email</th>";
                                                echo "<th scope='col'>Username</th>";
                                                echo "<th scope='col'>Password</th>";
                                                echo "<th scope='col'>Bill</th>";
                                            echo "</tr>";
                                        echo "</thead>";

                                        echo "<tbody>";
                                            echo "<tr>";
                                                echo "<td>".$listQuery["name"]."</td>";
                                                echo "<td>".$listQuery["surname"]."</td>";
                                                $bDateFormatted = date("l jS F ", strtotime($listQuery["birth_date"]));   
                                                echo "<td>".$bDateFormatted."</td>";
                                                echo "<td>".$listQuery["phone"]."</td>";
                                                echo "<td>".$listQuery["email"]."</td>";
                                                echo "<td>".$listQuery["username"]."</td>";
                                                echo "<td>".$listQuery["password"]."</td>";
                                                echo "<td>".$listQuery["bill"]."$</td>";
                                                echo "<td style='text-align: center'><a href='modify.php?client=$listQuery[client_ID]'><i class='fa fa-edit' style='font-size:20px;color:green'></i></a></td>";
                                            echo "</tr>";
                                        echo "</tbody>";
                                    echo "</table>";
                                ?>
                            </div>
                        <!-- /Main content -->

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<!-- /Bootstrap JS -->

        <!-- Connection close -->
            <?php
                mysqli_close($db);
            ?>
        <!-- /Connection close -->

    </body>
</html>