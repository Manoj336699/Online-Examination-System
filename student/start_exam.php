<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

if(!isset($_GET['exam_id']))
{
    header("Location: available_exams.php");
    exit();
}

$exam_id = intval($_GET['exam_id']);

$exam_query = mysqli_query($conn,"
SELECT exams.*, subjects.subject_name
FROM exams
INNER JOIN subjects
ON exams.subject_id = subjects.subject_id
WHERE exams.exam_id='$exam_id'
");

$exam = mysqli_fetch_assoc($exam_query);

if(!$exam)
{
    die("Exam not found.");
}

$questions = mysqli_query($conn,"
SELECT *
FROM questions
WHERE exam_id='$exam_id'
ORDER BY question_id
");

$total_questions = mysqli_num_rows($questions);

include("../includes/header.php");
?>

<div class="container-fluid mt-4">

<div class="card border-0 shadow-lg mb-4"
style="background:linear-gradient(135deg,#0d6efd,#6610f2);color:white;border-radius:20px;">

<div class="card-body p-4">

<div class="row align-items-center">

<div class="col-md-8">

<h2>

📚 <?php echo $exam['subject_name']; ?>

</h2>

<h5>

<?php echo $exam['exam_name']; ?>

</h5>

<p>

📝 Questions :
<b><?php echo $exam['total_questions']; ?></b>

&nbsp;&nbsp;

⏱ Duration :
<b><?php echo $exam['duration']; ?> Minutes</b>

</p>

</div>

<div class="col-md-4 text-end">

<h2>

⏳

<span id="timer">

<?php echo $exam['duration']; ?>:00

</span>

</h2>

</div>

</div>

</div>

</div>

<div class="card shadow border-0">

<div class="card-body">

<form
action="submit_exam.php"
method="POST"
onsubmit="return confirm('Are you sure you want to submit the exam?');">

<input
type="hidden"
name="exam_id"
value="<?php echo $exam_id; ?>">

<div class="alert alert-info">

<strong>

Answer every question before submitting.

</strong>

</div>

<?php

$no = 1;

while($row = mysqli_fetch_assoc($questions))
{

?>

<div class="card shadow-lg border-0 mb-4"
style="border-radius:15px;">

<div class="card-body">

<h5 class="text-primary fw-bold">

Question <?php echo $no; ?> of <?php echo $total_questions; ?>

</h5>

<hr>

<p class="fs-5">

<?php echo $row['question']; ?>

</p>

<div class="form-check border rounded p-3 mb-2">

<input
class="form-check-input"
type="radio"
id="q<?php echo $row['question_id']; ?>_1"
name="answer[<?php echo $row['question_id']; ?>]"
value="option1">

<label
class="form-check-label w-100"
for="q<?php echo $row['question_id']; ?>_1">

<?php echo $row['option1']; ?>

</label>

</div>

<div class="form-check border rounded p-3 mb-2">

<input
class="form-check-input"
type="radio"
id="q<?php echo $row['question_id']; ?>_2"
name="answer[<?php echo $row['question_id']; ?>]"
value="option2">

<label
class="form-check-label w-100"
for="q<?php echo $row['question_id']; ?>_2">

<?php echo $row['option2']; ?>

</label>

</div>

<div class="form-check border rounded p-3 mb-2">

<input
class="form-check-input"
type="radio"
id="q<?php echo $row['question_id']; ?>_3"
name="answer[<?php echo $row['question_id']; ?>]"
value="option3">

<label
class="form-check-label w-100"
for="q<?php echo $row['question_id']; ?>_3">

<?php echo $row['option3']; ?>

</label>

</div>

<div class="form-check border rounded p-3 mb-2">

<input
class="form-check-input"
type="radio"
id="q<?php echo $row['question_id']; ?>_4"
name="answer[<?php echo $row['question_id']; ?>]"
value="option4">

<label
class="form-check-label w-100"
for="q<?php echo $row['question_id']; ?>_4">

<?php echo $row['option4']; ?>

</label>

</div>

</div>

</div>

<?php

$no++;

}

?>

<div class="text-center mt-4">

<button
type="submit"
class="btn btn-success btn-lg px-5 shadow">

✅ Submit Exam

</button>

</div>

</form>

</div>

</div>

<style>

.form-check{
    cursor:pointer;
    transition:all .3s ease;
}

.form-check:hover{
    background:#eef5ff;
    border-color:#0d6efd !important;
}

.form-check-input{
    transform:scale(1.2);
    margin-top:8px;
}

.form-check-label{
    width:100%;
    cursor:pointer;
    padding-left:8px;
    font-size:17px;
}

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-3px);
}

#timer{
    font-weight:bold;
    font-size:28px;
}

.btn-success{
    border-radius:12px;
    font-size:20px;
    padding:12px 30px;
}

.alert-info{
    border-radius:12px;
}

</style>

<script>

let minutes = <?php echo (int)$exam['duration']; ?>;
let seconds = 0;

function updateTimer()
{
    let displayMinutes = minutes;
    let displaySeconds = seconds;

    if(displaySeconds < 10)
    {
        displaySeconds = "0" + displaySeconds;
    }

    document.getElementById("timer").innerHTML =
    displayMinutes + ":" + displaySeconds;

    if(minutes == 0 && seconds == 0)
    {
        clearInterval(timer);

        alert("Time is over. Your exam will be submitted automatically.");

        document.forms[0].submit();

        return;
    }

    if(seconds == 0)
    {
        minutes--;
        seconds = 59;
    }
    else
    {
        seconds--;
    }
}

updateTimer();

let timer = setInterval(updateTimer,1000);

</script>

<?php include("../includes/footer.php"); ?>