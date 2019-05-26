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


        <title>Document</title>
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
				$userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers where worker_ID = '$_SESSION[id_user]'"));
                
                if(!isset($_SESSION['login_ok'])){
					header("location: ../notAllowed.php");
                }
                
                if($userData == ""){
                    header("location: ../notAllowed.php");
                }
			?>
		<!-- /Restrictions -->

        <!-- Data extract -->
            <?php
                if(isset($_GET['case'])){
                    $caseData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM cases WHERE case_ID = '$_GET[case]'"));
                }
            ?>
        <!-- /Data extract -->

        <!-- Create form action -->
            <?php
                if(isset($_POST['modify'])){
                    $createQuery = mysqli_query($db, "UPDATE cases SET title = '$_POST[title]', description = '$_POST[description]', lawer_ID = '$_POST[lawer_ID]', client_ID = '$_POST[client_ID]', type = '$_POST[type]'") or die(mysqli_error($db));
                    header("location: index.php");
                }
            ?>
        <!-- /Create form action -->

        <div class="container-fluid content">
            <div class="row">
                <div class="col-10 offset-1 insideContainer">
                    <div class="row">
                        <div class="col-2 avatar">
                            <img src="../../../img/iconAvatar.png" alt="Avatar">
                        </div>
                        <div class="col-9">
                            <h1>Cases > Modify case</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../index.php'>Index</a>
                                    <a class='nav-link' href='../Clients/'>Clients</a>
                                    <a class='nav-link' href="../Tasks/">Tasks</a>
                                    <a class="nav-link active" href="../Cases/">Cases</a>
                                    <div class="table-primary" style="padding-left: 20px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>List cases</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='create.php'>Create case</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>

                        <!-- Main content -->
                            <div class="col-9">
                                <form action="modify.php" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="title">Title</label>
                                            <input type="title" class="form-control" id="title" name="title" value="<?php echo $caseData['title'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="description">Description</label>
                                            <input type="description" class="form-control" id="description" name="description" value="<?php echo $caseData['description'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="lawer">Lawer</label>
                                            <select id="lawer" name="lawer_ID" class="form-control">
                                                <?php
                                                    $lawerData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawers WHERE lawer_ID = '$caseData[lawer_ID]'"));
                                                ?>
                                                <option value="<?php echo $caseData['lawer_ID'] ?>" selected><?php echo $lawerData['name']." ".$lawerData['surname'] ?></option>
                                                <?php
                                                    $lawers = mysqli_query($db, "SELECT * FROM lawers");

                                                    if($row = mysqli_fetch_array($lawers)){
                                                        do{
                                                            if(!$row['lawer_ID'] == $lawerData['lawer_ID']){
                                                                echo "<option value='$row[lawer_ID]'>".$row['name']." ".$row['surname']."</option>";
                                                            }
                                                        }while($row = mysqli_fetch_array($lawers));
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="client">Client</label>
                                            <select id="client" name="client_ID" class="form-control">
                                                <?php
                                                    $clientData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients WHERE client_ID = '$caseData[client_ID]'"));
                                                ?>
                                                <option value="<?php echo $clientData['client_ID'] ?>" selected><?php echo $clientData['name']." ".$clientData['surname'] ?></option>
                                                <?php
                                                    $clients = mysqli_query($db, "SELECT * FROM clients");

                                                    if($row = mysqli_fetch_array($clients)){
                                                        do{
                                                            if(!$row['client_ID'] == $clientData['client_ID']){
                                                                echo "<option value='$row[client_ID]'>".$row['name']." ".$row['surname']."</option>";
                                                            }
                                                        }while($row = mysqli_fetch_array($clients));
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="description">Type</label>
                                            <input type="type" class="form-control" id="type" name="type" value="<?php echo $caseData['type'] ?>">
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-primary" name="modify">
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