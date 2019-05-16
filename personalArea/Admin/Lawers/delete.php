<?php
    session_start();
    include('../../../connectDB.php');
    $db = connectDb();

    $delete = mysqli_query($db, "DELETE FROM lawers WHERE lawer_ID = '$_GET[lawer]'");
    header("location: index.php");
?>