<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online Examination System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:linear-gradient(135deg,#0d6efd,#6610f2);

min-height:100vh;

display:flex;

justify-content:center;

align-items:center;

}

.main-card{

width:900px;

background:white;

border-radius:25px;

padding:50px;

box-shadow:0 20px 50px rgba(0,0,0,.25);

text-align:center;

}

.logo{

font-size:90px;

color:#0d6efd;

margin-bottom:20px;

}

.title{

font-size:40px;

font-weight:700;

}

.subtitle{

font-size:20px;

color:#666;

margin-bottom:35px;

}

.btn-custom{

padding:15px;

font-size:20px;

font-weight:600;

border-radius:15px;

transition:.3s;

}

.btn-custom:hover{

transform:translateY(-5px);

}

.stat-card{

background:#f8f9fa;

border-radius:15px;

padding:25px;

transition:.3s;

}

.stat-card:hover{

background:#0d6efd;

color:white;

transform:translateY(-8px);

}

.footer{

margin-top:40px;

color:gray;

font-size:15px;

}

</style>

</head>

<body>

<div class="main-card">

<div class="logo">

<i class="fa-solid fa-graduation-cap"></i>

</div>

<div class="title">

ONLINE EXAMINATION SYSTEM

</div>

<div class="subtitle">

Web Based Online Examination System

</div>

<div class="row mb-5">

<div class="col-md-6 mb-3">

<a href="admin/login.php"

class="btn btn-primary btn-custom w-100">

<i class="fa-solid fa-user-shield"></i>

Admin Login

</a>

</div>

<div class="col-md-6 mb-3">

<a href="student/login.php"

class="btn btn-success btn-custom w-100">

<i class="fa-solid fa-user-graduate"></i>

Student Login

</a>

</div>

</div>

<div class="row">

<div class="col-md-3 mb-3">

<div class="stat-card">

<h1 class="text-primary">

5

</h1>

<h5>

📚 Subjects

</h5>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card">

<h1 class="text-success">

5

</h1>

<h5>

📝 Exams

</h5>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card">

<h1 class="text-danger">

50

</h1>

<h5>

❓ Questions

</h5>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card">

<h1 class="text-warning">

3

</h1>

<h5>

👨 Students

</h5>

</div>

</div>

</div>

<hr class="my-4">

<div class="footer">

<h5>

Developed By

</h5>

<h4>

Satya Manoj Basina Agastya

</h4>

<p>

Bachelor of Computer Applications (BCA)

</p>

<p>

Academic Year 2026

</p>

</div>

</div>

</body>

</html>