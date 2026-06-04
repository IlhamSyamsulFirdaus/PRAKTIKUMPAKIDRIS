<?php
session_start();
class Users
{
    private $conn;
    private $table = "users";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // CREATE
    public function create($username, $email, $asal, $password)
    {
        $sql = "INSERT INTO $this->table (username, email, asal, password) 
                VALUES ('$username', '$email', '$asal', '$password')";

        if ($this->conn->query($sql)) {
            echo "Data berhasil ditambahkan <br>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    public function login($username, $password){

    $sql = "SELECT * FROM " . $this->table . 
    " WHERE username = '$username' 
    AND password = '$password'";

    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
        echo "Selamat Datang " . $username;
        echo "<br>";
        echo "Login berhasil";
    } else { 
        echo "Username atau password salah";

    }
}
}