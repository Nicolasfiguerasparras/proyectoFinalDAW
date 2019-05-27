<?php
    session_start();
    include('../../../connectDB.php');
    $db = connectDb();

    $done = mysqli_query($db, "UPDATE tasks SET status = '1' WHERE task_ID = '$_GET[task]'");
    header("location: index.php");
?>