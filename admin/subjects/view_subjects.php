<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../../includes/db.php");
include("../../includes/header.php");

$query = mysqli_query($conn,"SELECT * FROM subjects ORDER BY subject_id DESC");
?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">
Subject Management
</h2>

<a href="add_subject.php" class="btn btn-success">

<i class="fa-solid fa-plus"></i>

Add Subject

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Subject Name</th>
<th>Subject Code</th>
<th>Semester</th>
<th>Credits</th>
<th width="180">Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['subject_id']; ?></td>

<td><?php echo $row['subject_name']; ?></td>

<td><?php echo $row['subject_code']; ?></td>

<td><?php echo $row['semester']; ?></td>

<td><?php echo $row['credits']; ?></td>

<td>

<a href="edit_subject.php?id=<?php echo $row['subject_id'];?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_subject.php?id=<?php echo $row['subject_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Subject?')">

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