<?php
include("../config/db.php");

class NewsController {
    public static function getAllNews() {
        global $conn;
        $stmt = $conn->query("SELECT * FROM news ORDER BY date DESC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public static function getNewsById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function addNews($title, $content) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO news (title, content, date) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $content);
        return $stmt->execute();
    }

    public static function updateNews($id, $title, $content) {
        global $conn;
        $stmt = $conn->prepare("UPDATE news SET title = ?, content = ?, date = NOW() WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $id);
        return $stmt->execute();
    }

    public static function deleteNews($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
