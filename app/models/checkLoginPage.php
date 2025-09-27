<?php
session_start();

// Database connection
$db_server = "localhost:3306";
$db_user   = "root";
$db_pass   = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if login form is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, name, email, password, role, status FROM users WHERE email = ? AND status = 'accept' LIMIT 1;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Bind results correctly
        $stmt->bind_result($user_id, $name, $email_db, $hashedPassword, $role, $status);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Store user info in session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminUserPanel.php");
                exit;
            } else if ($role === 'student') {
                header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/user/main.php");
                exit;
            }
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='../../views/user/loginPage.php';</script>";
            exit;
        }
    } else {
        // No user found or not accepted
        echo "<script>alert('No user found or account not accepted yet.'); window.location.href='../../views/user/loginPage.php';</script>";
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
