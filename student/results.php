<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$student_id = $_SESSION['student_id'];

$sql = "SELECT results.*, exams.exam_name
        FROM results
        INNER JOIN exams
        ON results.exam_id = exams.exam_id
        WHERE results.student_id='$student_id'
        ORDER BY results.submitted_at DESC";

$query = mysqli_query($conn,$sql);

$total_exams = mysqli_num_rows($query);

$pass_count = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM results
WHERE student_id='$student_id'
AND status='Pass'
"));

$avg = mysqli_query($conn,"
SELECT AVG(percentage) AS avgscore
FROM results
WHERE student_id='$student_id'
");

$avg_row = mysqli_fetch_assoc($avg);

$average = number_format($avg_row['avgscore'],2);
?>

<div class="container-fluid mt-4">

<!-- Header -->

<div class="card border-0 shadow-lg mb-4"
style="background:linear-gradient(135deg,#0d6efd,#6610f2);color:white;border-radius:20px;">

<div class="card-body p-5">

<div class="row align-items-center">

<div class="col-md-8">

<h2>📊 My Examination Results</h2>

<h5>

Welcome,

<?php echo $_SESSION['student_name']; ?>

</h5>

<p>

View all your examination performance in one place.

</p>

</div>

<div class="col-md-4 text-end">

<i class="fa-solid fa-award"
style="font-size:90px;opacity:.25;"></i>

</div>

</div>

</div>

</div>

<!-- Statistics -->

<div class="row mb-4">

<div class="col-md-4 mb-3">

<div class="card border-0 shadow text-center">

<div class="card-body">

<i class="fa-solid fa-file-lines fa-3x text-primary mb-3"></i>

<h2><?php echo $total_exams; ?></h2>

Completed Exams

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card border-0 shadow text-center">

<div class="card-body">

<i class="fa-solid fa-circle-check fa-3x text-success mb-3"></i>

<h2><?php echo $pass_count; ?></h2>

Passed Exams

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card border-0 shadow text-center">

<div class="card-body">

<i class="fa-solid fa-chart-column fa-3x text-warning mb-3"></i>

<h2>

<?php

if($average=="")
{
    echo "0";
}
else
{
    echo $average;
}

?>%

</h2>

Average Score

</div>

</div>

</div>

</div>

<!-- Results Table -->

<div class="card border-0 shadow-lg">

<div class="card-header bg-dark text-white">

<h4 class="mb-0">

📋 Examination History

</h4>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>Exam</th>

<th>Score</th>

<th>Total</th>

<th>Percentage</th>

<th>Status</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($query)>0)
{

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td>

<strong>

<?php echo $row['exam_name']; ?>

</strong>

</td>

<td>

<?php echo $row['score']; ?>

</td>

<td>

<?php echo $row['total_questions']; ?>

</td>

<td>

<?php echo number_format($row['percentage'],2); ?>%

</td>

<td>

<?php

if($row['status']=="Pass")
{

?>

<span class="badge bg-success px-3 py-2">

✅ PASS

</span>

<?php

}

else

{

?>

<span class="badge bg-danger px-3 py-2">

❌ FAIL

</span>

<?php

}

?>

</td>

<td>

<?php

echo date("d M Y h:i A",strtotime($row['submitted_at']));

?>

</td>

</tr>

<?php

}

}

else

{

?>

<tr>

<td colspan="6" class="text-center">

No results available.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

<div class="text-center mt-4">

<a href="dashboard.php"

class="btn btn-primary btn-lg me-2">

🏠 Dashboard

</a>

<a href="available_exams.php"

class="btn btn-success btn-lg">

📝 Available Exams

</a>

</div>

</div>

</div>

</div>

<style>

.card{
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.table tbody tr:hover{
background:#eef5ff;
}

.badge{
font-size:14px;
}

.btn{
border-radius:10px;
font-weight:600;
}

</style>

<?php include("../includes/footer.php"); ?>