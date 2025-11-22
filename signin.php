<?php
include "config.php";
session_start();

$errors = [];

if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if ($res && mysqli_num_rows($res) == 1) {
            $user = mysqli_fetch_assoc($res);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Wrong password.";
            }
        } else {
            $errors[] = "Account not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Style Sign In</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h2>Sign in to Continue</h2>

<?php foreach ($errors as $e) { echo "<p class='error'>" . htmlspecialchars($e) . "</p>"; } ?>

<?php if (isset($_GET['success'])) { echo "<p class='success'>Account created. Please sign in.</p>"; } ?>

<form method="POST">
    <input type="text" name="username" placeholder="Email or Username" value="<?php echo isset($username)?htmlspecialchars($username):''; ?>"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit" name="signin">Sign In</button>
</form>

<br>

<form action="google_mock.php" method="POST">
    <button class="google-btn">Login with Google</button>
</form>

<p><a href="signup.php">Create account</a></p>
</div>
</body>
</html>