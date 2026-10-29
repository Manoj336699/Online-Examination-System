<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM students WHERE student_id='$id'");
$row = mysqli_fetch_assoc($query);

$message="";

if(isset($_POST['update']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    $sql = "UPDATE students SET
            name='$name',
            email='$email',
            mobile='$mobile',
            course='$course',
            username='$username'
            WHERE student_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        header("Location: view_students.php");
        exit();
    }
    else
    {
        $message="Update Failed!";
    }
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-warning">

<h3>Edit Student</h3>

</div>

<div class="card-body">

<?php
if($message!="")
{
    echo "<div class='alert alert-danger'>$message</div>";
}
?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Name</label>

<input type="text"
name="name"
class="form-control"
value="<?php echo $row['name']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?php echo $row['email']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input type="text"
name="mobile"
class="form-control"
value="<?php echo $row['mobile']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Course</label>

<input type="text"
name="course"
class="form-control"
value="<?php echo $row['course']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Username</label>

<input type="text"
name="username"
class="form-control"
value="<?php echo $row['username']; ?>"
required>

</div>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Update Student

</button>

<a href="view_students.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>