<?php
    session_start();
    include('../../../connectDB.php');
    $db = connectDb();

    $delete = mysqli_query($db, "DELETE FROM clients WHERE client_ID = '$_GET[client]'");
    header("location: index.php");
?>