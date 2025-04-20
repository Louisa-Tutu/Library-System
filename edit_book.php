<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $update_sql = "UPDATE books SET 
                    title = '$title',
                    author = '$author',
                    category = '$category',
                    description = '$description'
                    WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Book updated successfully.";
        header("Location: view_book.php");
        exit();
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 350px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 93%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-update {
            background-color: #28a745;
        }

        .btn-cancel {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

   <div class="container">
      <h2>Edit Book</h2>
      <form method="POST">
         <label>Title:</label><br>
         <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br><br>

         <label>Author:</label><br>
         <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br><br>

         <label>Category:</label><br>
         <input type="text" name="category" value="<?php echo $book['category']; ?>" required><br><br>

         <label>Description:</label><br>
         <textarea name="description" rows="4" cols="30" required><?php echo $book['description']; ?></textarea><br><br>
   
          <div class="button-group">
             <input type="submit" name="update" value="Update Book" class="btn btn-update">
             <a href="view_book.php" class="btn btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
</body>
</html>