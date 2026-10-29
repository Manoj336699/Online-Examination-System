<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$sql = "SELECT exams.*, subjects.subject_name
        FROM exams
        INNER JOIN subjects
        ON exams.subject_id = subjects.subject_id
        ORDER BY exams.exam_id";

$query = mysqli_query($conn,$sql);
?>

<div class="container-fluid mt-4">

<!-- Welcome Banner -->

<div class="card border-0 shadow-lg mb-5"
style="background:linear-gradient(135deg,#0d6efd,#6610f2);color:white;border-radius:20px;">

<div class="card-body p-5">

<div class="row align-items-center">

<div class="col-md-8">

<h1>

📚 Available Exams

</h1>

<h5>

Choose an exam and begin your assessment.

</h5>

<p>

Good luck,
<b><?php echo $_SESSION['student_name']; ?></b>

</p>

</div>

<div class="col-md-4 text-end">

<i class="fa-solid fa-book-open"
style="font-size:90px;opacity:.25;"></i>

</div>

</div>

</div>

</div>

<div class="row">

<?php

while($row=mysqli_fetch_assoc($query))
{

$exam_id=$row['exam_id'];

$check=mysqli_query($conn,"
SELECT *
FROM results
WHERE student_id='".$_SESSION['student_id']."'
AND exam_id='$exam_id'
");

$completed=mysqli_num_rows($check)>0;

?>

<div class="col-lg-4 col-md-6 mb-4">

<div class="card border-0 shadow-lg h-100 exam-card">

<div class="card-body">

<h3 class="text-primary">

<?php echo $row['subject_name']; ?>

</h3>

<h5 class="mb-4">

<?php echo $row['exam_name']; ?>

</h5>

<div class="mb-3">

<span class="badge bg-primary">

📝 <?php echo $row['total_questions']; ?> Questions

</span>

</div>

<div class="mb-3">

<span class="badge bg-warning text-dark">

⏱ <?php echo $row['duration']; ?> Minutes

</span>

</div>

<div class="mb-4">

<span class="badge bg-success">

🎯 Pass Marks: <?php echo $row['pass_marks']; ?>

</span>

</div>

<?php

if($completed)
{

?>

<button class="btn btn-success w-100" disabled>

✔ Exam Completed

</button>

<?php

}

else

{

?>

<a href="start_exam.php?exam_id=<?php echo $exam_id; ?>"

class="btn btn-primary w-100">

▶ Start Exam

</a>

<?php

}

?>

</div>

</div>

</div>

<?php

}

?>

</div>

<div class="text-center mt-4">

<a href="dashboard.php"

class="btn btn-secondary btn-lg">

← Back to Dashboard

</a>

</div>

</div>

<style>

.exam-card{

border-radius:20px;

transition:.3s;

}

.exam-card:hover{

transform:translateY(-10px);

box-shadow:0 20px 40px rgba(0,0,0,.2);

}

.badge{

font-size:15px;

padding:10px 15px;

}

</style>