<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM exams WHERE exam_id='$id'");

header("Location: view_exams.php");

exit();

?>