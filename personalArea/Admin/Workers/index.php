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

        <!-- --------------------------------------------------------------------------------------------- -->
        <link rel="stylesheet" type="text/css" href="../css/main.css"> 
		<!-- --------------------------------------------------------------------------------------------- -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- --------------------------------------------------------------------------------------------- -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<!-- --------------------------------------------------------------------------------------------- -->

        <link href="styles.css" rel="stylesheet">

        <title>Index</title>
    </head>
    <body>

        <!-- Establish connection with DB -->
            <?php
                // Establish connection
                include('../../../connectDB.php');
                $db = connectDb();
                //$id = collectID($db, 'firmas');
            ?>
        <!-- /Establish connection with DB -->

        <!-- Restrictions -->
			<?php
				if(isset($_SESSION['login_ok'])){
					if(!$_SESSION['id_user'] == 0){
						header("location: ../../notAllowed.php");
					}
				}else{
					header("location: ../notAllowed.php");
				}
			?>
		<!-- /Restrictions -->

        <div class="container-fluid">
			<div class="mainBox">
				<div class="row">

                    <!-- Add client button -->
						<div class="col-3 addClientBox">
							<!-- <a href="#"><i class="fas fa-plus-circle addClientBtn"></i></a> -->
						</div>
					<!-- /Add client button -->

					<!-- Welcome message -->
						<div class="col-9 welcomeMessage">
							<h1>Welcome back</h1>
						</div>
                    <!-- /Welcome message -->
                    
				</div>

				<div class="row">
					<div class="col-3">

						<!-- Lateral NavBar -->
							<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class='nav-link' href='../index.php'>Index</a>
                                <a class='nav-link' href="../Lawers/">Lawers</a>
                                <a class='nav-link' href='../Clients/'>Clients</a>
                                <a class='nav-link active' href="index.php">Workers</a>
								<a class="nav-link" href="../../../login/logout.php">Logout</a>
							</div>
						<!-- /Lateral NavBar -->

					</div>

					<!-- Main content -->
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="highPriority" href="index.php" role="tab" aria-selected="true">List workers</a>
                                            <a class="nav-item nav-link" id="mediumPriority" href="create.php" role="tab" aria-selected="false">Create worker</a>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="listClients" role="tabpanel" aria-labelledby="highPriority">
                                            <div class="col-10">
                                                    <br>
                                                <?php
                                                    $listQuery = mysqli_query($db, "SELECT * FROM workers");

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
                                                                    $listID=$row['worker_ID'];
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
                                                                    echo "<td style='text-align: center'><a href='modify.php?worker=$listID'><i class='fa fa-edit' style='font-size:20px;color:green'></i></a></td>";
                                                                    
                                                                    /* ¡¡¡¡¡¡¡¡¡¡ COMO METER EL ID EN EL MODAL !!!!!!!!!!!! */
                                                                    echo "<td style='text-align: center'><a href='index.php?worker=$listID' data-toggle='modal' data-target='#exampleModalCenter'><i class='fa fa-trash' style='font-size:20px;color:red'></i></a></td>";
                                                                echo "</tr>";
                                                            }while($row = mysqli_fetch_array($listQuery));
                                                    }else{
                                                        echo "There is no record";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /Main content -->

				</div>
			</div>
        </div>
        
        <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure you want to delete this worker?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>This action cannot be undone</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, take me back</button>
                            <a href="delete.php?worker="><button type="button" class="btn btn-danger">Yes, delete it</button></a> <!-- Cómo selecciono el id al que corresponde? -->
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Modal -->

		<!-- Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<!-- /Bootstrap JS -->
    </body>
</html>