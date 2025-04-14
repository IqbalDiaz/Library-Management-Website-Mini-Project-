<?php
$password = 'password'; // The plain text password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
echo $hashedPassword; // Output the hashed password
?>