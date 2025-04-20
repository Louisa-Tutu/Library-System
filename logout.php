<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect back to login page
header("Location: index.php");
exit();
?>