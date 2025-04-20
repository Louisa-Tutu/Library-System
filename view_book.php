<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'db.php';

// Fetch all books
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books - Library System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
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

        .container {
            margin: 30px auto;
            width: 90%;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .action-buttons{
            display: flex;
            gap: 6px;
        }

        .action-buttons a {
            font-size: 13px;
            padding: 6px 10px;
            margin-right: 5px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            display:inline-block;
            white-space: nowrap;
        }

        .edit-btn {
            background-color: #0275d8;
        }

        .edit-btn:hover {
            background-color: #025aa5;
        }

        .delete-btn {
            background-color: #d9534f;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Library Book List</h1>
</div>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="add_book.php">Add Book</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>All Available Books</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $i++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td class='action-buttons'>
                            <a href='edit_book.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>
                            <a href='delete_book.php?id=" . $row['id'] . "' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this book?');\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No books found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>