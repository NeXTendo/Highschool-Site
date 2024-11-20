<?php
// Start the session and include necessary files
session_start();

// Include database connection and controllers
include_once('backend/config/db.php');
include_once('backend/controllers/authController.php');
include_once('backend/controllers/studentController.php');
include_once('backend/controllers/adminController.php');
include_once('backend/controllers/newsController.php');
include_once('backend/controllers/eventController.php');

// Handle routing logic
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Define the base URL
$base_url = "/path/to/your/project"; // Adjust this to match your actual URL

// Remove the base URL from the URI if it's present
if (strpos($uri, $base_url) === 0) {
    $uri = substr($uri, strlen($base_url));
}

// Remove any query strings
$uri = strtok($uri, '?');

// Route the request
switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $loginMessage = AuthController::login($username, $password);
            if ($loginMessage === true) {
                header("Location: /frontend/student_portal.html");
            } else {
                $_SESSION['error_message'] = $loginMessage;
                header("Location: /frontend/auth/login.html");
            }
        }
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $registerMessage = AuthController::register($username, $email, $password);
            if ($registerMessage === true) {
                header("Location: /frontend/auth/login.html");
            } else {
                $_SESSION['error_message'] = $registerMessage;
                header("Location: /frontend/auth/register.html");
            }
        }
        break;
    // Add other cases as necessary for additional routes
    case '/logout':
        // Handle logout
        AuthController::logout();
        break;

    // Student Routes
    case '/student_portal':
        // Ensure user is logged in
        if (isset($_SESSION['user'])) {
            include('../frontend/student_portal.html');
        } else {
            header("Location: ../frontend/auth/login.html");
        }
        break;

    // Admin Routes
    case '/admin_portal':
        // Ensure user is logged in and is an admin
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            include('../frontend/admin_portal.html');
        } else {
            header("Location: ../frontend/auth/login.html");
        }
        break;

    // News Routes
    case '/news':
        include('../frontend/news_events.html');
        break;

    case '/add_news':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $newsResult = NewsController::addNews($title, $content);
            if ($newsResult === true) {
                header("Location: /news");
            } else {
                $_SESSION['error_message'] = $newsResult;
                header("Location: /news");
            }
        } else {
            include('../frontend/add_news.html');
        }
        break;

    // Event Routes
    case '/events':
        include('../frontend/news_events.html');
        break;

        case '/add_event':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $event_name = $_POST['event_name'];
                $event_date = $_POST['event_date'];
                $event_description = $_POST['event_description']; // New line
                $eventResult = EventController::addEvent($event_name, $event_date, $event_description);
                
                if ($eventResult === true) {
                    header("Location: /events");
                } else {
                    $_SESSION['error_message'] = $eventResult;
                    header("Location: /events");
                }
            } else {
                include('../frontend/add_event.html');
            }
            break;
        
    // Default route for home page
    case '/':
    default:
        include('../frontend/index.html');
        break;
}
?>
