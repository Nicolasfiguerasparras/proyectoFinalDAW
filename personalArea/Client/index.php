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
        <link rel="stylesheet" type="text/css" href="css/main.css"> 
		<!-- --------------------------------------------------------------------------------------------- -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- --------------------------------------------------------------------------------------------- -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<!-- --------------------------------------------------------------------------------------------- -->

        <link href="styles.css" rel="stylesheet">

        <title>Personal area</title>
    </head>
    <body>

        <!-- Establish connection with DB -->
            <?php
                // Establish connection
                include('../../connectDB.php');
                $db = connectDb();
                //$id = collectID($db, 'firmas');
            ?>
		<!-- /Establish connection with DB -->
		
		<!-- Restrictions -->
			<?php
				if(isset($_SESSION['login_ok'])){
					$check = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients WHERE client_ID = $_SESSION[id_user]"));
					if($check == ""){
						header("location: ../notAllowed.php");
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
                                <a class='nav-link active' href='index.php'>Index</a>
                                <a class='nav-link' href="Lawers/">Lawers</a>
                                <a class='nav-link' href='Clients/'>Clients</a>
                                <a class='nav-link' href="Workers/">Workers</a>
								<a class="nav-link" href="../../login/logout.php">Logout</a>
							</div>
						<!-- /Lateral NavBar -->

					</div>

					<!-- Main content -->
                        <div class="col-9">
                           
                        </div>
                    <!-- /Main content -->
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