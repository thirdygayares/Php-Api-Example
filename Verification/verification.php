<?php


require_once   '../db.php';

class Verification {
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
 
    public function getStudentsInfo($id) {
        $stmt = $this->db->prepare("SELECT *  FROM students WHERE studentId = ?");
        $stmt->bind_param("s", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $students = $result->fetch_assoc();
            return $students;
        }
    
        return null; // no credentials
    }

    public function createSavedScan($studentId) {
        $stmt = $this->db->prepare("INSERT INTO scanverification (studentId) VALUES (?)");
        $stmt->bind_param("s", $studentId);
    
        if ($stmt->execute())
        return true;
        return false; // no credentials
    }
    
    
}
