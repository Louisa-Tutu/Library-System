<?php
// Start the session
session_start();

// Include database connection
include 'db.php';

// Initialize error message
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Encrypt password using MD5 (same as stored)
    $password = md5($password);

    // Query to check login
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Library System</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .login-box {
            width: 300px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 93%;
            padding: 12px;
            margin: 10px 0;
        }
        .login-box input[type="submit"]{
            display: flex;
            justify-content: center;
        }
        .button-container{
            text-align: center;
        }
        .login-box input[type="submit"] {
            width: 50%;
            padding: 10px 25px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .error {
            color: red;
            text-align: center;
        }
        
    </style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Enter Username" required />
        <input type="password" name="password" placeholder="Enter Password" required />

        <div class="button-container">
        <input type="submit" value="Login" class="login-box" />
        </div>
        
    </form>
</div>

</body>
</html>