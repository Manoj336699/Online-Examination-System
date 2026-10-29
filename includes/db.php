<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "online_exam";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Uncomment the line below if you want to verify the connection
// echo "Database Connected Successfully";

?>