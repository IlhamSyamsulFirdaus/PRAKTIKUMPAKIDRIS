<?php
session_start();
require_once("database.php");
require_once("users.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['input_Username'] ?? '';
    $password = $_POST['input_Password'] ?? '';

    $db = new Database();
    $conn = $db->connect();
    
    $username_esc = $conn->real_escape_string($username);
    $password_esc = $conn->real_escape_string($password);

    // Check login credentials
    $sql = "SELECT * FROM users WHERE username = '$username_esc' AND password = '$password_esc'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        header("Location: dashboard/index.php");
        exit;
    } else {
        // Login failed, redirect back with error
        header("Location: index.html?error=1");
        exit;
    }
} else {
    header("Location: index.html");
    exit;
}
?>