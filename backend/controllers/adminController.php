<?php
include("../config/db.php");

class AdminController {
    public static function addAdmin($username, $email, $password) {
        global $conn;
        $passwordHash = md5($password);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
        $stmt->bind_param("sss", $username, $email, $passwordHash);
        return $stmt->execute();
    }

    public static function deleteAdmin($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'admin'");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function getAllAdmins() {
        global $conn;
        $stmt = $conn->query("SELECT * FROM users WHERE role = 'admin'");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
?>
