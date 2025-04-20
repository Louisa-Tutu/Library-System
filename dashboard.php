<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

// Include database connection
include 'db.php';

// Fetch books from the database
$query = "SELECT * FROM books ORDER BY added_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Library System</title>
    <style>
        body {
            font-family: Arial;
            background: #eef1f5;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .menu {
            background: #444;
            padding: 10px;
            text-align: center;
        }
        .menu a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            margin: 0 5px;
            background: #5cb85c;
            border-radius: 5px;
        }
        .menu a:hover {
            background: #4cae4c;
        }
        .content {
            padding: 20px;
        }
        .book {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #ccc;
        }
        .book h3 {
            margin: 0;
        }
        .book p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Welcome, <?php echo $_SESSION['admin']; ?>!</h1>
</div>

<div class="menu">
    <a href="add_book.php">Add Books</a>
    <a href="view_book.php">View Books</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>All Books</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($books = mysqli_fetch_assoc($result)) {
            echo "<div class='book'>";
            echo "<h3>" . $books['title'] . "</h3>";
            echo "<p><strong>Author:</strong> " . $books['author'] . "</p>";
            echo "<p><strong>Category:</strong> " . $books['category'] . "</p>";
            echo "<p>" . $books['description'] . "</p>";
            echo "<p><em>Added on: " . $books['added_date'] . "</em></p>";
            echo "</div>";
        }
    } else {
        echo "<p>No books available.</p>";
    }
    ?>
</div>

</body>
</html>