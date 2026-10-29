<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");
include("../../includes/header.php");

$sql="SELECT
results.*,
students.name,
students.course,
exams.exam_name
FROM results
INNER JOIN students
ON results.student_id=students.student_id
INNER JOIN exams
ON results.exam_id=exams.exam_id
ORDER BY results.submitted_at DESC";

$query=mysqli_query($conn,$sql);
?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">

📊 Student Results

</h2>

<a href="../dashboard.php" class="btn btn-secondary">

Dashboard

</a>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Student</th>

<th>Course</th>

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

$no=1;

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['course']; ?></td>

<td><?php echo $row['exam_name']; ?></td>

<td><?php echo $row['score']; ?></td>

<td><?php echo $row['total_questions']; ?></td>

<td><?php echo number_format($row['percentage'],2); ?>%</td>

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

<td>

<?php echo date("d-m-Y H:i",strtotime($row['submitted_at'])); ?>

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

<?php include("../../includes/footer.php"); ?>