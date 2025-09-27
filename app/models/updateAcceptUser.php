<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


 // conntecting to database
    $db_server="localhost:3306";
    $db_user="root";
    $db_pass="";
    $db_name="onlineclass_forum";
    $conn="";

    $conn=new mysqli($db_server,$db_user,$db_pass,$db_name);

    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }


// Updaing user table for accepted user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id'] ?? 0);

    // Fetch current user values
    $res = $conn->prepare("SELECT class, status, role FROM users WHERE user_id=?");
    $res->bind_param("i", $userId);
    $res->execute();
    $res->bind_result($oldClass, $oldStatus, $oldRole);
    $res->fetch();
    $res->close();

    // Use posted values if provided, else fallback to old values
    $role   = !empty($_POST['role'])   ? $_POST['role']   : $oldRole;
    $class  = !empty($_POST['class'])  ? $_POST['class']  : $oldClass;
    $status = !empty($_POST['status']) ? $_POST['status'] : $oldStatus;

    $stmt = $conn->prepare("UPDATE users 
                            SET class=?, status=?, role=?, reviewed_at=NOW() 
                            WHERE user_id=?");
    $stmt->bind_param("sssi", $class, $status, $role, $userId);

    if ($stmt->execute()) {
        header("Location: ../../views/admin/adminUserPanel.php?tab=accepted&msg=updated");
        exit;
    } else {
        echo "Error executing: " . $stmt->error;
    }
}


?>
