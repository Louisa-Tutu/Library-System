<?php
$host = "127.0.0.1:3307";
$user = "Louisa";
$password = "123456";
$dbname = "library_db";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>