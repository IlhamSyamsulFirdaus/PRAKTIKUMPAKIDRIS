<?php
require_once "database.php";
require_once "users.php";
$Username = $_POST["username"];
$Email = $_POST["email"];
$Asal = $_POST ["asal"];
$Password = $_POST ["password"];
$Password_Ulang = $_POST ["password_ulang"];
$Saya_setuju = ["saya_setuju"];

if(isset($_POST["saya_setuju"])){
    echo "anda telah menyetujui form";
    $database = new Database;
    $conn = $database->connect();
    echo "<br>";
    echo "database terhubung";

    $users = new Users($conn);
    $users->create($Username, $Email, $Asal, $Password);

}else{
    echo "anda harus menyetujui form";
}