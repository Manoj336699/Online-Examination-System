<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM questions WHERE question_id='$id'");
$question = mysqli_fetch_assoc($query);

if(isset($_POST['update']))
{
    $exam_id = $_POST['exam_id'];
    $question_text = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];

    mysqli_query($conn,"UPDATE questions SET
        exam_id='$exam_id',
        question='$question_text',
        option1='$option1',
        option2='$option2',
        option3='$option3',
        option4='$option4',
        correct_answer='$correct_answer'
        WHERE question_id='$id'");

    header("Location: view_questions.php");
    exit();
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-warning">

<h3>Edit Question</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Exam</label>

<select name="exam_id" class="form-control" required>

<?php

$exams = mysqli_query($conn,"SELECT * FROM exams");

while($row = mysqli_fetch_assoc($exams))
{
?>

<option
value="<?php echo $row['exam_id']; ?>"
<?php if($row['exam_id']==$question['exam_id']) echo "selected"; ?>>

<?php echo $row['exam_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>Question</label>

<textarea
name="question"
class="form-control"
rows="3"
required><?php echo $question['question']; ?></textarea>

</div>

<div class="mb-3">

<label>Option 1</label>

<input
type="text"
name="option1"
class="form-control"
value="<?php echo $question['option1']; ?>"
required>

</div>

<div class="mb-3">

<label>Option 2</label>

<input
type="text"
name="option2"
class="form-control"
value="<?php echo $question['option2']; ?>"
required>

</div>

<div class="mb-3">

<label>Option 3</label>

<input
type="text"
name="option3"
class="form-control"
value="<?php echo $question['option3']; ?>"
required>

</div>

<div class="mb-3">

<label>Option 4</label>

<input
type="text"
name="option4"
class="form-control"
value="<?php echo $question['option4']; ?>"
required>

</div>

<div class="mb-3">

<label>Correct Answer</label>

<select name="correct_answer" class="form-control">

<option value="option1" <?php if($question['correct_answer']=="option1") echo "selected"; ?>>Option 1</option>

<option value="option2" <?php if($question['correct_answer']=="option2") echo "selected"; ?>>Option 2</option>

<option value="option3" <?php if($question['correct_answer']=="option3") echo "selected"; ?>>Option 3</option>

<option value="option4" <?php if($question['correct_answer']=="option4") echo "selected"; ?>>Option 4</option>

</select>

</div>

<button type="submit" name="update" class="btn btn-success">

Update Question

</button>

<a href="view_questions.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>