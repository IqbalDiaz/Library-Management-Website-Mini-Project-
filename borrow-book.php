<?php
// Start the session if it's not already started
session_start();

// Database connection
$host = 'localhost';  // Update with your host
$dbname = 'library_db';  // Update with your database name
$username = 'root';   // Update with your database username
$password = '';       // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input data to prevent security issues like XSS
    $bookTitle = htmlspecialchars($_POST['book-title']);
    $userName = htmlspecialchars($_POST['user-name']);
    $userEmail = htmlspecialchars($_POST['user-email']);
    $borrowDate = htmlspecialchars($_POST['borrow-date']);

    // Prepare the SQL query using a prepared statement to prevent SQL injection
    $sql = "INSERT INTO borrow_books (book_title, user_name, user_email, borrow_date)
            VALUES (:bookTitle, :userName, :userEmail, :borrowDate)";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to the prepared statement
    $stmt->bindParam(':bookTitle', $bookTitle);
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':userEmail', $userEmail);
    $stmt->bindParam(':borrowDate', $borrowDate);
    
    // Execute the query
    if ($stmt->execute()) {
        // Success message
        echo "<h2>Borrow Request Confirmed</h2>";
        echo "<p>Thank you, $userName! You have successfully requested to borrow '$bookTitle'.</p>";
        echo "<p>We will contact you at $userEmail.</p>";
        echo "<p>Borrow Date: $borrowDate</p>";
    } else {
        echo "<p>Something went wrong. Please try again later.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="styles_borrow.css"> <!-- Link to your external CSS file -->
</head>
<body>

    <!-- Navigation bar -->
    <div class="nav">
        <a href="welcome.php">Home</a>
        <a href="borrow-book.php">Borrow Book</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="borrow-container">
        <h2>Borrow a Book</h2>

        <!-- Borrow form -->
        <form action="borrow-book.php" method="POST">
            <div class="form-group">
                <label for="book-title">Choose a Book:</label>
                <select id="book-title" name="book-title" required>
                    <option value="The Shining">The Shining</option>
                    <option value="Dracula">Dracula</option>
                    <option value="Frankenstein">Frankenstein</option>
                    <option value="The Hobbit">The Hobbit</option>
                    <option value="Harry Potter">Harry Potter</option>
                    <option value="A Game of Thrones">A Game of Thrones</option>
                </select>
            </div>

            <div class="form-group">
                <label for="user-name">Your Name:</label>
                <input type="text" id="user-name" name="user-name" required>
            </div>

            <div class="form-group">
                <label for="user-email">Your Email:</label>
                <input type="email" id="user-email" name="user-email" required>
            </div>

            <div class="form-group">
                <label for="borrow-date">Borrow Date:</label>
                <input type="date" id="borrow-date" name="borrow-date" required>
            </div>

            <button type="submit" name="submit">Submit Request</button>
        </form>
    </div>

</body>
</html>
