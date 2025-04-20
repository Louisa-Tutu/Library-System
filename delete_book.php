<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_sql = "DELETE FROM books WHERE id = $id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "Book is deleted successfully.";
        header("Location: view_book.php");
        exit();
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
}
?>