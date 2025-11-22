<?php
include "config.php";

$errors = [];

if (isset($_POST['signup'])) {
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $confirm   = trim($_POST['confirm']);

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    // Prevent duplicate email or username
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' OR username='$username' LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Username or email already exists.";
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: signin.php?success=1");
            exit;
        } else {
            $errors[] = "Error creating account.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Style Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h2>Create your Google Account</h2>

<?php foreach ($errors as $e) { echo "<p class='error'>" . htmlspecialchars($e) . "</p>"; } ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" value="<?php echo isset($username)?htmlspecialchars($username):''; ?>"><br>
    <input type="email" name="email" placeholder="Email" value="<?php echo isset($email)?htmlspecialchars($email):''; ?>"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="confirm" placeholder="Confirm Password"><br>
    <button type="submit" name="signup">Sign Up</button>
</form>

<p><a href="signin.php">Already have an account?</a></p>
</div>
</body>
</html>