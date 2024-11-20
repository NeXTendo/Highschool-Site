<?php
require_once 'config/db.php';

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user
    public function create() {
        $query = "INSERT INTO " . $this->table . " (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }

    // Read user by username
    public function readByUsername() {
        $query = "SELECT id, username, password, role FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        return $stmt;
    }

    // Check if user exists
    public function userExists() {
        $stmt = $this->readByUsername();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        return null;
    }

    // Update password (e.g., for reset)
    public function updatePassword() {
        $query = "UPDATE " . $this->table . " SET password = :password WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':username', $this->username);

        return $stmt->execute();
    }
}
?>
