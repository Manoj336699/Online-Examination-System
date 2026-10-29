<?php
session_start();
include("../includes/db.php");

$error = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['admin'] = $username;
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

<div class="col-lg-4 col-md-6">

<div class="card p-4">

<div class="text-center mb-4">

<i class="fa-solid fa-user-shield fa-4x text-primary"></i>

<h2 class="mt-3">Admin Login</h2>

<p class="text-muted">Online Examination System</p>

</div>

<?php
if($error!="")
{
?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php
}
?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Username

</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

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
class="btn btn-primary btn-lg">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</div>

</form>

<hr>

<div class="text-center">

<a href="../student/login.php">

Student Login

</a>

</div>

</div>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>