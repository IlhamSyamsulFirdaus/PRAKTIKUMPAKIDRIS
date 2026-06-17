<?php
session_start();
if(!isset($_SESSION['is_logged_in'])) {
  header("Location: ../index.php");
  exit;
}

include '../users.php';
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new Database();
    $conn = $db->connect();
    $users = new Users($conn);

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $asal = $_POST['asal'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email) && !empty($asal) && !empty($password)) {
        $users->create($username, $email, $asal, $password);
    }
}

header("Location: index.php?halaman=daftar_user.php");
exit();
?>
