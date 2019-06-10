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
        
        <title>My clients</title>
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
        
        /* Form styles */
        
        .form-control {
            min-height: 41px;
            background: #fff;
            box-shadow: none !important;
            border-color: #e3e3e3;
        }
        .form-control:focus {
            border-color: #70c5c0;
        }
        .form-control, .btn {
            border-radius: 2px;
        }
        .login-form input[type="checkbox"] {
            margin-top: 2px;
        }
        .login-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #70c5c0;
            border: none;
            margin-bottom: 20px;
        }
        .login-form .btn:hover, .login-form .btn:focus {
            background: #50b8b3;
            outline: none !important;
        }
        .login-form a {
            color: #fff;
            text-decoration: underline;
        }
        .login-form a:hover {
            text-decoration: none;
        }
        .login-form form a {
            color: #7a7a7a;
            text-decoration: none;
        }
        .login-form form a:hover {
            text-decoration: underline;
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
                $userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawers where lawer_ID = '$_SESSION[id_user]'"));
                
                if(!isset($_SESSION['login_ok'])){
                    header("location: ../../notAllowed.php");
                }
                
                if($userData == ""){
                    header("location: ../../notAllowed.php");
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
                            <h1 class="h1" style="text-align: center">Clients > List clients</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../../Lawer/'>Index</a>
                                    <a class='nav-link active' href='../Clients/'>My clients</a>
                                    <div class="table-primary" style="padding-left: 20px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>List clients</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='create.php'>Create client</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class='nav-link' href="../Cases/">My cases</a>
                                    <a class="nav-link" href="../Tasks/">Tasks</a>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9">
                                <?php
                                    $listQuery = mysqli_query($db, "SELECT * FROM clients");

                                    if($row = mysqli_fetch_array($listQuery)){
                                        echo "<table class='table'>";

                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'>Name</th>";
                                                    echo "<th scope='col'>Surname</th>";
                                                    echo "<th scope='col'>Birth Date</th>";
                                                    echo "<th scope='col'>Phone</th>";
                                                    echo "<th scope='col'>Email</th>";
                                                    echo "<th scope='col'>Username</th>";
                                                    echo "<th scope='col'>Password</th>";
                                                    echo "<th scope='col'>Cases</th>";
                                                    echo "<th scope='col'>Bill</th>";
                                                echo "</tr>";
                                            echo "</thead>";


                                            do{
                                                $listID=$row['client_ID'];
                                                $valid = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM cases WHERE client_ID = '$listID' and lawer_ID = '$_SESSION[id_user]'"));
                                                if(!$valid == ""){
                                                    echo "<tr>";
                                                        echo "<td>".$row["name"]."</td>";
                                                        echo "<td>".$row["surname"]."</td>";
                                                        $bDateFormatted = date("l jS F ", strtotime($row["birth_date"]));   
                                                        echo "<td>".$bDateFormatted."</td>";
                                                        echo "<td>".$row["phone"]."</td>";
                                                        echo "<td>".$row["email"]."</td>";
                                                        echo "<td>".$row["username"]."</td>";
                                                        echo "<td>".$row["password"]."</td>";
                                                        $cases = mysqli_query($db, "SELECT * FROM cases WHERE client_ID = '$row[client_ID]'");
                                                        $num = mysqli_num_rows($cases);
                                                        if($row_cases = mysqli_fetch_array($cases)){
                                                            echo "<td>";
                                                                do{
                                                                    echo $row_cases['title'];
                                                                    $num--;
                                                                    if(!$num == 0){
                                                                        echo ", ";
                                                                    }
                                                                }while($row_cases = mysqli_fetch_array($cases));
                                                            echo "</td>";
                                                        }else{
                                                            echo "<td>No record</td>";
                                                        }
                                                        echo "<td>".$row["bill"]."$</td>";
                                                        echo "<td style='text-align: center'><a href='addCase.php?client=$listID'><i class='fa fa-plus' aria-hidden='true'></i></a></td>";
                                                        echo "<td style='text-align: center'><a href='payment.php?client=$listID'><i class='fas fa-dollar-sign' style='font-size:20px; color:black'></i></a></td>";
                                                        echo "<td style='text-align: center'><a href='modify.php?client=$listID'><i class='fa fa-edit' style='font-size:20px;color:green'></i></a></td>";
                                                        echo "<td style='text-align: center'><a class='delete_button' href='delete.php?client=$listID'><i class='fa fa-trash' style='font-size:20px;color:red'></i></a></td>";
                                                    echo "</tr>";
                                                }
                                            }while($row = mysqli_fetch_array($listQuery));
                                    }else{
                                        echo "There is no record";
                                    }
                                ?>
                            </div>
                        <!-- /Main content -->

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete confirmation -->
            <script type="text/javascript">
                $('.delete_button').click(function(e){
                    var result = confirm("Are you sure you want to delete this client?");
                    if(!result) {
                        e.preventDefault();
                    }
                });
            </script>
        <!-- /Delete confirmation -->

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