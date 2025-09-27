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

    
if (isset($_POST['user_id']) && isset($_POST['action'])) {
    echo "<p>Post is working</p>";
    $userId = intval($_POST['user_id']);
    $action = $_POST['action'];

    if ($action === "accept") {
         $stmt = $conn->prepare("CALL accept_user(?)");
         $stmt->bind_param("i", $userId);
    } elseif ($action === "deny") {
        $sql = "UPDATE users SET status='denied', reviewed_at = NOW() WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
    }else {
        die("Invalid action");
    }

   
    if ($stmt->execute()) {
        if ($action === "accept") {
            header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminUserPanel.php?tab=pending&msg=accepted");
            

            exit;
        } else {
            header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminUserPanel.php?tab=pending&msg=denied");
           

            exit;
        }
        
    } else {
         echo "<script>alert('Error Updating User');
            window.location.href = '../../views/admin/adminUserPanel.php';
        </script>";
    }
}
