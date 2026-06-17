<?php

require_once "database.php";
require_once "users.php";

$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$asal = $_POST["asal"] ?? "";
$password = $_POST["password"] ?? "";
$password_ulang = $_POST["password_ulang"] ?? "";

if (isset($_POST["setuju"])) {

    echo "Anda telah menyetujui form <br>";

    if ($password == $password_ulang) {

        $database = new Database();
        $conn = $database->connect();

        $user = new users($conn);

        $success = $user->create(
            $username,
            $email,
            $asal,
            $password
        );

        if ($success) {
            echo "Pendaftaran berhasil! <a href='index.php'>Kembali ke Halaman Login</a>";
        } else {
            echo "Pendaftaran gagal! <a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";
        }

    } else {

        echo "Password tidak sama <a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";

    }

} else {

    echo "Anda harus menyetujui form <a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";

}

?>