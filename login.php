<?php
session_start();

require_once __DIR__ . "/database.php";
require_once __DIR__ . "/users.php";

$username = $_POST['input_username'] ?? '';
$password = $_POST['input_password'] ?? '';

$db = new Database();
$conn = $db->connect(); 

$user = new Users($conn);

$ditemukan = $user->login($username, $password);

if ($ditemukan == false) {
    $_SESSION['pesan_kesalahan'] = "login gagal";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['is_logged_in'] = true;
    $_SESSION['username'] = $username;

    header("Location: dashboard/index.php");
    exit();



    echo "<h4>Username atau password salah!</h4>";

}
?>