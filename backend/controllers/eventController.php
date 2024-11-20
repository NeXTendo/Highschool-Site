<?php
include("../config/db.php");

class EventController {
    public static function getAllEvents() {
        global $conn;
        $stmt = $conn->query("SELECT * FROM events ORDER BY date ASC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public static function getEventById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function addEvent($title, $description, $date) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO events (title, description, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $date);
        return $stmt->execute();
    }

    public static function updateEvent($id, $title, $description, $date) {
        global $conn;
        $stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, date = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $date, $id);
        return $stmt->execute();
    }

    public static function deleteEvent($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
