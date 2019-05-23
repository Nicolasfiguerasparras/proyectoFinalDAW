<?php
    session_start();
    include('../../../connectDB.php');
    $db = connectDb();

    $delete = mysqli_query($db, "DELETE FROM cases WHERE case_ID = '$_GET[case]'");
    header("location: index.php");
?>