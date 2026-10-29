<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

if(!isset($_POST['exam_id']))
{
    header("Location: available_exams.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$exam_id = $_POST['exam_id'];

$answers = isset($_POST['answer']) ? $_POST['answer'] : [];

$score = 0;

/* Get Exam Details */

$exam_query = mysqli_query($conn,"SELECT * FROM exams WHERE exam_id='$exam_id'");
$exam = mysqli_fetch_assoc($exam_query);

$total_questions = $exam['total_questions'];
$pass_marks = $exam['pass_marks'];

/* Check Answers */

$question_query = mysqli_query($conn,"SELECT * FROM questions WHERE exam_id='$exam_id'");

while($question = mysqli_fetch_assoc($question_query))
{
    $question_id = $question['question_id'];

    if(isset($answers[$question_id]))
    {
        if($answers[$question_id] == $question['correct_answer'])
        {
            $score++;
        }
    }
}

/* Calculate Percentage */

$percentage = ($score / $total_questions) * 100;

/* Pass or Fail */

$status = ($score >= $pass_marks) ? "Pass" : "Fail";

/* Prevent Duplicate Result */

$check = mysqli_query($conn,"
SELECT * FROM results
WHERE student_id='$student_id'
AND exam_id='$exam_id'
");

if(mysqli_num_rows($check)==0)
{
    mysqli_query($conn,"
    INSERT INTO results
    (student_id,exam_id,score,total_questions,percentage,status)
    VALUES
    ('$student_id',
    '$exam_id',
    '$score',
    '$total_questions',
    '$percentage',
    '$status')
    ");
}

/* Redirect */

header("Location: results.php");

exit();
?>