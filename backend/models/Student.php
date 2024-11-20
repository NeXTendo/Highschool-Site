<?php
require_once 'config/db.php';

class Student {
    private $conn;
    private $table = 'students';

    public $id;
    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $grade;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new student
    public function create() {
        $query = "INSERT INTO " . $this->table . " (user_id, first_name, last_name, email, grade) VALUES (:user_id, :first_name, :last_name, :email, :grade)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':grade', $this->grade);

        return $stmt->execute();
    }

    // Get a student by ID
    public function getById() {
        $query = "SELECT id, first_name, last_name, email, grade FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $stmt;
    }

    // Update student information
    public function update() {
        $query = "UPDATE " . $this->table . " SET first_name = :first_name, last_name = :last_name, email = :email, grade = :grade WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':grade', $this->grade);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete student record
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>
