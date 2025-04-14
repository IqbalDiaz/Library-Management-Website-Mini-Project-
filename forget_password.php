<?php
require 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the username exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Update the user's password
            $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            $updateStmt->execute([$hashedPassword, $username]);

            $success = "Your password has been successfully reset.";
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "No account found with this username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="styles_forget_password.css">
</head>
<body>
    <div class="forget-container">
        <h1>Reset Password</h1>
        <div class="instruction-box">
            <p>Enter your username and a new password to reset your account.</p>
        </div>
        <form action="forget_password.php" method="POST">
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Enter your username</label>
            </div>
            <div class="input-field">
                <input type="password" name="new_password" required>
                <label>Enter your new password</label>
            </div>
            <div class="input-field">
                <input type="password" name="confirm_password" required>
                <label>Confirm your new password</label>
            </div>
            <button type="submit">Reset Password</button>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
        </form>
        <div class="redirect">
            <p>
                <a href="login.php">Back to Login</a>
            </p>
        </div>
    </div>
</body>
</html>
