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
        <link rel="shortcut icon" href="../../../img/tabIcon.jpg" type="image/x-icon"/>

        <title>Modify task</title>
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
                $userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers where worker_ID = '$_SESSION[id_user]'"));
                
                if(!isset($_SESSION['login_ok'])){
                    header("location: ../../notAllowed.php");
                }
                
                if($userData == ""){
                    header("location: ../../notAllowed.php");
                }
            ?>
        <!-- /Restrictions -->

        <!-- Data extract -->
            <?php
                if(isset($_GET['task'])){
                    $taskData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM tasks WHERE task_ID = '$_GET[task]'"));
                }
            ?>
        <!-- /Data extract -->

        <!-- Modify form action -->
            <?php
                if(isset($_POST['modify'])){
                    $modifyQuery = mysqli_query($db, "INSERT INTO tasks (task_ID, title, description, start_date, end_date, worker_ID, lawer_ID) VALUES ('NULL', '$_POST[title]', '$_POST[description]', '$_POST[start_date]', '$_POST[end_date]', '$_POST[worker_ID]', '$_POST[lawer_ID]')") or die(mysqli_error($db));
                    header("location: index.php");
                }
            ?>
        <!-- /Modify form action -->

        <div class="container-fluid content">
            <div class="row">
                <div class="col-10 offset-1 insideContainer">
                    <div class="row">
                        <div class="col-2 avatar">
                            <img src="../../../img/iconAvatar.png" alt="Avatar">
                        </div>
                        <div class="col-9 shadow-lg p-3 mb-5 bg-#70c5c0 rounded">
                            <h1 class="h1" style="text-align: center">Tasks > Modify task</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../index.php'>Index</a>
                                    <a class='nav-link' href='../Clients/'>Clients</a>
                                    <a class='nav-link active' href="../Tasks/">Tasks</a>
                                    <div class="table-primary" style="padding-left: 20px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>My tasks</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='create.php'>Create task</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='finished.php'>Finished tasks</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class="nav-link" href="../Cases/">Cases</a>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9 login-form">
                                <form action="create.php" method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $taskData['title'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $taskData['description'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="lawer_ID">Lawer</label>
                                            <select id="client" name="lawer_ID" class="form-control">
                                                <?php
                                                    $lawerData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawers WHERE lawer_ID = '$taskData[lawer_ID]'"));
                                                ?> 
                                                <option value="<?php echo $lawerData['lawer_ID'] ?>" selected><?php echo $lawerData['name']." ".$lawerData['surname'] ?></option>
                                                <?php
                                                    $lawers = mysqli_query($db, "SELECT * FROM lawers");

                                                    if($row = mysqli_fetch_array($lawers)){
                                                        do{
                                                            if(!$row['lawer_ID'] == $taskData['lawer_ID']){
                                                                echo "<option value='$row[lawer_ID]'>".$row['name']." ".$row['surname']."</option>";
                                                            }
                                                        }while($row = mysqli_fetch_array($lawers));
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="worker_ID">Worker</label>
                                            <select id="worker_ID" name="worker_ID" class="form-control">
                                                <?php
                                                    $workerData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers WHERE worker_ID = '$taskData[worker_ID]'"));
                                                ?>
                                                <option value="<?php echo $workerData['worker_ID'] ?>" selected><?php echo $workerData['name']." ".$workerData['surname'] ?></option>
                                                <?php
                                                    $workers = mysqli_query($db, "SELECT * FROM workers");

                                                    if($row = mysqli_fetch_array($workers)){
                                                        do{
                                                            if(!$row['worker_ID'] == $taskData['worker_ID']){
                                                                echo "<option value='$row[worker_ID]'>".$row['name']." ".$row['surname']."</option>";
                                                            }
                                                        }while($row = mysqli_fetch_array($workers));
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="start_date">Start date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $taskData['start_date'] ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="end_date">End date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $taskData['end_date'] ?>">
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit" name="create">
                                </form>
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