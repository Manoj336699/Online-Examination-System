<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online Examination System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="/OnlineExamSystem/assets/css/style.css">

</head>

<body>

<?php

if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}

include(__DIR__ . "/navbar.php");

if(isset($_SESSION['admin']))
{
    include(__DIR__ . "/sidebar.php");
}

if(isset($_SESSION['student_id']))
{
    include(__DIR__ . "/student_sidebar.php");
}

?>

<div style="margin-left:260px;padding:20px;">