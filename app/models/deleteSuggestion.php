<?php
// ====== DB Connection ======
$db_server = "localhost:3306";
$db_user   = "root";
$db_pass   = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST values
$id  = isset($_POST['id']) ? intval($_POST['id']) : 0;
$tab = isset($_POST['tab']) ? $_POST['tab'] : 'coding';
$type = isset($_POST['type']) ? $_POST['type'] : 'coding';

if ($id > 0) {
    if ($type === 'coding') {
        $stmt = $conn->prepare("DELETE FROM coding_suggestion WHERE cs_id = ?");
    }elseif ($type === 'language') {
        $stmt = $conn->prepare("DELETE FROM language_suggestion WHERE ls_id = ?");
    }else { // general
        $stmt = $conn->prepare("DELETE FROM general_suggestion WHERE gs_id = ?");
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Redirect back to adminSuggestion.php with tab
header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminSuggestion.php?tab=$tab");
exit;
?>
