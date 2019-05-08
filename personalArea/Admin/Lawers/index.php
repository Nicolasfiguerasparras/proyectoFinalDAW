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
				if(isset($_SESSION['login_ok'])){
					if(!$_SESSION['id_user'] == 0){
						header("location: ../../notAllowed.php");
					}
				}else{
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
                                    <a class='nav-link active' href='index.php'>Lawers</a>
                                    <div class="table-primary" style="padding-left: 20px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>List lawers</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class='nav-link' href='index.php'>Create lawer</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class='nav-link' href='../Clients/'>Clients</a>
                                    <a class='nav-link' href="../Workers/">Workers</a>
                                    <a class="nav-link" href="../../../login/logout.php">Logout</a>
                                </div>
                            <!-- /Lateral NavBar -->

                        </div>
                        
                        <!-- Main content -->
                            <div class="col-9">
                                <?php
                                    $listQuery = mysqli_query($db, "SELECT * FROM lawers");

                                    if($row = mysqli_fetch_array($listQuery)){
                                        echo "<table class='table table-bordered'>";

                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'>ID</th>";
                                                    echo "<th scope='col'>Name</th>";
                                                    echo "<th scope='col'>Surname</th>";
                                                    echo "<th scope='col'>Birth Date</th>";
                                                    echo "<th scope='col'>Phone</th>";
                                                    echo "<th scope='col'>Email</th>";
                                                    echo "<th scope='col'>Username</th>";
                                                    echo "<th scope='col'>Password</th>";
                                                    echo "<th scope='col'>Salary</th>";
                                                echo "</tr>";
                                            echo "</thead>";


                                            do{
                                                echo "<tr>";
                                                    $listID=$row['lawer_ID'];
                                                    echo "<td>".$listID."</td>";
                                                    echo "<td>".$row["name"]."</td>";
                                                    echo "<td>".$row["surname"]."</td>";
                                                    $bDateFormatted = date("l jS F ", strtotime($row["birth_date"]));   
                                                    echo "<td>".$bDateFormatted."</td>";
                                                    echo "<td>".$row["phone"]."</td>";
                                                    echo "<td>".$row["email"]."</td>";
                                                    echo "<td>".$row["username"]."</td>";
                                                    echo "<td>".$row["password"]."</td>";
                                                    echo "<td>".$row["salary"]."$</td>";
                                                    // echo "<td style='text-align: center'><a href='payment.php?client=$listID'><i class='fas fa-dollar-sign' style='font-size:20px; color:black'></i></a></td>";
                                                    echo "<td style='text-align: center'><a href='modify.php?lawer=$listID'><i class='fa fa-edit' style='font-size:20px;color:green'></i></a></td>";
                                                    
                                                    /* ¡¡¡¡¡¡¡¡¡¡ COMO METER EL ID EN EL MODAL !!!!!!!!!!!! */
                                                    echo "<td style='text-align: center'><a href='index.php?lawer=$listID' data-toggle='modal' data-target='#exampleModalCenter'><i class='fa fa-trash' style='font-size:20px;color:red'></i></a></td>";
                                                echo "</tr>";
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

        <!-- Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<!-- /Bootstrap JS -->
    </body>
</html>