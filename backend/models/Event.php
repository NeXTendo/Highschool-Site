<?php
require_once 'config/db.php';

class Event {
    private $conn;
    private $table = 'events';

    public $id;
    public $title;
    public $description;
    public $event_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new event
    public function create() {
        $query = "INSERT INTO " . $this->table . " (title, description, event_date) VALUES (:title, :description, :event_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':event_date', $this->event_date);

        return $stmt->execute();
    }

    // Read all events
    public function read() {
        $query = "SELECT id, title, description, event_date FROM " . $this->table . " ORDER BY event_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get event by ID
    public function getById() {
        $query = "SELECT id, title, description, event_date FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $stmt;
    }

    // Update an event
    public function update() {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description, event_date = :event_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':event_date', $this->event_date);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete an event
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>
