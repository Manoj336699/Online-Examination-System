<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");
include("../../includes/header.php");

$sql = "SELECT exams.*, subjects.subject_name
        FROM exams
        INNER JOIN subjects
        ON exams.subject_id = subjects.subject_id
        ORDER BY exams.exam_id DESC";

$query = mysqli_query($conn,$sql);
?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">
Exam Management
</h2>

<a href="add_exam.php" class="btn btn-primary">
<i class="fa-solid fa-plus"></i>
Add Exam
</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Subject</th>
<th>Exam Name</th>
<th>Questions</th>
<th>Duration</th>
<th>Pass Marks</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($row=mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $row['exam_id']; ?></td>

<td><?php echo $row['subject_name']; ?></td>

<td><?php echo $row['exam_name']; ?></td>

<td><?php echo $row['total_questions']; ?></td>

<td><?php echo $row['duration']; ?> Minutes</td>

<td><?php echo $row['pass_marks']; ?></td>

<td>

<a href="edit_exam.php?id=<?php echo $row['exam_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_exam.php?id=<?php echo $row['exam_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Exam?')">

Delete

</a>

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