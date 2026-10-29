<?php
session_start();
include("../includes/db.php");

$error = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM students
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1)
    {
        $student = mysqli_fetch_assoc($result);

        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['student_name'] = $student['name'];

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password!";
    }
}

include("../includes/header.php");
?>

<div class="container">

<div class="row justify-content-center align-items-center" style="min-height:100vh;">

<div class="col-md-5">

<div class="card p-4 shadow">

<div class="text-center mb-4">

<i class="fa-solid fa-user-graduate fa-4x text-primary"></i>

<h2 class="mt-3">Student Login</h2>

<p class="text-muted">Online Examination System</p>

</div>

<?php
if($error!="")
{
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="login"
class="btn btn-primary">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</div>

</form>

<hr>

<div class="text-center">

<a href="../admin/login.php">

Admin Login

</a>

</div>

</div>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>