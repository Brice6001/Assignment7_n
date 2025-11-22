<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="dashboard-container">
    <h2 class="dash-title">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?> 👋</h2>
    <p class="dash-subtitle">You are logged into your Google-style mini network</p>
    <div class="dash-buttons">
        <a href="crud/index.php" class="dash-btn">📘 Open Student CRUD</a>
        <a href="logout.php" class="dash-btn logout">🚪 Logout</a>
    </div>
</div>
</body>
</html>