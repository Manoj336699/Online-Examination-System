<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");
include("../../includes/header.php");

$query = mysqli_query($conn,"SELECT * FROM students ORDER BY student_id DESC");
?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">
Student Management
</h2>

<a href="add_student.php" class="btn btn-primary">

<i class="fa-solid fa-plus"></i>

Add Student

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Course</th>
<th>Username</th>
<th width="180">Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['student_id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td><?php echo $row['course']; ?></td>

<td><?php echo $row['username']; ?></td>

<td>

<a href="edit_student.php?id=<?php echo $row['student_id'];?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_student.php?id=<?php echo $row['student_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure?')">

Delete

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

<?php include("../../includes/footer.php"); ?>