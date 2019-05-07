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

        <!-- Query for Form -->
            <?php
                $idActualLawer= $_GET['lawer'];
                $actualLawerQuery = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawers WHERE lawer_ID = $idActualLawer"));
            ?>
        <!-- /Query for Form -->

        <!-- Form action -->
            <?php
                if(isset($_POST['modify'])){
                    $name = $_POST['name'];
	                $surname = $_POST['surname'];
	                $birth_date = $_POST['birth_date'];
	                $phone = $_POST['phone'];
	                $email = $_POST['email'];
	                $username = $_POST['username'];
                    $password = $_POST['password'];
                    $id = $_POST['ID'];
                    $salary = $_POST['salary'];
                    
                    $update = mysqli_query($db, "
                                                    UPDATE lawers 
                                                    SET name = '$name',
                                                        surname = '$surname',
                                                        birth_date = '$birth_date',
                                                        phone = '$phone',
                                                        email = '$email',
                                                        username = '$username',
                                                        password = '$password',
                                                        salary = '$salary'
                                                    WHERE lawer_ID = '$id'
                                                ");
                    header("location: index.php");
                }
            ?>
        <!-- /Form action -->

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
							<h1>Modify client <?php echo $actualLawerQuery['name']." ".$actualLawerQuery['surname'] ?></h1>
						</div>
					<!-- /Welcome message -->
				</div>

				<div class="row">
					<div class="col-3">

						<!-- Lateral NavBar -->
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class='nav-link' href='../index.php'>Index</a>
                                <a class='nav-link' href="../Lawers/">Lawers</a>
                                <a class='nav-link active' href='index.php'>Clients</a>
                                <a class='nav-link' href="../Workers/">Workers</a>
								<a class="nav-link" href="../../../login/logout.php">Logout</a>
							</div>
						<!-- /Lateral NavBar -->

					</div>

					<!-- Main content -->
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="listClients" role="tabpanel" aria-labelledby="listClients">
                                            <form action="modify.php" method="post">
                                                <input type="text" id="ID" name="ID" value="<?php echo $id ?>" hidden disabled>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="name">First name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $actualLawerQuery['name'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="surname">Last name</label>
                                                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $actualLawerQuery['surname'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="salary">Salary</label>
                                                        <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $actualLawerQuery['birth_date'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="birth_date">Birth date</label>
                                                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $actualLawerQuery['birth_date'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-2">
                                                        <label for="phone">Phone number</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $actualLawerQuery['phone'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $actualLawerQuery['email'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $actualLawerQuery['username'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $actualLawerQuery['password'] ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="client_ID" value="<?php echo $_GET['lawer'] ?>">
                                                <input type="submit" class="btn btn-primary" value="Modify" name="modify">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <!-- Connection close -->
            <?php
                mysqli_close($db);
            ?>
        <!-- /Connection close -->

    </body>
</html>