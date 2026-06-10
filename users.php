<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        $username_esc = $this->conn->real_escape_string($username);
        $email_esc = $this->conn->real_escape_string($email);
        $asal_esc = $this->conn->real_escape_string($asal);
        $password_esc = $this->conn->real_escape_string($password);

        $sql = "INSERT INTO $this->table (username, email, asal, password) 
                VALUES ('$username_esc', '$email_esc', '$asal_esc', '$password_esc')";

        if ($this->conn->query($sql)) {
            echo "Data berhasil ditambahkan <br>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    public function login($username, $password){
        $username_esc = $this->conn->real_escape_string($username);
        $password_esc = $this->conn->real_escape_string($password);

        $sql = "SELECT * FROM " . $this->table . " WHERE username = '$username_esc' AND password = '$password_esc'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            echo "Selamat Datang " . $username;
            echo "<br>";
            echo "Login berhasil";
        } else { 
            echo "Username atau password salah";
        }
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM $this->table";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result) {
            while($row = $result->fetch_assoc()){
                $users[] = $row;
            }
        }
        return $users;
    }
}