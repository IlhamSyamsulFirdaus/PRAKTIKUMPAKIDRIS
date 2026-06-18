<?php

require_once "../database.php";
require_once "../users.php";

$id = $_POST["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$asal = $_POST["asal"];
$password = $_POST["password"];

 $database = new Database();
        $conn = $database->connect();

        $user = new users($conn);
        $user->update($id, $username, $email, $asal, $password);

        header("location: index.php");
?>
