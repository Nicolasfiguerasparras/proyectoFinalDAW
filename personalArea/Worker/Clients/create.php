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
                    $createQuery = mysqli_query($db, "INSERT INTO clients (client_ID, name, surname, birth_date, phone, email, username, password, case_ID, bill) VALUES ('NULL', '$name', '$surname', '$birth_date', $phone, '$email', '$username', '$password', '0')") or die(mysqli_error($db));
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
                            <h1>Bienvenido</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../index.php'>Index</a>
                                    <a class='nav-link' href='../Clients/'>Clients</a>
                                    <div class="table-primary" style="padding-left: 20px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>List clients</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link active' href='create.php'>Create client</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class='nav-link' href="../Tasks/">Tasks</a>
                                    <a class="nav-link" href="../Cases/">Cases</a>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>

                        <!-- Main content -->
                            <div class="col-9">
                                <form action="create.php" method="post">
                                    <input type="hidden" id="ID" name="ID" placeholder="<?php echo $id ?>" disabled>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">First name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Insert name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="surname">Last name</label>
                                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Insert last name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="birth_date">Birth date</label>
                                            <input type="date" class="form-control" id="birth_date" name="birth_date">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="phone">Phone number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+34 639 941 992">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="example@example.com">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
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