<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['username'];
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Login</title>
    <link rel="stylesheet" href="styles_login.css">
</head>
<body>
    <div class="login-container">
        <h1>Library Login</h1>
        <form action="login.php" method="POST">

        <div class="input-field">
            <input type="text" name="username" required >
            <label>Enter your name</label>
        </div>

        <div class="input-field">
            <input type="password" name="password" required>
            <label>Enter your password</label>
        </div>

        <div class="forget">
            <label for="remember">
                <input type="checkbox"id="remember">
                <p>Remember me</p>
            </label>
            <a href="forget_password.php">Forget Password?</a>
        </div>

        <button type="submit">Login</button>

        <div class="register">
            <p>
                Don't have an account?
                <a href="register.php">Register</a>
            </p>
        </div>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        </form>
    </div>
</body>
</html>