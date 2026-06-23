<?php

class Users
{

    private $conn;
    private $table = "users";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($username, $email, $asal, $password)
    {
        $sql = "INSERT INTO $this->table (Username, Email, Asal, Password)
                VALUES ('$username', '$email', '$asal', '$password')";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    
    public function login($username, $password)
    {
        $sql = "SELECT * FROM $this->table
                WHERE username = '$username'
                AND password = '$password'";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return true;
        }

        return false;
    }
    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->conn->query($sql);

        if ($result ->num_rows > 0) {
            return $result;
        } else {
            return false;
        }

        
    }
    public function hapus($id){
        $sql = "DELETE FROM $this->table WHERE id = " . $id;
        $result = $this->conn->query($sql);
        return $result;
    }
    public function ambilUserById($id){
        $sql = "SELECT * FROM $this->table WHERE id =" . $id;
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    public function getUserById($id){
        $sql = "SELECT * FROM $this->table WHERE id =" . $id;
        $result = $this->conn->query($sql);
        return $result;
    }
    public function update($id, $username, $email, $asal, $password){
    $sql = "UPDATE $this->table SET
    username='".$username."', email='".$email."',
    asal='".$asal."',
    password='".$password."'
    WHERE id='".$id."'";

    $result = $this->conn->query($sql);
    return $result;
    }
    public function hitungLogin($username) {
    $sql_update = "UPDATE users SET login_count = login_count + 1 WHERE username = '" . $username . "'";
    $this->conn->query($sql_update);
    $sql_select = "SELECT login_count FROM users WHERE username = '" . $username . "'";
    $result = $this->conn->query($sql_select);
    $row = $result->fetch_assoc();

    return $row['login_count'];
}
}
?>