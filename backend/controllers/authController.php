<?php
session_start();
include("/Code/HighschoolSite/backend/config/db.php");

class AuthController {

    // Register a new user
    public static function register($username, $email, $password) {
        global $pdo;  // Use PDO connection from db.php
        
        // Sanitize inputs
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        // Check if email or username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            return "Username or email already in use.";
        }

        // Hash the password securely
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the query to insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'student')");
        
        if ($stmt->execute([$username, $email, $passwordHash])) {
            return true;
        } else {
            // Handle error
            return "Error in registration. Please try again.";
        }
    }

    // Login user
    public static function login($username, $password) {
        global $pdo;
        
        // Sanitize inputs
        $username = htmlspecialchars($username);

        // Prepare the query to find the user by username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Check if the user exists
        if ($user && password_verify($password, $user['password'])) {
            // Store user information in the session
            $_SESSION['user'] = $user;
            session_regenerate_id(); // Regenerate session ID to prevent session fixation
            
            // Redirect to dashboard after successful login
            header("Location: ../frontend/student_portal.html");
            exit();
        }

        return "Invalid credentials.";
    }

    // Logout user
    public static function logout() {
        session_unset();  // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: ../frontend/auth/login.html");
        exit();
    }
}
?>
