<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

<div class="container-fluid">

<a class="navbar-brand fw-bold" href="#">

🎓 Online Examination System

</a>

<div class="ms-auto text-white">

Welcome,

<b>

<?php
if(isset($_SESSION['admin']))
{
    echo $_SESSION['admin'];
}
elseif(isset($_SESSION['student_name']))
{
    echo $_SESSION['student_name'];
}
?>

</b>

</div>

</div>

</nav>