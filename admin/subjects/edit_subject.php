<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM subjects WHERE subject_id='$id'");
$row = mysqli_fetch_assoc($query);

if(isset($_POST['update']))
{
    $name = mysqli_real_escape_string($conn,$_POST['subject_name']);
    $code = mysqli_real_escape_string($conn,$_POST['subject_code']);
    $semester = $_POST['semester'];
    $credits = $_POST['credits'];

    mysqli_query($conn,"UPDATE subjects SET
        subject_name='$name',
        subject_code='$code',
        semester='$semester',
        credits='$credits'
        WHERE subject_id='$id'");

    header("Location: view_subjects.php");
    exit();
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-warning">

<h3>Edit Subject</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Subject Name</label>

<input
type="text"
name="subject_name"
class="form-control"
value="<?php echo $row['subject_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Subject Code</label>

<input
type="text"
name="subject_code"
class="form-control"
value="<?php echo $row['subject_code']; ?>"
required>

</div>

<div class="mb-3">

<label>Semester</label>

<input
type="number"
name="semester"
class="form-control"
value="<?php echo $row['semester']; ?>"
required>

</div>

<div class="mb-3">

<label>Credits</label>

<input
type="number"
name="credits"
class="form-control"
value="<?php echo $row['credits']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Update Subject

</button>

<a
href="view_subjects.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>