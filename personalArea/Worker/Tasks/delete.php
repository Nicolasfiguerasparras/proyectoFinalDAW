<?php
    session_start();
    include('../../../connectDB.php');
    $db = connectDb();

    $delete = mysqli_query($db, "DELETE FROM tasks WHERE task_ID = '$_GET[task]'");
    header("location: index.php");
?>