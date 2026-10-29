<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM exams WHERE exam_id='$id'");
$exam = mysqli_fetch_assoc($query);

if(isset($_POST['update']))
{
    $subject = $_POST['subject_id'];
    $exam_name = $_POST['exam_name'];
    $questions = $_POST['total_questions'];
    $duration = $_POST['duration'];
    $pass = $_POST['pass_marks'];

    mysqli_query($conn,"UPDATE exams SET
        subject_id='$subject',
        exam_name='$exam_name',
        total_questions='$questions',
        duration='$duration',
        pass_marks='$pass'
        WHERE exam_id='$id'");

    header("Location: view_exams.php");
    exit();
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-warning">

<h3>Edit Exam</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Subject</label>

<select name="subject_id" class="form-control" required>

<?php

$subjects=mysqli_query($conn,"SELECT * FROM subjects");

while($row=mysqli_fetch_assoc($subjects))
{
?>

<option value="<?php echo $row['subject_id']; ?>"
<?php if($row['subject_id']==$exam['subject_id']) echo "selected"; ?>>

<?php echo $row['subject_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>Exam Name</label>

<input type="text"
name="exam_name"
class="form-control"
value="<?php echo $exam['exam_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Total Questions</label>

<input type="number"
name="total_questions"
class="form-control"
value="<?php echo $exam['total_questions']; ?>"
required>

</div>

<div class="mb-3">

<label>Duration (Minutes)</label>

<input type="number"
name="duration"
class="form-control"
value="<?php echo $exam['duration']; ?>"
required>

</div>

<div class="mb-3">

<label>Pass Marks</label>

<input type="number"
name="pass_marks"
class="form-control"
value="<?php echo $exam['pass_marks']; ?>"
required>

</div>

<button type="submit" name="update" class="btn btn-success">

Update Exam

</button>

<a href="view_exams.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>