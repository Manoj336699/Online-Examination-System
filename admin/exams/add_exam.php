<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$message="";

if(isset($_POST['save']))
{
    $subject=$_POST['subject_id'];
    $exam=$_POST['exam_name'];
    $questions=$_POST['total_questions'];
    $duration=$_POST['duration'];
    $pass=$_POST['pass_marks'];

    mysqli_query($conn,"INSERT INTO exams
    (subject_id,exam_name,total_questions,duration,pass_marks)
    VALUES
    ('$subject','$exam','$questions','$duration','$pass')");

    $message="Exam Added Successfully!";
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Add Exam</h3>

</div>

<div class="card-body">

<?php
if($message!="")
{
echo "<div class='alert alert-success'>$message</div>";
}
?>

<form method="POST">

<div class="mb-3">

<label>Subject</label>

<select
name="subject_id"
class="form-control"
required>

<option value="">Select Subject</option>

<?php

$subjects=mysqli_query($conn,"SELECT * FROM subjects");

while($sub=mysqli_fetch_assoc($subjects))
{
?>

<option value="<?php echo $sub['subject_id']; ?>">

<?php echo $sub['subject_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>Exam Name</label>

<input
type="text"
name="exam_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Total Questions</label>

<input
type="number"
name="total_questions"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Duration (Minutes)</label>

<input
type="number"
name="duration"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Pass Marks</label>

<input
type="number"
name="pass_marks"
class="form-control"
required>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

Save Exam

</button>

<a href="view_exams.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>