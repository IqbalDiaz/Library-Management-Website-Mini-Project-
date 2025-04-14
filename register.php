<?php
require 'config.php'; // Include your database configuration

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error = "Username and Password are required.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $error = "Username already exists.";
        } else {
            // Hash the password and insert the user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashedPassword])) {
                $success = "Registration successful. <a href='login.php'>Login here</a>";
            } else {
                $error = "Failed to register. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Registration</title>
    <link rel="stylesheet" href="styles_register.css">
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form action="register.php" method="POST">

            <!-- Username Input -->
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Enter your username</label>
            </div>

            <!-- Password Input -->
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Enter your password</label>
            </div>

            <!-- Confirm Password Input -->
            <div class="input-field">
                <input type="password" name="confirm_password" required>
                <label>Confirm your password</label>
            </div>

            <!-- Submit Button -->
            <button type="submit">Register</button>

            <!-- Error/Success Message -->
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php elseif ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
        </form>

        <!-- Redirect to Login -->
        <div class="redirect">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
