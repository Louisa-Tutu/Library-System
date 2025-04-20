<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'db.php';

// Handle form submission
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Insert into books table
    $query = "INSERT INTO books (title, author, category, description) VALUES ('$title', '$author', '$category', '$description')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Book added successfully!";
    } else {
        $error = "Failed to add book: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book - Library System</title>
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
        .form-box {
            width: 350px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 5px;
        }
        .form-box h2 {
            text-align: center;
        }
        .form-box input,
        .form-box textarea {
            width: 93%;
            padding: 10px;
            margin: 10px 0;
        }
        .form-box input[type="submit"] {
            background: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-box .success {
            color: green;
            text-align: center;
        }
        .form-box .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Add New Book</h1>
</div>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="logout.php">Logout</a>
</div>

<div class="form-box">
    <h2>Enter Book Details</h2>

    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" action="">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="category" placeholder="Category" required>
        <textarea name="description" rows="4" placeholder="Short Description..." required></textarea>
        <input type="submit" value="Add Book">
    </form>
</div>

</body>
</html>