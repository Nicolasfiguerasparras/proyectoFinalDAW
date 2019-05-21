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
                if(isset($_SESSION['login_ok'])){
					if(!$_SESSION['id_user'] == 0){
						header("location: ../../../notAllowed.php");
					}
				}else{
					header("location: ../../../notAllowed.php");
				}
			?>
		<!-- /Restrictions -->

        <!-- Form action -->
            <?php
                $acutalDate = date('o-m-d');
                if(isset($_POST['pay'])){
                    $insert = mysqli_query($db, "INSERT INTO payment (payment_ID, quantity, client_ID, worker_ID, date, type) VALUES ('NULL', '$_POST[amount]', '$_POST[client_ID]', '$_POST[worker_ID]', '$acutalDate', '$_POST[type]')");
                    if($_POST['type'] == "3"){
                        $newBill = $_POST['actualBill'] - $_POST['amount'];
                    }else{
                        $newBill = $_POST['actualBill'] + $_POST['amount'];
                    }
                    $updateBill = mysqli_query($db, "UPDATE clients SET bill = '$newBill' WHERE client_ID = '$_POST[client_ID]'");
                    header("location: index.php");
                }
            ?>
        <!-- /Form action -->

        <!-- Data extract -->
            <?php
                $actualBill = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients WHERE client_ID = '$_GET[client]'"));
            ?>
        <!-- /Data extract -->

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

                                    <!-- Hidden inputs -->
                                        <input type="hidden" value="<?php echo $_GET['client'] ?>" name="client_ID">
                                        <input type="hidden" value="<?php echo $_SESSION['id_user'] ?>" name="worker_ID">
                                        <input type="hidden" value="<?php echo $actualBill['bill'] ?>" name="actualBill">
                                    <!-- /Hidden inputs -->

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="type">Type</label>
                                            <select id="type" class="form-control" name="type">
                                                <option selected disabled>Chose...</option>
                                                <option value="0">First consultation</option>
                                                <option value="1">Retention of services</option>
                                                <option value="2">Monthly payment</option>
                                                <option value="3">Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="amout">Amount</label>
                                            <div class="input-group-prepend">
                                                <input type="text" class="form-control" id="amout" name="amount">
                                                <span class="input-group-text">$</span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" value="Insert payment" class="btn btn-primary" name="pay">
                                </form>

                            </div>
                        <!-- /Main content -->

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>