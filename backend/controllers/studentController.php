<?php
include("../config/db.php");

class StudentController {
    public static function getAllStudents() {
        global $conn;
        $stmt = $conn->query("SELECT * FROM students");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public static function getStudentById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function addStudent($name, $email, $grade) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO students (name, email, grade) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $email, $grade);
        return $stmt->execute();
    }

    public static function updateStudent($id, $name, $email, $grade) {
        global $conn;
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, grade = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $email, $grade, $id);
        return $stmt->execute();
    }

    public static function deleteStudent($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
