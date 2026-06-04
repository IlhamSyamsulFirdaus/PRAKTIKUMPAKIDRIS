<?php
session_start();
require_once("database.php");
require_once("users.php");

$username = $_POST['input_Username'] ?? '';
$password = $_POST['input_Password'] ?? '';

$db = new Database();
$conn = $db->connect();
$user = new Users($conn);

// Check login credentials
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['is_logged_in'] = true;
    header("Location: dashboard/index.php");
    exit;
} else {
    // Login failed, redirect back with error
    header("Location: index.html?error=1");
    exit;
}
?>