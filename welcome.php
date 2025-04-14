<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles_welcome.css">
</head>
<body>

    <!-- Navigation bar with Logout and Home links -->
    <div class="nav">
        <a href="welcome.php">Home</a>
        <a href="borrow-book.php">Borrow Book</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Welcome Message for the logged-in user -->
    <div class="welcome-message">
        <h2>Welcome, <?php echo $_SESSION['user_id']; ?>!</h2>
        <p>Explore the genres and books below.</p>
    </div>

    <!-- Container for book genres and books -->
    <div class="book-container">
        <!-- Horror Genre Section -->
        <div class="genre-section">
            <h2 class="genre-title">Horror</h2>
            <div class="book">
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book1.jpg" alt="The Shining"></a>
                    <p class="book-title">The Shining</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book2.jpg" alt="Dracula"></a>
                    <p class="book-title">Dracula</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book3.jpg" alt="Frankenstein"></a>
                    <p class="book-title">Frankenstein</p>
                </div>
            </div>
        </div>

        <!-- Fantasy Genre Section -->
        <div class="genre-section">
            <h2 class="genre-title">Fantasy</h2>
            <div class="book">
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book4.jpeg" alt="The Hobbit"></a>
                    <p class="book-title">The Hobbit</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book5.jpg" alt="Harry Potter"></a>
                    <p class="book-title">Harry Potter</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book6.jpg" alt="A Game of Thrones"></a>
                    <p class="book-title">A Game of Thrones</p>
                </div>
            </div>
        </div>

        <!-- Mystery Genre Section -->
        <div class="genre-section">
            <h2 class="genre-title">Mystery</h2>
            <div class="book">
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book7.jpg" alt="Gone Girl"></a>
                    <p class="book-title">Gone Girl</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book8.jpg" alt="The Girl on the Train"></a>
                    <p class="book-title">The Girl on the Train</p>
                </div>
                <div class="book-item">
                    <a href="borrow-book.php"><img src="book9.jpeg" alt="The Da Vinci Code"></a>
                    <p class="book-title">The Da Vinci Code</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 Library Website</p>
    </footer>
</body>
</html>
