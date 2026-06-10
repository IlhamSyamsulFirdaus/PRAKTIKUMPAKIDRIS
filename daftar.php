<?php
require_once "database.php";
require_once "users.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Username = $_POST["username"] ?? '';
    $Email = $_POST["email"] ?? '';
    $Asal = $_POST["asal"] ?? '';
    $Password = $_POST["password"] ?? '';
    $Password_Ulang = $_POST["password_ulang"] ?? '';

    if (isset($_POST["saya_setuju"])) {
        if ($Password !== $Password_Ulang) {
            echo "Error: Ulangi password dengan benar! Password tidak cocok.<br>";
            echo "<a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";
            exit;
        }

        $database = new Database();
        $conn = $database->connect();
        
        $users = new Users($conn);
        
        // Cek apakah username / email sudah terdaftar
        $check_sql = "SELECT * FROM users WHERE username = '" . $conn->real_escape_string($Username) . "' OR email = '" . $conn->real_escape_string($Email) . "'";
        $check_res = $conn->query($check_sql);
        if ($check_res && $check_res->num_rows > 0) {
            echo "Error: Username atau Email sudah terdaftar!<br>";
            echo "<a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";
            exit;
        }

        // Simpan data
        $users->create($Username, $Email, $Asal, $Password);
        
        echo "<br>Pendaftaran berhasil! <a href='index.html'>Kembali ke Halaman Login</a>";
    } else {
        echo "Anda harus menyetujui syarat dan ketentuan.<br>";
        echo "<a href='Sign_Up.html'>Kembali ke Form Registrasi</a>";
    }
} else {
    header("Location: Sign_Up.html");
    exit;
}