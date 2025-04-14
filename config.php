<?php
$host = 'localhost';
$db = 'library_db';
$user = 'root'; // your database username
$pass = ''; // your database password


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection error: " . $e->getMessage());
    die("Database connection failed.");
}
?>