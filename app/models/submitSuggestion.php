<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../views/user/loginPage.php");
    exit;
}

// Database connection
$db_server = "localhost:3306";
$db_user   = "root";
$db_pass   = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id           = $_SESSION['user_id'];
    $suggestion_type   = $_POST['suggestion_type']; // Coding or Language or general
    $suggestion_content = trim($_POST['suggestion_content']);

    if ($suggestion_type === "Coding") {
        $stmt = $conn->prepare("INSERT INTO coding_suggestion (user_id, suggestion_content) VALUES (?, ?)");
    } elseif ($suggestion_type === "Language") {
        $stmt = $conn->prepare("INSERT INTO language_suggestion (user_id, suggestion_content) VALUES (?, ?)");
    } elseif ($suggestion_type === "General") {
        $stmt = $conn->prepare("INSERT INTO general_suggestion (user_id, suggestion_content) VALUES (?, ?)");
    } else {
        header("Location: ../../views/user/userSuggestion.php?error=invalid_type");
        exit;
    }

    if ($stmt) {
        $stmt->bind_param("is", $user_id, $suggestion_content);
        if ($stmt->execute()) {
            header("Location: ../../views/user/userSuggestion.php?success=1");
            exit;
        } else {
            header("Location: ../../views/user/userSuggestion.php?error=db_error");
            exit;
        }
    } else {
        header("Location: ../../views/user/userSuggestion.php?error=stmt_error");
        exit;
    }
}

$conn->close();
?>
