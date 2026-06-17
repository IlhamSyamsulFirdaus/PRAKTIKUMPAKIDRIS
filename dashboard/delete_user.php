<?php
include '../users.php';
include '../database.php';

$db = new Database();
$conn = $db->connect();
$users = new Users($conn);

$id = $_GET['id'];
$users->hapus($id);
header("Location: index.php");
exit();