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
    $exam_id = $_POST['exam_id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];

    mysqli_query($conn,"INSERT INTO questions
    (exam_id,question,option1,option2,option3,option4,correct_answer)
    VALUES
    ('$exam_id','$question','$option1','$option2','$option3','$option4','$correct_answer')");

    $message="Question Added Successfully!";
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Add Question</h3>

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

<label>Exam</label>

<select name="exam_id" class="form-control" required>

<option value="">Select Exam</option>

<?php
$exams = mysqli_query($conn,"SELECT * FROM exams");

while($exam = mysqli_fetch_assoc($exams))
{
?>

<option value="<?php echo $exam['exam_id']; ?>">

<?php echo $exam['exam_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">
<label>Question</label>
<textarea name="question" class="form-control" rows="3" required></textarea>
</div>

<div class="mb-3">
<label>Option 1</label>
<input type="text" name="option1" class="form-control" required>
</div>

<div class="mb-3">
<label>Option 2</label>
<input type="text" name="option2" class="form-control" required>
</div>

<div class="mb-3">
<label>Option 3</label>
<input type="text" name="option3" class="form-control" required>
</div>

<div class="mb-3">
<label>Option 4</label>
<input type="text" name="option4" class="form-control" required>
</div>

<div class="mb-3">
<label>Correct Answer</label>
<select name="correct_answer" class="form-control" required>
<option value="">Select Correct Answer</option>
<option value="option1">Option 1</option>
<option value="option2">Option 2</option>
<option value="option3">Option 3</option>
<option value="option4">Option 4</option>
</select>
</div>

<button type="submit" name="save" class="btn btn-success">
Save Question
</button>

<a href="view_questions.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>