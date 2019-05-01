<!--Extract session-->
    <?php
        session_start();
    ?>
<!--/Extract session-->

<!DOCTYPE html>
<html lang="es">
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

        <link rel="stylesheet" type="text/css" href="styles.css">

        <title>Login</title>
    </head>
    <body>

        <!-- Establish connection with DB -->
            <?php
                // Establish connection
                include('../connectDB.php');
                $db = connectDb();
                //$id = collectID($db, 'firmas');
            ?>
        <!-- /Establish connection with DB -->

        <!-- Form action -->
            <?php
                if(isset($_POST['submit'])){
                    // Collect user and password on $_POST
                    $user = $_POST['username'];
                    $password = $_POST['password'];

                    // Create query for all possible login
                    $queryClient = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM clients WHERE username = '$user' && password = '$password'"));
                    $queryWorker = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM workers WHERE username = '$user' && password = '$password'"));
                    $queryLawer = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lawer WHERE username = '$user' && password = '$password'"));

                    // Possible actions
                    if($queryClient != ""){
                        $_SESSION['login_ok'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['id_user']= $queryClient['ID'];
                        
                        // Codificate session and save in cookie if openSession exist
                        $dataSesion = session_encode();
                        
                        if(isset($_POST['openSession'])){
                            setcookie("sesion", $dataSesion, time()+(60*60*60), "/");
                        }

                        header("Location: ../personalArea/Client/");
                    }elseif($queryLawer != ""){
                        $_SESSION['login_ok'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['id_user']= $queryLawer['ID'];
                        
                        // Encode session and save in cookie if openSession exist
                        $dataSesion = session_encode();
                        
                        if(isset($_POST['openSession'])){
                            setcookie("sesion", $dataSesion, time()+(60*60*60), "/");
                        }

                        header("Location: ../personalArea/Lawer/");
                    }elseif($queryWorker != ""){
                        $_SESSION['login_ok'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['id_user']= $queryWorker['ID'];
                        
                        // Codificate session and save in cookie if openSession exist
                        $dataSesion = session_encode();
                        
                        if(isset($_POST['openSession'])){
                            setcookie("sesion", $dataSesion, time()+(60*60*60), "/");
                        }

                        header("Location: ../personalArea/Worker/");
                    }elseif($user == admin && $password = admin){
                        $_SESSION['login_ok'] = true;
                        $_SESSION['user'] = "admin";
                        $_SESSION['id_user']= 0;
                        
                        // Codificate session and save in cookie if openSession exist
                        $dataSesion = session_encode();
                        
                        if(isset($_POST['openSession'])){
                            setcookie("sesion", $dataSesion, time()+(60*60*60), "/");
                        }

                        header("Location: ../personalArea/Admin/");
                    }else{
                        header("Location:index.php?error=true");
                    }
                }
            ?>
        <!-- /Form action -->
        
        <!-- Login form -->
            <div class="login-form">
                <form action="index.php" method="post">
                    <div class="avatar">
                        <img src="../img/iconAvatar.png" alt="Avatar">
                    </div>
                    <h2 class="text-center">User area</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="User" required="required" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                    </div>
                    <?php
                        if(isset($_GET['error'])){
                            echo "<h4 style='color:red; text-align: center'>Login incorrect!</h4>";
                        }
                    ?>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                    </div>
                    <div class="clearfix">
                        <label class="pull-left checkbox-inline"><input type="checkbox" name="openSession"> Remember me</label>
                        <a href="forgotPassword/" class="pull-right">Forgot Password?</a>
                    </div>
                </form>
            </div>
        <!-- /Login form -->

        <!-- Close DB connection -->
            <?php
                mysqli_close($db);
            ?>
        <!-- /Close DB connection -->

        <!-- Bootstrsp JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- /Bootstrap JS -->
    </body>
</html>