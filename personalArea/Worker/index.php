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

        <!-- Tab icon -->
        <link rel="shortcut icon" href="../../img/tabIcon.jpg" type="image/x-icon"/>
        
        <title>Worker panel</title>
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
                include('../../connectDB.php');
                $db = connectDb();
            ?>
        <!-- /Establish connection with DB -->

        <!-- Restrictions -->
            <?php
                $userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers where worker_ID = '$_SESSION[id_user]'"));
                
                if(!isset($_SESSION['login_ok'])){
                    header("location: ../notAllowed.php");
                }
                
                if($userData == ""){
                    header("location: ../notAllowed.php");
                }
            ?>
        <!-- /Restrictions -->

        <div class="container-fluid content">
            <div class="row">
                <div class="col-10 offset-1 insideContainer">
                    <div class="row">
                        <div class="col-2 avatar">
                            <img src="../../img/iconAvatar.png" alt="Avatar">
                        </div>
                        <div class="col-9 shadow-lg p-3 mb-5 bg-#70c5c0 rounded">
                            <h1 class="h1" style="text-align: center">Today's tasks for <?php echo $userData['name']." ".$userData['surname'] ?>:</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link active' href='index.php'>Index</a>
                                    <a class='nav-link' href='Clients/'>Clients</a>
                                    <a class='nav-link' href="Tasks/">Tasks</a>
                                    <a class="nav-link" href="../Cases/">Cases</a>
                                    <a class="nav-link" href="../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9">
                                <?php
                                    $today = date('o-m-d');
                                    $listQuery = mysqli_query($db, "SELECT * FROM tasks where end_date = '$today' and status = '0'");

                                    if($row = mysqli_fetch_array($listQuery)){

                                        echo "<table class  ='table'>";

                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'>Title</th>";
                                                    echo "<th scope='col'>Description</th>";
                                                    echo "<th scope='col'>Start date</th>";
                                                    echo "<th scope='col'>End date</th>";
                                                    echo "<th scope='col'>Worker</th>";
                                                    echo "<th scope='col'>Lawer</th>";
                                                echo "</tr>";
                                            echo "</thead>";

                                            do{
                                                echo "<tr>";
                                                    $taskID=$row['task_ID'];
                                                    echo "<td>".$row["title"]."</td>";
                                                    echo "<td>".$row["description"]."</td>";
                                                    echo "<td>".$row["start_date"]."</td>";
                                                    echo "<td>".$row["end_date"]."</td>";

                                                    $lawerName = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawers WHERE lawer_ID = '$row[lawer_ID]'"));
                                                    echo "<td>".$lawerName["name"]." ".$lawerName["surname"]."</td>";

                                                    $clientName = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers WHERE worker_ID = '$row[worker_ID]'"));
                                                    echo "<td>".$clientName["name"]." ".$clientName["surname"]."</td>";
                                                    echo "<td style='text-align: center'><a class='done_button' href='Tasks/done.php?task=$taskID'><i class='fa fa-check-circle' style='font-size:20px;color:blue'></i></a></td>";
                                                echo "</tr>";
                                            }while($row = mysqli_fetch_array($listQuery));
                                    }else{
                                        echo "There is no task for today";
                                    }
                                ?>
                            </div>
                        <!-- /Main content -->

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>