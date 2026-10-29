<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$subjects = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM subjects"));
$exams = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM exams"));
$questions = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM questions"));

include("../includes/header.php");
?>

<div class="container-fluid mt-4">

<div class="row">

<div class="col-lg-12">

<div class="card border-0 shadow-lg mb-4"
style="background:linear-gradient(135deg,#0d6efd,#6610f2);color:white;border-radius:20px;">

<div class="card-body p-5">

<div class="row align-items-center">

<div class="col-md-8">

<h1 class="fw-bold">

Welcome,

<?php echo $_SESSION['admin']; ?>

👋

</h1>

<h5 class="mt-3">

Online Examination System

</h5>

<p>

Manage Students, Subjects, Exams, Questions and Results from one place.

</p>

</div>

<div class="col-md-4 text-end">

<i class="fa-solid fa-graduation-cap"
style="font-size:90px;opacity:.25;"></i>

<br><br>

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

</div>

</div>

<div class="row">

<!-- Students -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card text-white shadow-lg border-0"
style="background:linear-gradient(135deg,#0d6efd,#4e8cff);border-radius:18px;">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>

Students

</h5>

<h1>

<?php echo $students; ?>

</h1>

</div>

<div>

<i class="fa-solid fa-users fa-3x"></i>

</div>

</div>

</div>

</div>

</div>

<!-- Subjects -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card text-white shadow-lg border-0"
style="background:linear-gradient(135deg,#198754,#38c172);border-radius:18px;">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>

Subjects

</h5>

<h1>

<?php echo $subjects; ?>

</h1>

</div>

<div>

<i class="fa-solid fa-book fa-3x"></i>

</div>

</div>

</div>

</div>

</div>

<!-- Exams -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card text-white shadow-lg border-0"
style="background:linear-gradient(135deg,#fd7e14,#ffc107);border-radius:18px;">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>

Exams

</h5>

<h1>

<?php echo $exams; ?>

</h1>

</div>

<div>

<i class="fa-solid fa-file-lines fa-3x"></i>

</div>

</div>

</div>

</div>

</div>

<!-- Questions -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card text-white shadow-lg border-0"
style="background:linear-gradient(135deg,#dc3545,#ff5b6b);border-radius:18px;">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<h5>

Questions

</h5>

<h1>

<?php echo $questions; ?>

</h1>

</div>

<div>

<i class="fa-solid fa-circle-question fa-3x"></i>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="row">

<!-- Recent Results -->

<div class="col-lg-8 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

📊 Recent Results

</h4>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>Student</th>

<th>Exam</th>

<th>Score</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$result = mysqli_query($conn,"
SELECT
students.name,
exams.exam_name,
results.score,
results.total_questions,
results.status
FROM results
INNER JOIN students
ON results.student_id = students.student_id
INNER JOIN exams
ON results.exam_id = exams.exam_id
ORDER BY results.result_id DESC
LIMIT 5
");

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>

<?php echo $row['name']; ?>

</td>

<td>

<?php echo $row['exam_name']; ?>

</td>

<td>

<?php echo $row['score']; ?>

/

<?php echo $row['total_questions']; ?>

</td>

<td>

<?php

if($row['status']=="Pass")
{

?>

<span class="badge bg-success">

PASS

</span>

<?php

}
else

{

?>

<span class="badge bg-danger">

FAIL

</span>

<?php

}

?>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

<!-- Quick Actions -->

<div class="col-lg-4">

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

<h4 class="mb-0">

⚡ Quick Actions

</h4>

</div>

<div class="card-body d-grid gap-3">

<a href="students/add_student.php"

class="btn btn-primary">

➕ Add Student

</a>

<a href="subjects/add_subject.php"

class="btn btn-success">

📚 Add Subject

</a>

<a href="exams/add_exam.php"

class="btn btn-warning">

📝 Add Exam

</a>

<a href="questions/add_question.php"

class="btn btn-danger">

❓ Add Question

</a>

<a href="results/view_results.php"

class="btn btn-info text-white">

📊 View Results

</a>

</div>

</div>

<br>

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

System Summary

</div>

<div class="card-body">

<p>

👨 Students :

<b>

<?php echo $students; ?>

</b>

</p>

<p>

📚 Subjects :

<b>

<?php echo $subjects; ?>

</b>

</p>

<p>

📝 Exams :

<b>

<?php echo $exams; ?>

</b>

</p>

<p>

❓ Questions :

<b>

<?php echo $questions; ?>

</b>

</p>

</div>

</div>

</div>

</div>

<div class="row mt-4">

<!-- Top Scorer -->

<div class="col-lg-4 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-warning text-dark">

<h5 class="mb-0">

🏆 Top Scorer

</h5>

</div>

<div class="card-body">

<?php

$top=mysqli_query($conn,"
SELECT
students.name,
results.percentage
FROM results
INNER JOIN students
ON students.student_id=results.student_id
ORDER BY results.percentage DESC
LIMIT 1
");

if(mysqli_num_rows($top)>0)
{
$row=mysqli_fetch_assoc($top);
?>

<h3 class="text-primary">

<?php echo $row['name']; ?>

</h3>

<h2 class="text-success">

<?php echo number_format($row['percentage'],2); ?>%

</h2>

<?php
}
else
{
?>

<p>No Results Yet</p>

<?php
}
?>

</div>

</div>

</div>

<!-- Date & Time -->

<div class="col-lg-4 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-info text-white">

<h5>

📅 Today

</h5>

</div>

<div class="card-body text-center">

<h3>

<?php echo date("d M Y"); ?>

</h3>

<h5 id="clock"></h5>

</div>

</div>

</div>

<!-- System Status -->

<div class="col-lg-4 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

<h5>

💻 System Status

</h5>

</div>

<div class="card-body">

<p>

🟢 Database Connected

</p>

<p>

🟢 Admin Logged In

</p>

<p>

🟢 Examination Module Active

</p>

<p>

🟢 Result Module Active

</p>

</div>

</div>

</div>

</div>

<script>

function updateClock()
{
let now=new Date();

document.getElementById("clock").innerHTML=
now.toLocaleTimeString();
}

setInterval(updateClock,1000);

updateClock();

</script>