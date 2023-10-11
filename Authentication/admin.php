<?php


require_once   '../db.php';

class Admin {
    private $db;

    function __construct()
    {
        //Getting the DbConnect.php file
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->db = $db->connect();
    }
 

    
    //note this is for testing login API
    public function createAdmin($email, $password) {
     
        $stmt = $this->db->prepare("INSERT INTO admin (email, password) VALUES (?,?)");
       
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
       
        $stmt->bind_param("ss",$email,$passwordHash);
        if($stmt->execute())
        return true; 
        return false; 

    }


    

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT id, email, password FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc();
    
            if ($admin && password_verify($password, $admin['password'])) {
                // Password is correct
                return ['id' => $admin['id']];
            }
        }
    
        return null; // Invalid credentials or error
    }
    
    
}
