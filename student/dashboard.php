<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$student_id=$_SESSION['student_id'];

$total_exams=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM exams"));

$completed=mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM results
WHERE student_id='$student_id'
"));

$avg=mysqli_query($conn,"
SELECT AVG(percentage) AS avgscore
FROM results
WHERE student_id='$student_id'
");

$avgrow=mysqli_fetch_assoc($avg);

$average=number_format($avgrow['avgscore'],1);

include("../includes/header.php");
?>

<div class="container-fluid mt-4">

<div class="card border-0 shadow-lg mb-4"
style="background:linear-gradient(135deg,#0d6efd,#6610f2);color:white;border-radius:20px;">

<div class="card-body p-5">

<div class="row align-items-center">

<div class="col-md-8">

<h1>

Welcome,

<?php echo $_SESSION['student_name']; ?>

👋

</h1>

<h5>

Student Dashboard

</h5>

<p>

Take your exams and track your performance.

</p>

</div>

<div class="col-md-4 text-end">

<i class="fa-solid fa-user-graduate"
style="font-size:90px;opacity:.25;"></i>

<br>

<h5>

<?php echo date("l"); ?>

</h5>

<p>

<?php echo date("d F Y"); ?>

</p>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card text-white shadow border-0"
style="background:linear-gradient(135deg,#0d6efd,#4e8cff);">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>Total Exams</h5>

<h1><?php echo $total_exams; ?></h1>

</div>

<i class="fa-solid fa-file-lines fa-3x"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card text-white shadow border-0"
style="background:linear-gradient(135deg,#198754,#38c172);">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>Completed</h5>

<h1><?php echo $completed; ?></h1>

</div>

<i class="fa-solid fa-circle-check fa-3x"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card text-white shadow border-0"
style="background:linear-gradient(135deg,#fd7e14,#ffc107);">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>Average Score</h5>

<h1>

<?php

if($average=="")
echo "0";
else
echo $average;

?>

%

</h1>

</div>

<i class="fa-solid fa-chart-column fa-3x"></i>

</div>

</div>

</div>

</div>

</div>

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

Quick Actions

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<a href="available_exams.php"
class="btn btn-primary w-100">

📋 Available Exams

</a>

</div>

<div class="col-md-4">

<a href="results.php"
class="btn btn-success w-100">

📊 My Results

</a>

</div>

<div class="col-md-4">

<a href="logout.php"
class="btn btn-danger w-100">

🚪 Logout

</a>

</div>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>