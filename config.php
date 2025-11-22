<?php
// config.php - put this file in project root and /crud as needed
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mini_social";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>