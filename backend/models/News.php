<?php
require_once 'config/db.php';

class News {
    private $conn;
    private $table = 'news';

    public $id;
    public $title;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new news item
    public function create() {
        $query = "INSERT INTO " . $this->table . " (title, content, created_at) VALUES (:title, :content, :created_at)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':created_at', $this->created_at);

        return $stmt->execute();
    }

    // Read all news
    public function read() {
        $query = "SELECT id, title, content, created_at FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get a specific news by ID
    public function getById() {
        $query = "SELECT id, title, content, created_at FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $stmt;
    }

    // Update a news item
    public function update() {
        $query = "UPDATE " . $this->table . " SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete a news item
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>
