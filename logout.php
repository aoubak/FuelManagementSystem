<?php
session_start();

// If remember_token cookie is set, remove it from DB and browser
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $hashedToken = hash('sha256', $token);

    // Connect to database and delete token
    
    include("includes/dbManager.php"); // Include your database connection file
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE employees SET remember_token = NULL WHERE remember_token = ?");
    $stmt->bind_param("s", $hashedToken);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Remove the cookie from browser
    setcookie("remember_token", "", time() - 3600, "/", "", true, true);
}

// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();

?>