<?php

require_once "database.php";

class users{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new database;
        $this->conn = $this->db->conn;
    }

    public function register($email, $password){
        $hashedpassword = password_hash($password,PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare("INSERT INTO users ('email','password') VALUES(?,?,?)");
        $stmt->bind_param("sss",$email,$hashedpassword);

        return $stmt->execute();
    }

    public function login($email,$password){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 1){
            $row = $result->fetch_assoc();
            if(password_verify($password,$row['password'])){
                return $row;
            }
        return false;
        }
    }
}