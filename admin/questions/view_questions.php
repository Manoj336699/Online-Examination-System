<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");
include("../../includes/header.php");

$sql = "SELECT questions.*, exams.exam_name
        FROM questions
        INNER JOIN exams
        ON questions.exam_id = exams.exam_id
        ORDER BY question_id DESC";

$query = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">Question Management</h2>

<a href="add_question.php" class="btn btn-primary">
<i class="fa-solid fa-plus"></i>
Add Question
</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Exam</th>
<th>Question</th>
<th>Correct Answer</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($query)) { ?>

<tr>

<td><?php echo $row['question_id']; ?></td>

<td><?php echo $row['exam_name']; ?></td>

<td><?php echo $row['question']; ?></td>

<td><?php echo $row['correct_answer']; ?></td>

<td>

<a href="edit_question.php?id=<?php echo $row['question_id']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete_question.php?id=<?php echo $row['question_id']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Delete this question?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>