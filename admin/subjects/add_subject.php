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
    $name=mysqli_real_escape_string($conn,$_POST['subject_name']);
    $code=mysqli_real_escape_string($conn,$_POST['subject_code']);
    $semester=$_POST['semester'];
    $credits=$_POST['credits'];

    $sql="INSERT INTO subjects
    (subject_name,subject_code,semester,credits)
    VALUES
    ('$name','$code','$semester','$credits')";

    if(mysqli_query($conn,$sql))
    {
        $message="Subject Added Successfully!";
    }
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-success text-white">

<h3>Add Subject</h3>

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

<label>Subject Name</label>

<input type="text"
name="subject_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Subject Code</label>

<input type="text"
name="subject_code"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Semester</label>

<input type="number"
name="semester"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Credits</label>

<input type="number"
name="credits"
class="form-control"
required>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

Save Subject

</button>

<a href="view_subjects.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>