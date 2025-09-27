<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_server="localhost:3306";
$db_user="root";
$db_pass="";
$db_name="onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']);
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Change denied user back to accepted
         $stmt = $conn->prepare("CALL accept_user(?)");
         $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            header("Location: ../../views/admin/adminUserPanel.php?tab=denied&msg=accepted");
            exit;
        } else {
            echo "Error updating: " . $stmt->error;
        }
    } elseif ($action === 'delete') {

        // delete the user with auto trigger delete for both coding_suggestion table and language_suggestion table
        // delete child rows first
        $conn->query("DELETE FROM coding_suggestion WHERE user_id=$userId");
        $conn->query("DELETE FROM language_suggestion WHERE user_id=$userId");
        $conn->query("DELETE FROM general_suggestion WHERE user_id=$userId");
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            header("Location: ../../views/admin/adminUserPanel.php?tab=denied&msg=deleted");
            exit;
        } else {
            echo "Error deleting: " . $stmt->error;
        }
    }

}
?>
