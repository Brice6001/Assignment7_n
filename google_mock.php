<?php
session_start();
// Simulate Google login
$_SESSION['user'] = "Google User";
// If you want to map to DB user, you could check and create a user row here.
header("Location: dashboard.php");
exit;
?>