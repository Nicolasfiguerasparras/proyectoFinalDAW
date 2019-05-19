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

        .quantityInput {
            border: 1px inset #ccc;
        }

        .quantityInput input {
            border: 0;
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

        <div class="container-fluid content">
            <div class="row">
                <div class="col-10 offset-1 insideContainer">
                    <div class="row">
                        <div class="col-2 avatar">
                            <img src="../../../img/iconAvatar.png" alt="Avatar">
                        </div>
                        <div class="col-9">
                            <h1>Welcome back, <?php echo $userData['name']." ".$userData['surname'] ?></h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2">

                            <!-- Lateral NavBar -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class='nav-link' href='../index.php'>Index</a>
                                    <a class='nav-link active' href='../Clients/'>Clients</a>
                                    <a class='nav-link' href="../Tasks/">Tasks</a>
                                    <a class="nav-link" href="../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9">
                                <form action="payment.php" method="post">

                                    <input type="hidden" value="<?php echo $_GET['client'] ?>" name="client_ID">

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="type">Type</label>
                                            <select id="type" class="form-control" name="type">
                                                <option selected disabled>Chose...</option>
                                                <option value=0>First consultation</option>
                                                <option value="1">Retention of services</option>
                                                <option value="2">Monthly payment</option>
                                                <option value="3">Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="quantity">Quantity</label>
                                            <span class="quantityInput">$<input type="text" name="quantity" id="cuantity"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Address 2</label>
                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="inputCity">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="text" class="form-control" id="inputZip">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck">
                                            <label class="form-check-label" for="gridCheck">
                                                Check me out
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </form>
                                <?php
                                    print_r($_SESSION);
                                ?>
                            </div>
                        <!-- /Main content -->

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>