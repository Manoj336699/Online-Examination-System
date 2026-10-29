<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");

$message = "";

if(isset($_POST['save']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "INSERT INTO students
    (name,email,mobile,course,username,password)
    VALUES
    ('$name','$email','$mobile','$course','$username','$password')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Student Added Successfully!";
    }
    else
    {
        $message = "Error : ".mysqli_error($conn);
    }
}

include("../../includes/header.php");
?>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Add Student</h3>

</div>

<div class="card-body">

<?php
if($message!="")
{
?>

<div class="alert alert-success">

<?php echo $message; ?>

</div>

<?php
}
?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input
type="text"
name="mobile"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Course</label>

<input
type="text"
name="course"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

</div>

<div class="mt-3">

<button
type="submit"
name="save"
class="btn btn-success">

Save Student

</button>

<a
href="view_students.php"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>